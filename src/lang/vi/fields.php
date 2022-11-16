<?php

return [
    'minutes' => [
        'every' => 'mỗi phút',
        'increment' => 'mỗi :increment phút',
        'times_per_increment' => ':times mỗi :increment phút',
        'multiple' => ':times một giờ',
    ],
    'hours' => [
        'every' => 'mỗi giờ',
        'once_an_hour' => 'mỗi giờ một lần',
        'increment' => 'mỗi :increment giờ',
        'multiple_per_increment' => ':count giờ trong số :increment',
        'times_per_increment' => ':times mỗi :increment giờ',
        'increment_chained' => 'vào mỗi :increment giờ',
        'multiple_per_day' => ':count giờ một ngày',
        'times_per_day' => ':times một ngày',
        'once_at_time' => 'vào lúc :time',
    ],
    'days_of_month' => [
        'every' => 'hằng ngày',
        'increment' => 'mỗi :increment ngày',
        'multiple_per_increment' => ':count ngày trong số :increment',
        'multiple_per_month' => ':count ngày một tháng',
        'once_on_day' => 'vào :day',
        'every_on_day' => 'vào :day hàng tháng',
    ],
    'months' => [
        'every' => 'hằng tháng',
        'every_on_day' => ':day hàng tháng',
        'increment' => 'mỗi :increment tháng',
        'multiple_per_increment' => ':count tháng trong số :increment',
        'multiple_per_year' => ':count tháng một năm',
        'once_on_month' => 'vào :month',
        'once_on_day' => 'vào :month :day',
    ],
    'days_of_week' => [
        'every' => 'mỗi :weekday',
        'increment' => 'mỗi :increment trong tuần',
        'multiple_per_increment' => ':count ngày trong tuần trong số :increment',
        'multiple_days_a_week' => ':count ngày một tuần',
        'once_on_day' => 'vào :day',
    ],
    'years' => [
        'every' => 'hằng năm',
    ],
];
