<?php

return [
    'extended' => [
        '@reboot' => 'başlangıçta bir kez',
    ],
    'minutes' => [
        'every' => 'her dakika',
        'increment' => 'her :increment dakikada bir',
        'times_per_increment' => ':times her :increment dakikada bir',
        'multiple' => 'saatte :times',
    ],
    'hours' => [
        'every' => 'her saat',
        'once_an_hour' => 'saatte bir',
        'increment' => 'her :increment saatte bir',
        'multiple_per_increment' => ':increment saatten :count',
        'times_per_increment' => ':times her :increment saatte bir',
        'increment_chained' => 'her :increment saatte bir',
        'multiple_per_day' => 'günde :count saat',
        'times_per_day' => 'günde :times',
        'once_at_time' => 'saat :time',
    ],
    'days_of_month' => [
        'every' => 'her gün',
        'increment' => 'her :increment günde bir',
        'multiple_per_increment' => ':increment günden :count',
        'multiple_per_month' => 'ayda :count gün',
        'once_on_day' => 'ayın :day günü',
        'every_on_day' => 'her ayın :day günü',
    ],
    'months' => [
        'every' => 'her ay',
        'every_on_day' => 'her ayın :day günü',
        'increment' => 'her :increment ayda bir',
        'multiple_per_increment' => ':increment aydan :count',
        'multiple_per_year' => 'yılda :count ay',
        'once_on_month' => ':month ayında',
        'once_on_day' => ':month ayında :day günü',
    ],
    'days_of_week' => [
        'every' => 'her :weekday',
        'increment' => 'her :increment haftada bir',
        'multiple_per_increment' => ':increment haftadan :count gün',
        'multiple_days_a_week' => 'haftada :count gün',
        'once_on_day' => ':day günü',
    ],
    'years' => [
        'every' => 'her yıl',
    ],
    'times' => [
        'am' => ' sabah',
        'pm' => ' akşam',
    ],
    'connector' => [
        'and' => 've',
    ],
];
