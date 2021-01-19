<?php

return [
    'minutes' => [
        'every' => 'every minute',
        'increment' => 'every :increment minutes',
        'times_per_increment' => ':times every :increment minutes',
        'multiple' => ':times an hour',
    ],
    'hours' => [
        'every' => 'every hour',
        'once_an_hour' => 'once an hour',
        'every_few_hours' => 'every :increment hours',
        'multiple_hours_out_of_few' => ':count hours out of :increment',
        'multiple_times_every_few_hours' => ':count every :increment hours',
        'multiple_every_few_hours' => 'of every :increment hours',
        'multiple_hours_a_day' => ':count hours a day',
        'multiple_times_a_day' => ':times a day',
        'once_an_hour_at_time' => 'at :time'
    ],
    'days_of_week' => [
        'every' => 'every year',
        'every_few_days_of_the_week' => 'every :increment days of the week',
        'multiple_days_out_of_few' => ':count days of the week out of :increment',
        'multiple_days_a_week' => ':count days a week',
        'once_on_day' => 'on :days'
    ],
    'days_of_month' => [
        'every' => 'every day',
        'every_once_on_day' => 'every :weekday',
        'every_few_days' => 'every :increment days',
        'multiple_days_out_of_few' => ':count days out of :increment',
        'multiple_days_a_month' => ':count days a month',
        'once_on_day' => 'on the :day',
        'once_on_day_of_every' => 'on the :day of every month'
    ],
    'months' => [
        'every' => 'every month',
        'every_once_on_day' => 'the :day of every month',
        'every_few_months' => 'every :increment months',
        'multiple_months_out_of_few' => ':count months out of :increment',
        'multiple_months_a_year' => ':count months a year',
        'once_on_month' => 'on :month',
        'once_on_day_of_month' => 'on :month the :day'
    ]
];
