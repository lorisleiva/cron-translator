<?php

return [
    'extended' => [
        '@reboot' => 'spustit jednou při startu',
    ],
    'minutes' => [
        'every' => 'každou minutu',
        'increment' => 'co :increment {minutu|minuty|minut}',
        'times_per_increment' => ':times co :increment {minutu|minuty|minut}',
        'multiple' => ':times za hodinu',
    ],
    'hours' => [
        'every' => 'každou hodinu',
        'once_an_hour' => 'jednou za hodinu',
        'increment' => 'co :increment {hodinu|hodiny|hodin}',
        'multiple_per_increment' => ':count {hodina|hodiny|hodin} z :increment',
        'times_per_increment' => ':times za :increment {hodinu|hodiny|hodin}',
        'increment_chained' => 'co :increment {hodinu|hodiny|hodin}',
        'multiple_per_day' => ':count {hodina|hodiny|hodin} denně',
        'times_per_day' => ':times denně',
        'once_at_time' => 'v :time',
    ],
    'days_of_month' => [
        'every' => 'každý den',
        'increment' => 'co :increment {den|dny|dní}',
        'multiple_per_increment' => ':count {den|dny|dní} z :increment',
        'multiple_per_month' => ':count {den|dny|dní} v měsíci',
        'once_on_day' => 'dne :day',
        'every_on_day' => 'dne :day každého měsíce',
    ],
    'months' => [
        'every' => 'každý měsíc',
        'every_on_day' => 'dne :day každého měsíce',
        'increment' => 'co :increment {měsíc|měsíce|měsíců}',
        'multiple_per_increment' => ':count {měsíc|měsíce|měsíců} z :increment',
        'multiple_per_year' => ':count {měsíc|měsíce|měsíců} ročně',
        'once_on_month' => 'v :month',
        'once_on_day' => 'dne :day v :month',
    ],
    'days_of_week' => [
        'every' => ':weekday',
        'increment' => 'co :increment {den|dny|dní} v týdnu',
        'multiple_per_increment' => ':count {den|dny|dní} v týdnu z :increment',
        'multiple_days_a_week' => ':count {den|dny|dní} v týdnu',
        'once_on_day' => ':day',
    ],
    'years' => [
        'every' => 'každý rok',
    ],
    'times' => [
        'am' => 'am',
        'pm' => 'pm',
    ],
    'connector' => [
        'and' => 'a',
    ],
];
