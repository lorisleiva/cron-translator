<?php

namespace Lorisleiva\CronTranslator;

class CronExpression
{
    /** @var string */
    public $raw;

    /** @var MinutesField */
    public $minute;

    /** @var HoursField */
    public $hour;

    /** @var DaysOfMonthField */
    public $day;

    /** @var MonthsField */
    public $month;

    /** @var DaysOfWeekField */
    public $weekday;

    /** @var string */
    public $locale;

    /** @var bool */
    public $timeFormat24hours;

    /** @var array */
    public $translations;

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

    public function getFields()
    {
        return [
            $this->minute,
            $this->hour,
            $this->day,
            $this->month,
            $this->weekday,
        ];
    }

    public function langCountable(string $type, int $value)
    {
        $array = $this->translations[$type];

        if (isset($array[$value])) {
            return $array[$value];
        }

        return $array['default'] ?: '';
    }

    public function lang(string $key, array $replacements = [])
    {
        $translation = $this->getArrayDot($this->translations['fields'], $key);

        foreach ($replacements as $key => $value) {
            $translation = str_replace(':' . $key, $value, $translation);
        }

        return $translation;
    }

    protected function ensureLocaleExists(string $fallbackLocale = 'en')
    {
        if (! is_dir($this->getTranslationDirectory())) {
            $this->locale = $fallbackLocale;
        }
    }

    protected function loadTranslations()
    {
        $this->translations = [
            'days' => $this->loadTranslationFile('days'),
            'fields' => $this->loadTranslationFile('fields'),
            'months' => $this->loadTranslationFile('months'),
            'ordinals' => $this->loadTranslationFile('ordinals'),
            'times' => $this->loadTranslationFile('times'),
        ];
    }

    protected function loadTranslationFile(string $file)
    {
        $filename = sprintf('%s/%s.php', $this->getTranslationDirectory(), $file);

        if (! is_file($filename)) {
            throw new TranslationFileMissingException($this->locale, $file);
        }

        return include $filename;
    }

    protected function getTranslationDirectory()
    {
        return __DIR__ . '/lang/' . $this->locale;
    }

    protected function getArrayDot(array $array, string $key)
    {
        $keys = explode('.', $key);

        foreach ($keys as $key) {
            $array = $array[$key];
        }

        return $array;
    }
}
