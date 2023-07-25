<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorZhTWTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('每分鐘', '* * * * *');
        $this->assertCronTranslateTo('每分鐘 在週日', '* * * * 0');
        $this->assertCronTranslateTo('每分鐘 在一月', '* * * 1 *');
        $this->assertCronTranslateTo('每分鐘 在週日 在一月', '* * * 1 0');
        $this->assertCronTranslateTo('每分鐘 在每月1日', '* * 1 * *');
        $this->assertCronTranslateTo('每分鐘 在週日 在每月1日', '* * 1 * 0');
        $this->assertCronTranslateTo('每分鐘 在一月1日', '* * 1 1 *');
        $this->assertCronTranslateTo('每分鐘 在週日 在一月1日', '* * 1 1 0');
        $this->assertCronTranslateTo('每分鐘 在12am', '* 0 * * *');
        $this->assertCronTranslateTo('每分鐘 在週日 在12am', '* 0 * * 0');
        $this->assertCronTranslateTo('每分鐘 在一月 在12am', '* 0 * 1 *');
        $this->assertCronTranslateTo('每分鐘 在週日 在一月 在12am', '* 0 * 1 0');
        $this->assertCronTranslateTo('每分鐘 在每月1日 在12am', '* 0 1 * *');
        $this->assertCronTranslateTo('每分鐘 在週日 在每月1日 在12am', '* 0 1 * 0');
        $this->assertCronTranslateTo('每分鐘 在一月1日 在12am', '* 0 1 1 *');
        $this->assertCronTranslateTo('每分鐘 在週日 在一月1日 在12am', '* 0 1 1 0');
        $this->assertCronTranslateTo('每整點', '0 * * * *');
        $this->assertCronTranslateTo('每整點 在週日', '0 * * * 0');
        $this->assertCronTranslateTo('每整點 在一月', '0 * * 1 *');
        $this->assertCronTranslateTo('每整點 在週日 在一月', '0 * * 1 0');
        $this->assertCronTranslateTo('每整點 在每月1日', '0 * 1 * *');
        $this->assertCronTranslateTo('每整點 在週日 在每月1日', '0 * 1 * 0');
        $this->assertCronTranslateTo('每整點 在一月1日', '0 * 1 1 *');
        $this->assertCronTranslateTo('每整點 在週日 在一月1日', '0 * 1 1 0');
        $this->assertCronTranslateTo('每天 在12:00am', '0 0 * * *');
        $this->assertCronTranslateTo('每週週日 在12:00am', '0 0 * * 0');
        $this->assertCronTranslateTo('每天 在一月 在12:00am', '0 0 * 1 *');
        $this->assertCronTranslateTo('每週週日 在一月 在12:00am', '0 0 * 1 0');
        $this->assertCronTranslateTo('每月1日 在12:00am', '0 0 1 * *');
        $this->assertCronTranslateTo('每月1日 在週日 在12:00am', '0 0 1 * 0');
        $this->assertCronTranslateTo('每年 在一月1日 在12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('在週日 在一月1日 在12:00am', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateTo('每年 在一月1日 在12:00pm', '0 12 1 1 *');
        $this->assertCronTranslateTo('每分鐘 在週一 在3pm', '* 15 * * 1');
        $this->assertCronTranslateTo('每分鐘 在一月3日', '* * 3 1 *');
        $this->assertCronTranslateTo('每分鐘 在週一 在四月', '* * * 4 1');
        $this->assertCronTranslateTo('在週一 在四月22日 在3:10pm', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateTo('每天 在10:00pm', '0 22 * * *');
        $this->assertCronTranslateTo('每天 在9:00am', '0 9 * * *');
        $this->assertCronTranslateTo('每週週一 在4:00pm', '0 16 * * 1');
        $this->assertCronTranslateTo('每年 在一月1日 在12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('每月1日 在12:00am', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('每分鐘 每天有2小時', '* 8,18 * * *');
        $this->assertCronTranslateTo('每分鐘 每天有3小時', '* 8,18,20 * * *');
        $this->assertCronTranslateTo('每分鐘 每天有20小時', '* 1-20 * * *');
        $this->assertCronTranslateTo('一小時2次', '0,30 * * * *');
        $this->assertCronTranslateTo('一小時2次 每天有5小時', '0,30 1-5 * * *');
        $this->assertCronTranslateTo('每天5次', '0 1-5 * * *');
        $this->assertCronTranslateTo('每分鐘 每天有5小時', '* 1-5 * * *');
        $this->assertCronTranslateTo('每月5天 在1:00am', '0 1 1-5 * *');
        $this->assertCronTranslateTo('每月5天 每年2個月 在1:00am', '0 1 1-5 5,6 *');
        $this->assertCronTranslateTo('每年2個月 在5日 在1:00am', '0 1 5 5,6 *');
        $this->assertCronTranslateTo('每月5日 一週4天 在1:00am', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('每2分鐘', '*/2 * * * *');
        $this->assertCronTranslateTo('每2分鐘', '1/2 * * * *');
        $this->assertCronTranslateTo('每4分鐘2次', '1,3/4 * * * *');
        $this->assertCronTranslateTo('每5分鐘3次', '1-3/5 * * * *');
        $this->assertCronTranslateTo('每2分鐘 在2pm', '*/2 14 * * *');
        $this->assertCronTranslateTo('每整點 每2天', '0 * */2 * *');
        $this->assertCronTranslateTo('每分鐘 每2天', '* * */2 * *');
        $this->assertCronTranslateTo('每2小時1次', '0 */2 * * *');
        $this->assertCronTranslateTo('每5小時2次', '0 1,2/5 * * *');
        $this->assertCronTranslateTo('每分鐘 每5小時中有2小時', '* 1,2/5 * * *');
        $this->assertCronTranslateTo('每天 每4個月 在12:00am', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('每分鐘 每2小時', '* */2 * * *');
        $this->assertCronTranslateTo('每分鐘 每3小時 在每月2日', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('每分鐘 在8am', '* 8-8 * * *');
        $this->assertCronTranslateTo('每分鐘 在一月', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('每整點', '@hourly');
        $this->assertCronTranslateTo('每天 在12:00am', '@daily');
        $this->assertCronTranslateTo('每週週日 在12:00am', '@weekly');
        $this->assertCronTranslateTo('每月1日 在12:00am', '@monthly');
        $this->assertCronTranslateTo('每年 在一月1日 在12:00am', '@yearly');
        $this->assertCronTranslateTo('每年 在一月1日 在12:00am', '@annually');
    }

    public function assertCronTranslateTo(string $expected, string $actual, string $locale = 'zh-TW', bool $timeFormat24hours = false): void
    {
        parent::assertCronTranslateTo($expected, $actual, $locale, $timeFormat24hours);
    }
}
