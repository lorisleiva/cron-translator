<?php

return [
    'extended' => [
        '@reboot' => 'raz przy starcie',
    ],
    'minutes' => [
        'every' => 'co minutę',
        'increment' => 'co :increment {minutę|minuty|minut}',
        'times_per_increment' => ':times co :increment {minutę|minuty|minut}',
        'multiple' => ':times na godzinę',
    ],
    'hours' => [
        'every' => 'co godzinę',
        'once_an_hour' => 'raz na godzinę',
        'increment' => 'co :increment {godzinę|godziny|godzin}',
        'multiple_per_increment' => ':count {godzina|godziny|godzin} z :increment',
        'times_per_increment' => ':times co :increment {godzinę|godziny|godzin}',
        'increment_chained' => 'co :increment {godzinę|godziny|godzin}',
        'multiple_per_day' => ':count {godzina|godziny|godzin} dziennie',
        'times_per_day' => ':times dziennie',
        'once_at_time' => 'o :time',
    ],
    'days_of_month' => [
        'every' => 'każdego dnia',
        'increment' => 'co :increment {dzień|dni|dni}',
        'multiple_per_increment' => ':count {dzień|dni|dni} z :increment',
        'multiple_per_month' => ':count {dzień|dni|dni} w miesiącu',
        'once_on_day' => 'dnia :day',
        'every_on_day' => 'w :day dniu miesiąca',
    ],
    'months' => [
        'every' => 'co miesiąc',
        'every_on_day' => 'w :day dniu każdego miesiąca',
        'increment' => 'co :increment {miesiąc|miesiące|miesięcy}',
        'multiple_per_increment' => ':count {miesiąc|miesiące|miesięcy} z :increment',
        'multiple_per_year' => ':count {miesiąc|miesiące|miesięcy} w roku',
        'once_on_month' => 'w :month',
        'once_on_day' => 'w :month dnia :day',
    ],
    'days_of_week' => [
        'every' => ':weekday',
        'increment' => 'co :increment dni tygodnia',
        'multiple_per_increment' => ':count {dzień|dni|dni} tygodnia z :increment',
        'multiple_days_a_week' => ':count {dzień|dni|dni} w tygodniu',
        'once_on_day' => 'w :day',
    ],
    'years' => [
        'every' => 'co roku',
    ],
    'times' => [
        'am' => 'am',
        'pm' => 'pm',
    ],
];
