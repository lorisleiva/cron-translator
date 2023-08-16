<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorRUTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateToRu('Каждую минуту', '* * * * *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям', '* * * * 0');
        $this->assertCronTranslateToRu('Каждую минуту в январе', '* * * 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям в январе', '* * * 1 0');
        $this->assertCronTranslateToRu('Каждую минуту 1-го числа каждого месяца', '* * 1 * *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям 1-го числа каждого месяца', '* * 1 * 0');
        $this->assertCronTranslateToRu('Каждую минуту в январе 1-го числа', '* * 1 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям в январе 1-го числа', '* * 1 1 0');
        $this->assertCronTranslateToRu('Каждую минуту в 0:00', '* 0 * * *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям в 0:00', '* 0 * * 0');
        $this->assertCronTranslateToRu('Каждую минуту в январе в 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям в январе в 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToRu('Каждую минуту 1-го числа каждого месяца в 0:00', '* 0 1 * *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям 1-го числа каждого месяца в 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToRu('Каждую минуту в январе 1-го числа в 0:00', '* 0 1 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по воскресеньям в январе 1-го числа в 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToRu('Раз в час', '0 * * * *');
        $this->assertCronTranslateToRu('Раз в час по воскресеньям', '0 * * * 0');
        $this->assertCronTranslateToRu('Раз в час в январе', '0 * * 1 *');
        $this->assertCronTranslateToRu('Раз в час по воскресеньям в январе', '0 * * 1 0');
        $this->assertCronTranslateToRu('Раз в час 1-го числа каждого месяца', '0 * 1 * *');
        $this->assertCronTranslateToRu('Раз в час по воскресеньям 1-го числа каждого месяца', '0 * 1 * 0');
        $this->assertCronTranslateToRu('Раз в час в январе 1-го числа', '0 * 1 1 *');
        $this->assertCronTranslateToRu('Раз в час по воскресеньям в январе 1-го числа', '0 * 1 1 0');
        $this->assertCronTranslateToRu('Каждый день в 0:00', '0 0 * * *');
        $this->assertCronTranslateToRu('Каждую неделю в воскресенье в 0:00', '0 0 * * 0');
        $this->assertCronTranslateToRu('Каждый день в январе в 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToRu('Каждую неделю в воскресенье в январе в 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '0 0 1 * *');
        $this->assertCronTranslateToRu('1-ое число каждого месяца по воскресеньям в 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToRu('3-е число каждого месяца по воскресеньям в 0:00', '0 0 3 * 0');
        $this->assertCronTranslateToRu('Каждый год в январе 1-го числа в 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRu('По воскресеньям в январе 1-го числа в 0:00', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateToRu('Каждый год в январе 1-го числа в 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по понедельникам в 15:00', '* 15 * * 1');
        $this->assertCronTranslateToRu('Каждую минуту в январе 3-го числа', '* * 3 1 *');
        $this->assertCronTranslateToRu('Каждую минуту по понедельникам в апреле', '* * * 4 1');
        $this->assertCronTranslateToRu('По понедельникам в апреле 22-го числа в 15:10', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateToRu('Каждый день в 22:00', '0 22 * * *');
        $this->assertCronTranslateToRu('Каждый день в 9:00', '0 9 * * *');
        $this->assertCronTranslateToRu('Каждую неделю в понедельник в 16:00', '0 16 * * 1');
        $this->assertCronTranslateToRu('Каждую неделю во вторник в 16:00', '0 16 * * 2');
        $this->assertCronTranslateToRu('Каждый год в январе 1-го числа в 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateToRu('Каждую минуту 2 часа в день', '* 8,18 * * *');
        $this->assertCronTranslateToRu('Каждую минуту 3 часа в день', '* 8,18,20 * * *');
        $this->assertCronTranslateToRu('Каждую минуту 20 часов в день', '* 1-20 * * *');
        $this->assertCronTranslateToRu('Два раза в час', '0,30 * * * *');
        $this->assertCronTranslateToRu('Два раза в час 5 часов в день', '0,30 1-5 * * *');
        $this->assertCronTranslateToRu('5 раз в день', '0 1-5 * * *');
        $this->assertCronTranslateToRu('Каждую минуту 5 часов в день', '* 1-5 * * *');
        $this->assertCronTranslateToRu('5 дней в месяц в 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToRu('5 дней в месяц 2 месяца в год в 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToRu('2 месяца в год на 5-ое число в 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToRu('5-ое число каждого месяца 4 дня в неделю в 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateToRu('Каждые 2 минуты', '*/2 * * * *');
        $this->assertCronTranslateToRu('Каждые 2 минуты', '1/2 * * * *');
        $this->assertCronTranslateToRu('Два раза каждые 4 минуты', '1,3/4 * * * *');
        $this->assertCronTranslateToRu('3 раза каждые 5 минут', '1-3/5 * * * *');
        $this->assertCronTranslateToRu('Каждые 2 минуты в 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToRu('Раз в час каждые 2 дня', '0 * */2 * *');
        $this->assertCronTranslateToRu('Каждую минуту каждые 2 дня', '* * */2 * *');
        $this->assertCronTranslateToRu('Один раз каждые 2 часа', '0 */2 * * *');
        $this->assertCronTranslateToRu('Два раза каждые 5 часов', '0 1,2/5 * * *');
        $this->assertCronTranslateToRu('5 раз каждые 8 часов', '0 1,2,3,4,5/8 * * *');
        $this->assertCronTranslateToRu('Каждую минуту 2 часа из 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToRu('Каждый день каждые 4 месяца в 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateToRu('Каждую минуту каждые 2 часа', '* */2 * * *');
        $this->assertCronTranslateToRu('Каждую минуту каждые 3 часа 2-го числа каждого месяца', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateToRu('Каждую минуту в 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToRu('Каждую минуту в январе', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateToRu('Один раз при старте', '@reboot');
        $this->assertCronTranslateToRu('Раз в час', '@hourly');
        $this->assertCronTranslateToRu('Каждый день в 0:00', '@daily');
        $this->assertCronTranslateToRu('Каждую неделю в воскресенье в 0:00', '@weekly');
        $this->assertCronTranslateToRu('1-ое число каждого месяца в 0:00', '@monthly');
        $this->assertCronTranslateToRu('Каждый год в январе 1-го числа в 0:00', '@yearly');
        $this->assertCronTranslateToRu('Каждый год в январе 1-го числа в 0:00', '@annually');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateToRu('Каждый день в 10:30 вечера', '30 22 * * *', false);
        $this->assertCronTranslateToRu('Каждый день в 22:30', '30 22 * * *', true);
        $this->assertCronTranslateToRu('Каждую минуту в 6 утра', '* 6 * * *', false);
        $this->assertCronTranslateToRu('Каждую минуту в 6:00', '* 6 * * *', true);
    }

    public function assertCronTranslateToRu(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'ru', $timeFormat24hours);
    }
}
