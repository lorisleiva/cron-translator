<?php

return [
    'extended' => [
        '@reboot' => 'spustit jednou při spuštění',
    ],
    'minutes' => [
        'every' => 'každou minutu',
        'increment' => 'každých :increment minut',
        'times_per_increment' => ':times krát každých :increment minut',
        'multiple' => ':times krát za hodinu',
    ],
    'hours' => [
        'every' => 'každou hodinu',
        'once_an_hour' => 'jednou za hodinu',
        'increment' => 'každých :increment hodin',
        'multiple_per_increment' => ':count hodin z :increment',
        'times_per_increment' => ':times krát každých :increment hodin',
        'increment_chained' => 'z každých :increment hodin',
        'multiple_per_day' => ':count hodin denně',
        'times_per_day' => ':times krát denně',
        'once_at_time' => 'v :time',
    ],
    'days_of_month' => [
        'every' => 'každý den',
        'increment' => 'každých :increment dní',
        'multiple_per_increment' => ':count dní z :increment',
        'multiple_per_month' => ':count dní v měsíci',
        'once_on_day' => 'v :day',
        'every_on_day' => 'každý měsíc v :day',
    ],
    'months' => [
        'every' => 'každý měsíc',
        'every_on_day' => 'každého měsíce :day',
        'increment' => 'každých :increment měsíců',
        'multiple_per_increment' => ':count měsíců z :increment',
        'multiple_per_year' => ':count měsíců ročně',
        'once_on_month' => 'v :month',
        'once_on_day' => 'v :month, :day',
    ],
    'days_of_week' => [
        'every' => 'každé :weekday',
        'increment' => 'každých :increment dní v týdnu',
        'multiple_per_increment' => ':count dní v týdnu z :increment',
        'multiple_days_a_week' => ':count dny týdně',
        'once_on_day' => 'v :days',
    ],
    'years' => [
        'every' => 'každý rok',
    ],
    'times' => [
        'am' => ' dop.',
        'pm' => ' odp.',
    ],
];
