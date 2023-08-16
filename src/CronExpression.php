<?php

namespace Lorisleiva\CronTranslator;

/**
 * Class for parsing and translating cron expressions
 */
class CronExpression
{
    public string $raw;
    public MinutesField $minute;
    public HoursField $hour;
    public DaysOfMonthField $day;
    public MonthsField $month;
    public DaysOfWeekField $weekday;
    public bool $timeFormat24hours;
    public array $translations;


    /**
     * Constructs a new instance of the class.
     *
     * @param string $cron The cron expression.
     * @param array $translations Optional translations for field values.
     * @param bool $timeFormat24hours Whether to use 24-hour time format.
     */
    public function __construct(string $cron, array $translations = [], bool $timeFormat24hours = false)
    {
        $this->raw = $cron;
        $fields = explode(' ', $cron);

        $this->minute = new MinutesField($this, $fields[0]);
        $this->hour = new HoursField($this, $fields[1]);
        $this->day = new DaysOfMonthField($this, $fields[2]);
        $this->month = new MonthsField($this, $fields[3]);
        $this->weekday = new DaysOfWeekField($this, $fields[4]);

        $this->timeFormat24hours = $timeFormat24hours;

        $this->translations = $translations;
    }

    /**
     * Get the cron fields
     *
     * @return array
     */
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

    /**
     * Get localized countable translation
     *
     * @param string $type The translation type
     * @param int $number The number
     * @param string $case The grammatical case
     * 
     * @return array|string The translated string
     */
    public function langCountable(string $type, int $number, string $case = 'nominative'): array|string
    {
        $array = $this->translations[$type];

        $value = $array[$case][$number] ?? $array[$number] ?? $array[$case]['default'] ?? $array['default'] ?? '';

        return str_replace(':number', $number, $value);
    }

    /**
     * Get a localized translation
     * 
     * @param string $key The translation key
     * @param array $replacements The replacements
     *
     * @return string The translated string
     */
    public function lang(string $key, array $replacements = []): string
    {
        $translation = $this->getArrayDot($this->translations['fields'], $key);

        foreach ($replacements as $transKey => $value) {
            $translation = str_replace(':' . $transKey, $value, $translation);
        }

        return $this->pluralize($translation);
    }

    /**
     * Get a nested array value using dot notation 
     *
     * @param array $array The array
     * @param string $key The key
     *
     * @return mixed The array value
     */
    protected function getArrayDot(array $array, string $key): mixed
    {
        $keys = explode('.', $key);

        foreach ($keys as $item) {
            $array = $array[$item];
        }

        return $array;
    }

    /**
     * Pluralize a string based on counts and forms
     *
     * @param string $inputString The input string
     *
     * @return string The pluralized string
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
     * Decline a count value based on forms
     *
     * @param int $count The count
     * @param string $forms The forms
     *
     * @return string The declined form
     */
    protected function declineCount(int $count, string $forms): string
    {
        $formsArray = explode('|', $forms);

        if (count($formsArray) < 3) {
            $formsArray[2] = $formsArray[1];
        }

        $cases = [2, 0, 1, 1, 1, 2];

        $count = abs((int)strip_tags($count));

        $formIndex = ($count % 100 > 4 && $count % 100 < 20)
            ? 2
            : $cases[min($count % 10, 5)];

        return $formsArray[$formIndex];
    }
}
