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
    public array $translations;

    /**
     * @throws CronParsingException
     * @throws TranslationFileMissingException
     */
    public function __construct(string $cron, string $locale = 'en', bool $timeFormat24hours = false)
    {
        $this->raw = $cron;
        $fields = explode(' ', $cron);
        $this->minute = new MinutesField($this, $fields[0]);
        $this->hour = new HoursField($this, $fields[1]);
        $this->day = new DaysOfMonthField($this, $fields[2]);
        $this->month = new MonthsField($this, $fields[3]);
        $this->weekday = new DaysOfWeekField($this, $fields[4]);
        $this->locale = $locale;
        $this->timeFormat24hours = $timeFormat24hours;
        $this->ensureLocaleExists();
        $this->loadTranslations();
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

    public function langCountable(string $type, int $number, string $case = 'nominative'): array|string
    {
        $array = $this->translations[$type];

        $value = $array[$case][$number] ?? $array[$number] ?? $array[$case]['default'] ?? $array['default'] ?? '';

        return str_replace(':number', $number, $value);
    }

    public function lang(string $key, array $replacements = [])
    {
        $translation = $this->getArrayDot($this->translations['fields'], $key);

        foreach ($replacements as $transKey => $value) {
            $translation = str_replace(':' . $transKey, $value, $translation);
        }

        return $this->pluralize($translation);
    }

    protected function ensureLocaleExists(string $fallbackLocale = 'en'): void
    {
        if (!is_dir($this->getTranslationDirectory())) {
            $this->locale = $fallbackLocale;
        }
    }

    /**
     * @throws TranslationFileMissingException
     */
    protected function loadTranslations(): void
    {
        $this->translations = [
            'days' => $this->loadTranslationFile('days'),
            'fields' => $this->loadTranslationFile('fields'),
            'months' => $this->loadTranslationFile('months'),
            'ordinals' => $this->loadTranslationFile('ordinals'),
            'times' => $this->loadTranslationFile('times'),
        ];
    }

    /**
     * @throws TranslationFileMissingException
     */
    protected function loadTranslationFile(string $file)
    {
        $filename = sprintf('%s/%s.php', $this->getTranslationDirectory(), $file);

        if (!is_file($filename)) {
            throw new TranslationFileMissingException($this->locale, $file);
        }

        return include $filename;
    }

    protected function getTranslationDirectory(): string
    {
        return __DIR__ . '/lang/' . $this->locale;
    }

    protected function getArrayDot(array $array, string $key)
    {
        $keys = explode('.', $key);

        foreach ($keys as $item) {
            $array = $array[$item];
        }

        return $array;
    }


    /**
     * Pluralize the input string based on the counts and forms provided.
     *
     * @param string $inputString The input string to pluralize.
     * @return string The pluralized string.
     */
    public function pluralize(string $inputString): string
    {
        if (!preg_match_all('/(\d+)\s+{(.+?)\}/', $inputString, $matches)) {
            return $inputString;
        }

        [$fullMatches, $counts, $forms] = $matches;

        $conversionTable = [];

        foreach ($counts as $key => $count) {
            $conversionTable['{' . $forms[$key] . '}'] = $this->declineCount((int)$count, $forms[$key]);
        }

        return strtr($inputString, $conversionTable);
    }

    /**
     * Generates the function comment for the declineCount function.
     *
     * @param int $count The count parameter represents the count value.
     * @param string $forms The forms parameter represents the forms string.
     * @return string The function returns a string value.
     */
    protected function declineCount(int $count, string $forms): string
    {
        $formsArray = explode('|', $forms);

        if (count($formsArray) < 3) {
            $formsArray[2] = $formsArray[1];
        }

        $cases = [2, 0, 1, 1, 1, 2];

        $count = abs((int) strip_tags($count));

        $formIndex = ($count % 100 > 4 && $count % 100 < 20)
            ? 2
            : $cases[min($count % 10, 5)];

        return $formsArray[$formIndex];
    }
}
