<?php

return [
    'minutes' => [
        'every' => 'în fiecare minut',
        'increment' => 'în fiecare :increment minute',
        'times_per_increment' => ':times fiecare :increment minute',
        'multiple' => ':times pe oră',
    ],
    'hours' => [
        'every' => 'în fiecare oră',
        'once_an_hour' => 'o singură dată pe oră',
        'increment' => 'în fiecare :increment ore',
        'multiple_per_increment' => ':count ore din :increment',
        'times_per_increment' => ':times fiecare :increment ore',
        'increment_chained' => 'în fiecare :increment ore',
        'multiple_per_day' => 'de :count ori pe zi',
        'times_per_day' => ':times pe zi',
        'once_at_time' => 'la :time',
    ],
    'days_of_month' => [
        'every' => 'în fiecare zi',
        'increment' => 'în fiecare :increment zile',
        'multiple_per_increment' => ':count ore din :increment',
        'multiple_per_month' => ':count zile pe lună',
        'once_on_day' => 'în data de :day',
        'every_on_day' => 'în data de :day a fiecărei luni',
    ],
    'months' => [
        'every' => 'în fiecare lună',
        'every_on_day' => 'pe data de :day a fiecărei luni',
        'increment' => 'în fiecare :increment luni',
        'multiple_per_increment' => ':count luni din :increment',
        'multiple_per_year' => ':count luni pe an',
        'once_on_month' => 'în luna :month',
        'once_on_day' => 'în luna :month pe data de :day',
    ],
    'days_of_week' => [
        'every' => 'în fiecare :weekday',
        'increment' => 'în fiecare :increment zile din săptămână',
        'multiple_per_increment' => ':count zile ale săptămânii din :increment',
        'multiple_days_a_week' => ':count zile ale săptămânii',
        'once_on_day' => 'în zilele de :day',
    ],
    'years' => [
        'every' => 'în fiecare an',
    ],
];
