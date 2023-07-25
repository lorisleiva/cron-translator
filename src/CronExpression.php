<?php

namespace Lorisleiva\CronTranslator;

class CronExpression
{
    public string $raw;
    public MinutesField $minute;
    public HoursField $hour;
    public DaysOfMonthField $day;
    public MonthsField $month;
    public DaysOfWeekField $weekday;
    public string $locale;
    public bool $timeFormat24hours;
    public ?array $translations = null;
    public array $langDirs = [];

    private static array $extendedMap = [
        '@yearly' => '0 0 1 1 *',
        '@annually' => '0 0 1 1 *',
        '@monthly' => '0 0 1 * *',
        '@weekly' => '0 0 * * 0',
        '@daily' => '0 0 * * *',
        '@hourly' => '0 * * * *'
    ];

    /**
     * @throws CronParsingException
     * @throws TranslationFileMissingException
     */
    public function __construct(string $cron, string $locale = 'en', bool $timeFormat24hours = false)
    {
        if (isset(self::$extendedMap[$cron])) {
            $cron = self::$extendedMap[$cron];
        }

        $this->raw = $cron;
        $fields = explode(' ', $cron);
        $this->minute = new MinutesField($this, $fields[0]);
        $this->hour = new HoursField($this, $fields[1]);
        $this->day = new DaysOfMonthField($this, $fields[2]);
        $this->month = new MonthsField($this, $fields[3]);
        $this->weekday = new DaysOfWeekField($this, $fields[4]);
        $this->locale = $locale;
        $this->langDirs[] = $this->getDefaultTranslationDirectory();
        $this->timeFormat24hours = $timeFormat24hours;
        $this->ensureLocaleExists();
    }

    public function translate(?string $locale = null, ?bool $timeFormat24hours = null): string
    {
        // Bak config that we may override them on the fly.
        $translationsBak = $this->translations;
        $timeFormat24hoursBak = $this->timeFormat24hours;

        // Backup translations if we override it.
        if ($locale !== null && $this->locale !== $locale) {
            $this->locale = $locale;
        }

        $this->loadTranslations();

        // Backup $timeFormat24hours if we override it.
        if ($timeFormat24hours !== null) {
            $this->timeFormat24hours = $timeFormat24hours;
        }

        // Start translating
        $orderedFields = static::orderFields($this->getFields());

        $translations = array_map(static function (Field $field) {
            return $field->translate();
        }, $orderedFields);

        $translated = ucfirst(implode(' ', array_filter($translations)));

        // Restore config
        $this->translations = $translationsBak;
        $this->timeFormat24hours = $timeFormat24hoursBak;

        return $translated;
    }

    protected static function orderFields(array $fields): array
    {
        // Group fields by CRON types.
        $onces = static::filterType($fields, 'Once');
        $everys = static::filterType($fields, 'Every');
        $incrementsAndMultiples = static::filterType($fields, 'Increment', 'Multiple');

        // Decide whether to keep one or zero CRON type "Every".
        $firstEvery = reset($everys)->position ?? PHP_INT_MIN;
        $firstIncrementOrMultiple = reset($incrementsAndMultiples)->position ?? PHP_INT_MAX;
        $numberOfEverysKept = $firstIncrementOrMultiple < $firstEvery ? 0 : 1;

        // Mark fields that will not be displayed as dropped.
        // This allows other fields to check whether some
        // information is missing and adapt their translation.
        /** @var Field $field */
        foreach (array_slice($everys, $numberOfEverysKept) as $field) {
            $field->dropped = true;
        }

        return array_merge(
        // Place one or zero "Every" field at the beginning.
            array_slice($everys, 0, $numberOfEverysKept),

            // Place all "Increment" and "Multiple" fields in the middle.
            $incrementsAndMultiples,

            // Finish with the "Once" fields reversed (i.e. from months to minutes).
            array_reverse($onces)
        );
    }

    protected static function filterType(array $fields, ...$types): array
    {
        return array_filter($fields, static function (Field $field) use ($types) {
            return $field->hasType(...$types);
        });
    }

    public function getFields(): array
    {
        return [
            $this->minute,
            $this->hour,
            $this->day,
            $this->month,
            $this->weekday,
        ];
    }

    public function langCountable(string $type, int $number): array|string
    {
        $array = $this->translations[$type];

        $value = $array[$number] ?? ($array['default'] ?: '');

        return str_replace(':number', $number, $value);
    }

    public function lang(string $key, array $replacements = [])
    {
        $translation = $this->getArrayDot($this->translations['fields'], $key);

        foreach ($replacements as $transKey => $value) {
            $translation = str_replace(':' . $transKey, $value, $translation);
        }

        return $translation;
    }

    protected function ensureLocaleExists(string $fallbackLocale = 'en'): void
    {
        if (! is_dir($this->getTranslationDirectory())) {
            $this->locale = $fallbackLocale;
        }
    }

    /**
     * @throws TranslationFileMissingException
     */
    protected function loadTranslations(): void
    {
        $this->translations ??= [
            'days' => $this->loadTranslationFile('days'),
            'fields' => $this->loadTranslationFile('fields'),
            'months' => $this->loadTranslationFile('months'),
            'ordinals' => $this->loadTranslationFile('ordinals'),
            'times' => $this->loadTranslationFile('times'),
        ];
    }

    /**
     * @throws TranslationFileMissingException|TranslationDirMissingException
     */
    protected function loadTranslationFile(string $file)
    {
        $filename = sprintf('%s/%s.php', $this->getTranslationDirectory(), $file);

        if (! is_file($filename)) {
            throw new TranslationFileMissingException($this->locale, $file);
        }

        return include $filename;
    }

    /**
     * @throws TranslationDirMissingException
     */
    protected function getTranslationDirectory(): string
    {
        foreach ($this->langDirs as $langDir) {
            $localDir = rtrim($langDir, '/') . '/' . $this->locale;

            if (is_dir($localDir)) {
                return $localDir;
            }
        }

        throw new TranslationDirMissingException($this->locale);
    }

    /**
     * @param string ...$dirs
     *
     * @return  static
     */
    public function addLangDir(string ...$dirs): static
    {
        $dirs = array_values($dirs);

        $this->langDirs = array_merge(
            $this->langDirs,
            $dirs
        );

        return $this;
    }

    public function getDefaultTranslationDirectory(): string
    {
        return __DIR__ . '/lang';
    }

    protected function getArrayDot(array $array, string $key)
    {
        $keys = explode('.', $key);

        foreach ($keys as $item) {
            $array = $array[$item];
        }

        return $array;
    }
}
