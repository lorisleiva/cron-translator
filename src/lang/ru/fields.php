<?php

return [
    'minutes' => [
        'every' => 'каждую минуту',
        'increment' => 'каждые :increment мин.',
        'times_per_increment' => ':times каждые :increment мин.',
        'multiple' => ':times в час',
    ],
    'hours' => [
        'every' => 'каждый час',
        'once_an_hour' => 'раз в час',
        'increment' => 'каждые :increment ч',
        'multiple_per_increment' => ':count ч из :increment',
        'times_per_increment' => ':times каждые :increment ч',
        'increment_chained' => 'каждые :increment ч',
        'multiple_per_day' => ':count ч в день',
        'times_per_day' => ':times в день',
        'once_at_time' => 'в :time',
    ],
    'days_of_month' => [
        'every' => 'каждый день',
        'increment' => 'каждые :increment дн.',
        'multiple_per_increment' => ':count дн. из :increment',
        'multiple_per_month' => ':count дн. в месяц',
        'once_on_day' => 'на :day число',
        'every_on_day' => ':day числа каждого месяца',
    ],
    'months' => [
        'every' => 'каждый месяц',
        'every_on_day' => ':day число каждого месяца',
        'increment' => 'каждые :increment мec.',
        'multiple_per_increment' => ':count мес. из :increment',
        'multiple_per_year' => ':count мес. в год',
        'once_on_month' => 'в :month',
        'once_on_day' => 'в :month :day числа',
    ],
    'days_of_week' => [
        'every' => 'каждую неделю :weekday',
        'increment' => 'Каждые :increment дни недели',
        'multiple_per_increment' => ':count дн. недели из :increment',
        'multiple_days_a_week' => ':count дн. в неделю',
        'once_on_day' => 'по :day',
    ],
    'years' => [
        'every' => 'каждый год',
    ],
    'times' => [
        'am' => ' утра',
        'pm' => ' вечера',
    ],
];
