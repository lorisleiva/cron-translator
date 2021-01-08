<?php

return [
    'times' => [
        'once' => 'une fois',
        'twice' => 'deux fois',
        'count' => ':count fois'
    ],
    'minutes' => [
        'every_minute' => 'chaque minute',
        'every_few_minutes' => 'toutes les :increment minutes',
        'multiple_times_every_few_minutes' => ':times toutes les :increment minutes',
        'multiple_times_an_hour' => ':times par heure',
    ],
    'hours' => [
        'every_hour' => 'chaque heure',
        'once_an_hour' => 'une fois par heure',
        'every_few_hours' => 'toutes les :increment heures',
        'multiple_hours_out_of_few' => ':count heures au-delà de :increment',
        'multiple_times_every_few_hours' => ':count toutes les :increment heures',
        'multiple_every_few_hours' => 'toutes les :increment heures',
        'multiple_hours_a_day' => ':count heures par jour',
        'multiple_times_a_day' => ':times fois par jour',
        'once_an_hour_at_time' => 'à :time'
    ],
    'days_of_week' => [
        'every_year' => 'chaque année',
        'every_few_days_of_the_week' => 'tous les :increment jours de la semaine',
        'multiple_days_out_of_few' => ':count jours de la semaine sur :increment',
        'multiple_days_a_week' => ':count jours par semaine',
        'once_on_day' => 'les :days'
    ],
    'days_of_month' => [
        'every_day' => 'tous les jours',
        'every_once_on_day' => 'chaque :weekday',
        'every_few_days' => 'tous les :increment jours',
        'multiple_days_out_of_few' => ':count jours sur :increment',
        'multiple_days_a_month' => ':count jours par mois',
        'once_on_day' => 'le :day',
        'once_on_day_of_every_month' => 'le :day de chaque mois'
    ],
    'months' => [
        'every_month' => 'chaque mois',
        'every_once_on_day' => 'le :day de chaque mois',
        'every_few_months' => 'tous les :increment mois',
        'multiple_months_out_of_few' => ':count mois sur :increment',
        'multiple_months_a_year' => ':count mois par an',
        'once_on_month' => 'en :month',
        'once_on_day_of_month' => 'en :month le :day'
    ]
];
