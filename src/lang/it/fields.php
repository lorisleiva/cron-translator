<?php

return [
    'extended' => [
        '@reboot' => 'lanciato una volta all\'avvio',
    ],
    'minutes' => [
        'every' => 'ogni minuto',
        'increment' => 'ogni :increment minuti',
        'times_per_increment' => ':times ogni :increment minuti',
        'multiple' => ':times all\'ora',
    ],
    'hours' => [
        'every' => 'ogni ora',
        'once_an_hour' => 'una volta all\'ora',
        'increment' => 'ogni :increment ore',
        'multiple_per_increment' => ':count ore ogni :increment',
        'times_per_increment' => ':times ogni :increment ore',
        'increment_chained' => 'di ogni :increment ore',
        'multiple_per_day' => ':count ore al giorno',
        'times_per_day' => ':times al giorno',
        'once_at_time' => 'alle :time',
    ],
    'days_of_month' => [
        'every' => 'ogni giorno',
        'increment' => 'ogni :increment giorni',
        'multiple_per_increment' => ':count giorni ogni :increment',
        'multiple_per_month' => ':count giorni al mese',
        'once_on_day' => 'nel :day giorno',
        'every_on_day' => 'nel :day giorno di ogni mese',
    ],
    'months' => [
        'every' => 'ogni mese',
        'every_on_day' => 'nel :day giorno di ogni mese',
        'increment' => 'ogni :increment mesi',
        'multiple_per_increment' => ':count mesi ogni :increment',
        'multiple_per_year' => ':count mesi all\'anno',
        'once_on_month' => 'nel mese di :month',
        'once_on_day' => 'nel mese di :month e nel :day giorno',
    ],
    'days_of_week' => [
        'every' => 'ogni :weekday',
        'increment' => 'ogni :increment giorni della settimana',
        'multiple_per_increment' => ':count giorni della settimana ogni :increment',
        'multiple_days_a_week' => ':count giorni alla settimana',
        'once_on_day' => 'nel giorno :day',
    ],
    'years' => [
        'every' => 'ogni anno',
    ],
    'times' => [
        'am' => 'am',
        'pm' => 'pm',
    ],
];
