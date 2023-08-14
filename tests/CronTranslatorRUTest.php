<?php

/** @noinspection PhpRedundantOptionalArgumentInspection */

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorRUTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateToRu('каждую минуту', '* * * * *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям', '* * * * 0');
        $this->assertCronTranslateToRu('каждую минуту в январе', '* * * 1 *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям в январе', '* * * 1 0');
        $this->assertCronTranslateToRu('каждую минуту 1-го числа каждого месяца', '* * 1 * *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям 1-го числа каждого месяца', '* * 1 * 0');
        $this->assertCronTranslateToRu('каждую минуту в январе 1-го числа', '* * 1 1 *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям в январе 1-го числа', '* * 1 1 0');
        $this->assertCronTranslateToRu('каждую минуту в 0:00', '* 0 * * *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям в 0:00', '* 0 * * 0');
        $this->assertCronTranslateToRu('каждую минуту в январе в 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям в январе в 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToRu('каждую минуту 1-го числа каждого месяца в 0:00', '* 0 1 * *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям 1-го числа каждого месяца в 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToRu('каждую минуту в январе 1-го числа в 0:00', '* 0 1 1 *');
        $this->assertCronTranslateToRu('каждую минуту по воскресеньям в январе 1-го числа в 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToRu('раз в час', '0 * * * *');
        $this->assertCronTranslateToRu('раз в час по воскресеньям', '0 * * * 0');
        $this->assertCronTranslateToRu('раз в час в январе', '0 * * 1 *');
        $this->assertCronTranslateToRu('раз в час по воскресеньям в январе', '0 * * 1 0');
        $this->assertCronTranslateToRu('раз в час 1-го числа каждого месяца', '0 * 1 * *');
        $this->assertCronTranslateToRu('раз в час по воскресеньям 1-го числа каждого месяца', '0 * 1 * 0');
        $this->assertCronTranslateToRu('раз в час в январе 1-го числа', '0 * 1 1 *');
        $this->assertCronTranslateToRu('раз в час по воскресеньям в январе 1-го числа', '0 * 1 1 0');
        $this->assertCronTranslateToRu('каждый день в 0:00', '0 0 * * *');
        $this->assertCronTranslateToRu('каждую неделю в воскресенье в 0:00', '0 0 * * 0');
        $this->assertCronTranslateToRu('каждый день в январе в 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToRu('каждую неделю в воскресенье в январе в 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '0 0 1 * *');
        $this->assertCronTranslateToRu('1-ое число каждого месяца по воскресеньям в 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToRu('3-е число каждого месяца по воскресеньям в 0:00', '0 0 3 * 0');
        $this->assertCronTranslateToRu('каждый год в январе 1-го числа в 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRu('по воскресеньям в январе 1-го числа в 0:00', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateToRu('каждый год в январе 1-го числа в 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToRu('каждую минуту по понедельникам в 15:00', '* 15 * * 1');
        $this->assertCronTranslateToRu('каждую минуту в январе 3-го числа', '* * 3 1 *');
        $this->assertCronTranslateToRu('каждую минуту по понедельникам в апреле', '* * * 4 1');
        $this->assertCronTranslateToRu('по понедельникам в апреле 22-го числа в 15:10', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateToRu('каждый день в 22:00', '0 22 * * *');
        $this->assertCronTranslateToRu('каждый день в 9:00', '0 9 * * *');
        $this->assertCronTranslateToRu('каждую неделю в понедельник в 16:00', '0 16 * * 1');
        $this->assertCronTranslateToRu('каждую неделю во вторник в 16:00', '0 16 * * 2');
        $this->assertCronTranslateToRu('каждый год в январе 1-го числа в 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateToRu('каждую минуту 2 ч в день', '* 8,18 * * *');
        $this->assertCronTranslateToRu('каждую минуту 3 ч в день', '* 8,18,20 * * *');
        $this->assertCronTranslateToRu('каждую минуту 20 ч в день', '* 1-20 * * *');
        $this->assertCronTranslateToRu('два раза в час', '0,30 * * * *');
        $this->assertCronTranslateToRu('два раза в час 5 ч в день', '0,30 1-5 * * *');
        $this->assertCronTranslateToRu('5 раз в день', '0 1-5 * * *');
        $this->assertCronTranslateToRu('каждую минуту 5 ч в день', '* 1-5 * * *');
        $this->assertCronTranslateToRu('5 дн. в месяц в 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToRu('5 дн. в месяц 2 мес. в год в 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToRu('2 мес. в год на 5-ое число в 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToRu('5-ое число каждого месяца 4 дн. в неделю в 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateToRu('каждые 2 мин.', '*/2 * * * *');
        $this->assertCronTranslateToRu('каждые 2 мин.', '1/2 * * * *');
        $this->assertCronTranslateToRu('два раза каждые 4 мин.', '1,3/4 * * * *');
        $this->assertCronTranslateToRu('3 раза каждые 5 мин.', '1-3/5 * * * *');
        $this->assertCronTranslateToRu('каждые 2 мин. в 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToRu('раз в час каждые 2 дн.', '0 * */2 * *');
        $this->assertCronTranslateToRu('каждую минуту каждые 2 дн.', '* * */2 * *');
        $this->assertCronTranslateToRu('один раз каждые 2 ч', '0 */2 * * *');
        $this->assertCronTranslateToRu('два раза каждые 5 ч', '0 1,2/5 * * *');
        $this->assertCronTranslateToRu('5 раз каждые 8 ч', '0 1,2,3,4,5/8 * * *');
        $this->assertCronTranslateToRu('каждую минуту 2 ч из 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToRu('каждый день каждые 4 мec. в 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateToRu('каждую минуту каждые 2 ч', '* */2 * * *');
        $this->assertCronTranslateToRu('каждую минуту каждые 3 ч 2-го числа каждого месяца', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateToRu('каждую минуту в 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToRu('каждую минуту в январе', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateToRu('раз в час', '@hourly');
        $this->assertCronTranslateToRu('каждый день в 0:00', '@daily');
        $this->assertCronTranslateToRu('каждую неделю в воскресенье в 0:00', '@weekly');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '@monthly');
        $this->assertCronTranslateToRu('каждый год в январе 1-го числа в 0:00', '@yearly');
        $this->assertCronTranslateToRu('каждый год в январе 1-го числа в 0:00', '@annually');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateToRu('каждый день в 10:30 вечера', '30 22 * * *', false);
        $this->assertCronTranslateToRu('каждый день в 22:30', '30 22 * * *', true);
        $this->assertCronTranslateToRu('каждую минуту в 6 утра', '* 6 * * *', false);
        $this->assertCronTranslateToRu('каждую минуту в 6:00', '* 6 * * *', true);
    }

    public function assertCronTranslateToRu(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'ru', $timeFormat24hours);
    }
}
