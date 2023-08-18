<?php

return [
    'extended' => [
        '@reboot' => 'один раз при старте',
    ],
    'minutes' => [
        'every' => 'каждую минуту',
        'increment' => 'каждые :increment {минута|минуты|минут}',
        'times_per_increment' => ':times каждые :increment {минута|минуты|минут}',
        'multiple' => ':times в час',
    ],
    'hours' => [
        'every' => 'каждый час',
        'once_an_hour' => 'раз в час',
        'increment' => 'каждые :increment {час|часа|часов}',
        'multiple_per_increment' => ':count {час|часа|часов} из :increment',
        'times_per_increment' => ':times каждые :increment {час|часа|часов}',
        'increment_chained' => 'каждые :increment {час|часа|часов}',
        'multiple_per_day' => ':count {час|часа|часов} в день',
        'times_per_day' => ':times в день',
        'once_at_time' => 'в :time',
    ],
    'days_of_month' => [
        'every' => 'каждый день',
        'increment' => 'каждые :increment {день|дня|дней}',
        'multiple_per_increment' => ':count {день|дня|дней} из :increment',
        'multiple_per_month' => ':count {день|дня|дней} в месяц',
        'once_on_day' => 'на :day число',
        'every_on_day' => ':day числа каждого месяца',
    ],
    'months' => [
        'every' => 'каждый месяц',
        'every_on_day' => ':day число каждого месяца',
        'increment' => 'каждые :increment {месяц|месяца|месяцев}',
        'multiple_per_increment' => ':count {месяц|месяца|месяцев} из :increment',
        'multiple_per_year' => ':count {месяц|месяца|месяцев} в год',
        'once_on_month' => 'в :month',
        'once_on_day' => 'в :month :day числа',
    ],
    'days_of_week' => [
        'every' => 'каждую неделю :weekday',
        'increment' => 'Каждые :increment дни недели',
        'multiple_per_increment' => ':count {день|дня|дней} недели из :increment',
        'multiple_days_a_week' => ':count {день|дня|дней} в неделю',
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
