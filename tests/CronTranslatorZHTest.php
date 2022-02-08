<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorZHTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once()
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('每分钟', '* * * * *');
        $this->assertCronTranslateTo('每分钟 在周日', '* * * * 0');
        $this->assertCronTranslateTo('每分钟 在一月', '* * * 1 *');
        $this->assertCronTranslateTo('每分钟 在周日 在一月', '* * * 1 0');
        $this->assertCronTranslateTo('每分钟 在每月1号', '* * 1 * *');
        $this->assertCronTranslateTo('每分钟 在周日 在每月1号', '* * 1 * 0');
        $this->assertCronTranslateTo('每分钟 在一月1号', '* * 1 1 *');
        $this->assertCronTranslateTo('每分钟 在周日 在一月1号', '* * 1 1 0');
        $this->assertCronTranslateTo('每分钟 在12am', '* 0 * * *');
        $this->assertCronTranslateTo('每分钟 在周日 在12am', '* 0 * * 0');
        $this->assertCronTranslateTo('每分钟 在一月 在12am', '* 0 * 1 *');
        $this->assertCronTranslateTo('每分钟 在周日 在一月 在12am', '* 0 * 1 0');
        $this->assertCronTranslateTo('每分钟 在每月1号 在12am', '* 0 1 * *');
        $this->assertCronTranslateTo('每分钟 在周日 在每月1号 在12am', '* 0 1 * 0');
        $this->assertCronTranslateTo('每分钟 在一月1号 在12am', '* 0 1 1 *');
        $this->assertCronTranslateTo('每分钟 在周日 在一月1号 在12am', '* 0 1 1 0');
        $this->assertCronTranslateTo('每整点', '0 * * * *');
        $this->assertCronTranslateTo('每整点 在周日', '0 * * * 0');
        $this->assertCronTranslateTo('每整点 在一月', '0 * * 1 *');
        $this->assertCronTranslateTo('每整点 在周日 在一月', '0 * * 1 0');
        $this->assertCronTranslateTo('每整点 在每月1号', '0 * 1 * *');
        $this->assertCronTranslateTo('每整点 在周日 在每月1号', '0 * 1 * 0');
        $this->assertCronTranslateTo('每整点 在一月1号', '0 * 1 1 *');
        $this->assertCronTranslateTo('每整点 在周日 在一月1号', '0 * 1 1 0');
        $this->assertCronTranslateTo('每天 在12:00am', '0 0 * * *');
        $this->assertCronTranslateTo('每周周日 在12:00am', '0 0 * * 0');
        $this->assertCronTranslateTo('每天 在一月 在12:00am', '0 0 * 1 *');
        $this->assertCronTranslateTo('每周周日 在一月 在12:00am', '0 0 * 1 0');
        $this->assertCronTranslateTo('每月1号 在12:00am', '0 0 1 * *');
        $this->assertCronTranslateTo('每月1号 在周日 在12:00am', '0 0 1 * 0');
        $this->assertCronTranslateTo('每年 在一月1号 在12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('在周日 在一月1号 在12:00am', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateTo('每年 在一月1号 在12:00pm', '0 12 1 1 *');
        $this->assertCronTranslateTo('每分钟 在周一 在3pm', '* 15 * * 1');
        $this->assertCronTranslateTo('每分钟 在一月3号', '* * 3 1 *');
        $this->assertCronTranslateTo('每分钟 在周一 在四月', '* * * 4 1');
        $this->assertCronTranslateTo('在周一 在四月22号 在3:10pm', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateTo('每天 在10:00pm', '0 22 * * *');
        $this->assertCronTranslateTo('每天 在9:00am', '0 9 * * *');
        $this->assertCronTranslateTo('每周周一 在4:00pm', '0 16 * * 1');
        $this->assertCronTranslateTo('每年 在一月1号 在12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('每月1号 在12:00am', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple()
    {
        $this->assertCronTranslateTo('每分钟 每天有2小时', '* 8,18 * * *');
        $this->assertCronTranslateTo('每分钟 每天有3小时', '* 8,18,20 * * *');
        $this->assertCronTranslateTo('每分钟 每天有20小时', '* 1-20 * * *');
        $this->assertCronTranslateTo('一小时2次', '0,30 * * * *');
        $this->assertCronTranslateTo('一小时2次 每天有5小时', '0,30 1-5 * * *');
        $this->assertCronTranslateTo('每天5次', '0 1-5 * * *');
        $this->assertCronTranslateTo('每分钟 每天有5小时', '* 1-5 * * *');
        $this->assertCronTranslateTo('每月5天 在1:00am', '0 1 1-5 * *');
        $this->assertCronTranslateTo('每月5天 每年2个月 在1:00am', '0 1 1-5 5,6 *');
        $this->assertCronTranslateTo('每年2个月 在5号 在1:00am', '0 1 5 5,6 *');
        $this->assertCronTranslateTo('每月5号 一周4天 在1:00am', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment()
    {
        $this->assertCronTranslateTo('每2分钟', '*/2 * * * *');
        $this->assertCronTranslateTo('每2分钟', '1/2 * * * *');
        $this->assertCronTranslateTo('每4分钟2次', '1,3/4 * * * *');
        $this->assertCronTranslateTo('每5分钟3次', '1-3/5 * * * *');
        $this->assertCronTranslateTo('每2分钟 在2pm', '*/2 14 * * *');
        $this->assertCronTranslateTo('每整点 每2天', '0 * */2 * *');
        $this->assertCronTranslateTo('每分钟 每2天', '* * */2 * *');
        $this->assertCronTranslateTo('每2小时1次', '0 */2 * * *');
        $this->assertCronTranslateTo('每5小时2次', '0 1,2/5 * * *');
        $this->assertCronTranslateTo('每分钟 每5小时中有2小时', '* 1,2/5 * * *');
        $this->assertCronTranslateTo('每天 每4个月 在12:00am', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types()
    {
        $this->assertCronTranslateTo('每分钟 每2小时', '* */2 * * *');
        $this->assertCronTranslateTo('每分钟 每3小时 在每月2号', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types()
    {
        $this->assertCronTranslateTo('每分钟 在8am', '* 8-8 * * *');
        $this->assertCronTranslateTo('每分钟 在一月', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax()
    {
        $this->assertCronTranslateTo('每整点', '@hourly');
        $this->assertCronTranslateTo('每天 在12:00am', '@daily');
        $this->assertCronTranslateTo('每周周日 在12:00am', '@weekly');
        $this->assertCronTranslateTo('每月1号 在12:00am', '@monthly');
        $this->assertCronTranslateTo('每年 在一月1号 在12:00am', '@yearly');
        $this->assertCronTranslateTo('每年 在一月1号 在12:00am', '@annually');
    }

    /** @test */
    public function it_returns_parsing_errors_when_something_goes_wrong()
    {
        $this->assertCronThrowsParsingError('I_AM_NOT_A_CRON_EXPRESSION');
        $this->assertCronThrowsParsingError('A * * * *');
        $this->assertCronThrowsParsingError('1,2-3 * * * *');
        $this->assertCronThrowsParsingError('1/2/3 * * * *');
        $this->assertCronThrowsParsingError('* * * 0 *');
        $this->assertCronThrowsParsingError('* * * 13 *');
        $this->assertCronThrowsParsingError('* * * * 8');
    }

    /** @test */
    public function it_can_translate_in_different_languages()
    {
        $this->assertCronTranslateTo('Chaque minute', '* * * * *', 'fr');
        $this->assertCronTranslateTo('Todos os minutos', '* * * * *', 'pt');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours()
    {
        $this->assertCronTranslateTo('Every day at 10:30pm', '30 22 * * *', 'en', false);
        $this->assertCronTranslateTo('Every day at 22:30', '30 22 * * *', 'en', true);
        $this->assertCronTranslateTo('Every minute at 6am', '* 6 * * *', 'en', false);
        $this->assertCronTranslateTo('Every minute at 6:00', '* 6 * * *', 'en', true);
    }

    /** @test */
    public function it_can_translate_in_different_languages_and_different_time_format()
    {
        $this->assertCronTranslateTo('Chaque jour à 10:30pm', '30 22 * * *', 'fr', false);
        $this->assertCronTranslateTo('Chaque jour à 22:30', '30 22 * * *', 'fr', true);
        $this->assertCronTranslateTo('Chaque minute à 6am', '* 6 * * *', 'fr', false);
        $this->assertCronTranslateTo('Chaque minute à 6:00', '* 6 * * *', 'fr', true);
    }

    /**
     * @skip
     * @doesNotPerformAssertions
     */
    public function result_generator()
    {
        $this->generateCombinationsFromMatrix([
            ['*', '0', '1,2', '*/2'],
            ['*', '0', '1,2', '*/2'],
            ['*', '1', '1,2', '*/2'],
            ['*', '1', '1,2', '*/2'],
            ['*', '0', '1,2', '*/2'],
        ]);
    }

    public function assertCronTranslateTo(string $expected, string $actual, string $locale = 'zh', bool $timeFormat24hours = false)
    {
        parent::assertCronTranslateTo($expected, $actual, $locale, $timeFormat24hours);
    }
}
