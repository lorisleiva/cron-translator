<?php

return [
    'extended' => [
        '@reboot' => 'один раз при запуску',
    ],
    'minutes' => [
        'every' => 'щохвилини',
        'increment' => 'що :increment {хвилина|хвилини|хвилин}',
        'times_per_increment' => ':times що :increment {хвилина|хвилини|хвилин}',
        'multiple' => ':times на годину',
    ],
    'hours' => [
        'every' => 'щогодини',
        'once_an_hour' => 'раз на годину',
        'increment' => 'що :increment {година|години|годин}',
        'multiple_per_increment' => ':count {година|години|годин} з :increment',
        'times_per_increment' => ':times що :increment {година|години|годин}',
        'increment_chained' => 'що :increment {година|години|годин}',
        'multiple_per_day' => ':count {година|години|годин} на день',
        'times_per_day' => ':times на день',
        'once_at_time' => 'о :time',
    ],
    'days_of_month' => [
        'every' => 'щодня',
        'increment' => 'що :increment {день|дні|днів}',
        'multiple_per_increment' => ':count {день|дні|днів} з :increment',
        'multiple_per_month' => ':count {день|дні|днів} в місяць',
        'once_on_day' => 'на :day число',
        'every_on_day' => 'щомісяця :day числа',
    ],
    'months' => [
        'every' => 'щомісяця',
        'every_on_day' => 'щомісяця :day числа',
        'increment' => 'що :increment {місяць|місяці|місяців}',
        'multiple_per_increment' => ':count {місяць|місяці|місяців} з :increment',
        'multiple_per_year' => ':count {місяць|місяці|місяців} на рік',
        'once_on_month' => 'в :month',
        'once_on_day' => 'в :month :day числа',
    ],
    'days_of_week' => [
        'every' => 'щотижня :weekday',
        'increment' => 'Що :increment дні тижня',
        'multiple_per_increment' => ':count {день|дні|днів} тижня з :increment',
        'multiple_days_a_week' => ':count {день|дні|днів} на тиждень',
        'once_on_day' => 'в :day',
    ],
    'years' => [
        'every' => 'щороку',
    ],
    'times' => [
        'am' => ' ранку',
        'pm' => ' вечора',
    ],
];
