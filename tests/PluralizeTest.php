<?php

use PHPUnit\Framework\TestCase;
use Lorisleiva\CronTranslator\CronExpression;

class PluralizeTest extends TestCase
{
    public function testPluralize(): void
    {
        $CronExpression = new CronExpression('*/5 * * * *');

        $this->assertEquals('1 день 2 часа 5 минут', $CronExpression->pluralize('1 {день|дня|дней} 2 {час|часа|часов} 5 {минута|минуты|минут}'));

        $this->assertEquals('1 day 2 hours 5 minutes', $CronExpression->pluralize('1 {day|days} 2 {hour|hours} 5 {minute|minutes}'));
    }
}
