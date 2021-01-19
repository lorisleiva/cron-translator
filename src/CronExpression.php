<?php

namespace Lorisleiva\CronTranslator;

class CronExpression
{
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

    public function __construct(string $cron, string $locale, bool $timeFormat24hours = false)
    {
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
            'months' => $this->loadTranslationFile('months'),
            'ordinals' => $this->loadTranslationFile('ordinals'),
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

    public function lang(string $key, array $replacements = [])
    {
        //
    }
}
