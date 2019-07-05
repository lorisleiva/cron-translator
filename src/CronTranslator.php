<?php

namespace Lorisleiva\CronTranslator;

class CronTranslator
{
    public static function translate($cron)
    {
        $fields = static::parseFields($cron);
        $orderedFields = static::orderFields($fields);
        $result = [];
    
        for ($i=0; $i < count($orderedFields); $i++) {
          $prev = $orderedFields[$i-1] ?? null;
          $current = $orderedFields[$i];
          $next = $orderedFields[$i+1] ?? null;
    
          $result[] = $current->translate($fields, $prev, $next);
        }
    
        return ucfirst(implode(' ', array_filter($result)));
    }

    protected static function parseFields($cron)
    {
        $fields = explode(' ', $cron);

        return [
            new MinutesField($fields[0]),
            new HoursField($fields[1]),
            new DaysOfMonthField($fields[2]),
            new MonthsField($fields[3]),
            new DaysOfWeekField($fields[4]),
        ];
    }

    protected static function orderFields($fields)
    {
        $everys = array_filter($fields, function ($field) {
            return $field->hasType('Every');
        });

        $incrementsAndMultiples = array_filter($fields, function ($field) {
            return $field->hasType('Increment', 'Multiple');
        });

        $onces = array_filter($fields, function ($field) {
            return $field->hasType('Once');
        });

        foreach (array_slice($everys, 1) as $field) {
            $field->dropped = true;
        }

        return array_merge(
            array_slice($everys, 0, 1),
            $incrementsAndMultiples,
            array_reverse($onces)
        );
    }
}
