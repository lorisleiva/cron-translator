<?php

namespace Lorisleiva\CronTranslator;

class CronTranslator
{
    private static $extendedMap = [
        '@yearly' => '0 0 1 1 *',
        '@annually' => '0 0 1 1 *',
        '@monthly' => '0 0 1 * *',
        '@weekly' => '0 0 * * 0',
        '@daily' => '0 0 * * *',
        '@hourly' => '0 * * * *'
    ];

    public static function translate($cron, $locale = 'en', $clock = '12hour')
    {
        if (isset(self::$extendedMap[$cron])) {
            $cron = self::$extendedMap[$cron];
        }

        try {
            $fields = static::parseFields($cron, $locale, $clock);
            $orderedFields = static::orderFields($fields);
            $fieldsAsObject = static::getFieldsAsObject($fields);

            $translations = array_map(function ($field) use ($fieldsAsObject) {
                return $field->translate($fieldsAsObject);
            }, $orderedFields);

            return ucfirst(implode(' ', array_filter($translations)));
        } catch (\Throwable $th) {
            throw new CronParsingException($cron);
        }
    }

    protected static function parseFields($cron, $locale, $clock)
    {
        $fields = explode(' ', $cron);

        return [
            new MinutesField($fields[0], $locale, $clock),
            new HoursField($fields[1], $locale, $clock),
            new DaysOfMonthField($fields[2], $locale, $clock),
            new MonthsField($fields[3], $locale, $clock),
            new DaysOfWeekField($fields[4], $locale, $clock),
        ];
    }

    protected static function orderFields($fields)
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

    protected static function filterType($fields, ...$types)
    {
        return array_filter($fields, function ($field) use ($types) {
            return $field->hasType(...$types);
        });
    }

    protected static function getFieldsAsObject($fields)
    {
        return (object) [
            'minute' => $fields[0],
            'hour' => $fields[1],
            'day' => $fields[2],
            'month' => $fields[3],
            'weekday' => $fields[4],
        ];
    }
}
