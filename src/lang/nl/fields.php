<?php

return [
    'minutes' => [
        'every' => 'iedere minuut',
        'increment' => 'iedere :increment minuten',
        'times_per_increment' => ':times keer :increment minuten',
        'multiple' => ':times per uur',
    ],
    'hours' => [
        'every' => 'ieder uur',
        'once_an_hour' => 'een keer per uur',
        'increment' => 'iedere :increment uur',
        'multiple_per_increment' => ':count uur van de :increment',
        'times_per_increment' => ':times keer :increment uur',
        'increment_chained' => 'van iedere :increment uur',
        'multiple_per_day' => ':count uur per dag',
        'times_per_day' => ':times keer per dag',
        'once_at_time' => 'om :time',
    ],
    'days_of_month' => [
        'every' => 'iedere dag',
        'increment' => 'iedere :increment dagen',
        'multiple_per_increment' => ':count dagen van de :increment',
        'multiple_per_month' => ':count dagen per maand',
        'once_on_day' => 'op :day',
        'every_on_day' => 'op :day van iedere maand',
    ],
    'months' => [
        'every' => 'iedere maand',
        'every_on_day' => 'de :day van iedere maand',
        'increment' => 'iedere :increment maanden',
        'multiple_per_increment' => ':count maanden van de :increment',
        'multiple_per_year' => ':count maanden per jaar',
        'once_on_month' => 'in :month',
        'once_on_day' => 'in :month op :day',
    ],
    'days_of_week' => [
        'every' => 'iedere :weekday',
        'increment' => 'iedere :increment dag van de week',
        'multiple_per_increment' => ':count dag van de week van de :increment',
        'multiple_days_a_week' => ':count dagen per week',
        'once_on_day' => 'op :days',
    ],
    'years' => [
        'every' => 'ieder jaar',
    ],
];
