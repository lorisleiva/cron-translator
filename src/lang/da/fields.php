<?php

return [
    'extended' => [
        '@reboot' => 'kør ved opstart',
    ],
    'minutes' => [
        'every' => 'hvert minut',
        'increment' => 'hver :increment. minut',
        'times_per_increment' => ':times gange hver :increment. minut',
        'multiple' => ':times i timen',
    ],
    'hours' => [
        'every' => 'hver time',
        'once_an_hour' => 'en gang i timen',
        'increment' => 'hver :increment. time',
        'multiple_per_increment' => ':count timer ud af :increment',
        'times_per_increment' => ':times gang hver :increment. time',
        'increment_chained' => 'for hver :increment. time',
        'multiple_per_day' => ':count timer om dagen',
        'times_per_day' => ':times gange om dagen',
        'once_at_time' => 'kl. :time',
    ],
    'days_of_month' => [
        'every' => 'alle dage',
        'increment' => 'hver :increment. dag',
        'multiple_per_increment' => ':ud af :increment dage',
        'multiple_per_month' => ':count dage om måneden',
        'once_on_day' => 'på dag :day',
        'every_on_day' => 'den :day hver måned',
    ],
    'months' => [
        'every' => 'hver måned',
        'every_on_day' => 'den :day hver måned',
        'increment' => 'hver :increment. måned',
        'multiple_per_increment' => ':count ud af :increment måneder',
        'multiple_per_year' => ':count måneder om året',
        'once_on_month' => 'i :month',
        'once_on_day' => 'den :day :month',
    ],
    'days_of_week' => [
        'every' => 'hver :weekday',
        'increment' => 'hver :increment dage om ugen',
        'multiple_per_increment' => ':count dage om ugen ud af :increment',
        'multiple_days_a_week' => ':count dage om ugen',
        'once_on_day' => 'på :daye',
    ],
    'years' => [
        'every' => 'hvert år',
    ],
    'times' => [
        'am' => 'am',
        'pm' => 'pm',
    ],
];
