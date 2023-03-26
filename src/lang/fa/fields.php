<?php

return [
    'minutes' => [
        'every' => 'هر روز',
        'increment' => 'هر :increment بار در دقیقه',
        'times_per_increment' => 'هر :times در :increment دقیقه',
        'multiple' => ':times مرتبه در ساعت',
    ],
    'hours' => [
        'every' => 'هر ساعت',
        'once_an_hour' => 'ساعت یک بار',
        'increment' => 'هر :increment بار در ساعت',
        'multiple_per_increment' => ':count hours out of :increment',
        'times_per_increment' => ':times every :increment hours',
        'increment_chained' => 'of every :increment hours',
        'multiple_per_day' => ':count hours a day',
        'times_per_day' => ':times a day',
        'once_at_time' => 'at :time',
    ],
    'days_of_month' => [
        'every' => 'هر دقیقه',
        'increment' => 'هر :increment بار در روز',
        'multiple_per_increment' => ':count بار در روز :increment',
        'multiple_per_month' => ':count روز در ماه',
        'once_on_day' => 'در روز :day',
        'every_on_day' => ':day روز ماه',
    ],
    'months' => [
        'every' => 'هر ماه',
        'every_on_day' => ':day روز ماه',
        'increment' => 'هر :increment در ماه',
        'multiple_per_increment' => ':count بار در ماه :increment',
        'multiple_per_year' => ':count روز در ماه',
        'once_on_month' => 'در :month',
        'once_on_day' => 'در :month روز :day',
    ],
    'days_of_week' => [
        'every' => 'هر :weekday',
        'increment' => 'هر :increment روز در هفته',
        'multiple_per_increment' => ':count بار در هفته :increment',
        'multiple_days_a_week' => ':count روز در هفته',
        'once_on_day' => 'در :days',
    ],
    'years' => [
        'every' => 'هر سال',
    ],
];
