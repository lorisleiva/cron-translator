<?php

return [
    'minutes' => [
        'every' => 'jede Minute',
        'increment' => 'alle :increment Minuten',
        'times_per_increment' => ':times mal alle :increment Minuten',
        'multiple' => ':times mal pro Stunde',
    ],
    'hours' => [
        'every' => 'jede Stunde',
        'once_an_hour' => 'einmal pro Stunde',
        'increment' => 'alle :increment Stunden',
        'multiple_per_increment' => ':count Stunden aus :increment',
        'times_per_increment' => ':timesmal alle :increment Stunden',
        'increment_chained' => 'alle :increment Stunden',
        'multiple_per_day' => ':count Stunden pro Tag',
        'times_per_day' => ':times mal am Tag',
        'once_at_time' => 'um :time Uhr',
    ],
    'days_of_month' => [
        'every' => 'jeden Tag',
        'increment' => 'alle :increment Tage',
        'multiple_per_increment' => ':count Tage von :increment',
        'multiple_per_month' => ':count Tage im Monat',
        'once_on_day' => 'am :day',
        'every_on_day' => 'am :day eines jeden Monats',
    ],
    'months' => [
        'every' => 'eines jeden Monat',
        'every_on_day' => 'jeden :day eines jeden Monats',
        'increment' => 'alle :increment Monate',
        'multiple_per_increment' => ':count Monate von :increment',
        'multiple_per_year' => ':count Monate im Jahr',
        'once_on_month' => 'im :month',
        'once_on_day' => 'am :day :month',
    ],
    'days_of_week' => [
        'every' => 'jeden :weekday',
        'increment' => 'jeden :increment Tag der Woche',
        'multiple_per_increment' => ':count Tage in der Woche aus :increment',
        'multiple_days_a_week' => ':count Tage in der Woche',
        #'once_on_day' => 'jeden :days',
        #'once_on_day' => 'am :days',
        'once_on_day' => 'an jedem :day',
    ],
    'years' => [
        'every' => 'jedes Jahr',
    ],
    'times' => [
        'am' => 'am',
        'pm' => 'pm',
    ],
];
