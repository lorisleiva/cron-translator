<?php

return [
    'minutes' => [
        'every' => 'ogni minuto',
        'increment' => 'ogni :increment minuti',
        'times_per_increment' => ':times ogni :increment minuti',
        'multiple' => ':times all\'ora',
    ],
    'hours' => [
        'every' => 'ogni ora',
        'once_an_hour' => 'una volta l\'ora',
        'increment' => 'ogni :increment ore',
        'multiple_per_increment' => ':count ore fuori di :increment',
        'times_per_increment' => ':times ogni :increment ore',
        'increment_chained' => 'di ogni :increment ore',
        'multiple_per_day' => ':count ore al giorno',
        'times_per_day' => ':times al giorno',
        'once_at_time' => 'a :time',
    ],
    'days_of_month' => [
        'every' => 'ogni giorno',
        'increment' => 'ogni :increment giorni',
        'multiple_per_increment' => ':count giorni fuori di :increment',
        'multiple_per_month' => ':count giorni al mese',
        'once_on_day' => 'al :day',
        'every_on_day' => 'al :day di ogni mese',
    ],
    'months' => [
        'every' => 'ogni mese',
        'every_on_day' => 'il :day di ogni mese',
        'increment' => 'ogni :increment mesi',
        'multiple_per_increment' => ':count mesi fuori di :increment',
        'multiple_per_year' => ':count mesi all\'anno',
        'once_on_month' => 'a :month',
        'once_on_day' => 'a :month il :day',
    ],
    'days_of_week' => [
        'every' => 'ogni :weekday',
        'increment' => 'ogni :increment giorni della settimana',
        'multiple_per_increment' => ':count giorni della settimana fuori di :increment',
        'multiple_days_a_week' => ':count giorni a settimana',
        'once_on_day' => 'a :days',
    ],
    'years' => [
        'every' => 'ogni anno',
    ],
];
