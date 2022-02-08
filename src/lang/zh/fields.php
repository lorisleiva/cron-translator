<?php

return [
    'minutes' => [
        'every' => '每分钟',
        'increment' => '每 :increment 分钟',
        'times_per_increment' => ':times 每 :increment 分钟',
        'multiple' => ':times 一小时',
    ],
    'hours' => [
        'every' => '每小时',
        'once_an_hour' => '一小时一次',
        'increment' => '每 :increment 小时',
        'multiple_per_increment' => '每 :increment 小时中有 :count 小时',
        'times_per_increment' => '每 :increment 小时 :times',
        'increment_chained' => '每 :increment 小时',
        'multiple_per_day' => '每天有 :count 小时',
        'times_per_day' => '每天 :times',
        'once_at_time' => ':time 点',
    ],
    'days_of_month' => [
        'every' => '每天',
        'increment' => '每 :increment 天',
        'multiple_per_increment' => '每 :increment 天中有 :count 天',
        'multiple_per_month' => '每月 :count 天',
        'once_on_day' => ':day 号',
        'every_on_day' => '每月 :day 号',
    ],
    'months' => [
        'every' => '每月',
        'every_on_day' => '每月 :day 号',
        'increment' => '每 :increment 月',
        'multiple_per_increment' => '每 :increment 月中有 :count 月',
        'multiple_per_year' => '每年 :count 个月',
        'once_on_month' => ':month 月',
        'once_on_day' => ':month 月 :day 号',
    ],
    'days_of_week' => [
        'every' => '每周 :weekday',
        'increment' => '每周 :increment 天',
        'multiple_per_increment' => '每 :increment 周中有 :count 天',
        'multiple_days_a_week' => '一周 :count 天',
        'once_on_day' => '周 :days',
    ],
    'years' => [
        'every' => '每年',
    ],
];
