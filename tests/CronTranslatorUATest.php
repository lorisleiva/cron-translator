<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorUATest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Кожну/Раз.
        $this->assertCronTranslateToUa('Щохвилини', '* * * * *');
        $this->assertCronTranslateToUa('Щохвилини в неділю', '* * * * 0');
        $this->assertCronTranslateToUa('Щохвилини в січні', '* * * 1 *');
        $this->assertCronTranslateToUa('Щохвилини в неділю в січні', '* * * 1 0');
        $this->assertCronTranslateToUa('Щохвилини щомісяця 1 числа', '* * 1 * *');
        $this->assertCronTranslateToUa('Щохвилини в неділю щомісяця 1 числа', '* * 1 * 0');
        $this->assertCronTranslateToUa('Щохвилини в січні 1 числа', '* * 1 1 *');
        $this->assertCronTranslateToUa('Щохвилини в неділю в січні 1 числа', '* * 1 1 0');
        $this->assertCronTranslateToUa('Щохвилини о 0:00', '* 0 * * *');
        $this->assertCronTranslateToUa('Щохвилини в неділю о 0:00', '* 0 * * 0');
        $this->assertCronTranslateToUa('Щохвилини в січні о 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToUa('Щохвилини в неділю в січні о 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToUa('Щохвилини щомісяця 1 числа о 0:00', '* 0 1 * *');
        $this->assertCronTranslateToUa('Щохвилини в неділю щомісяця 1 числа о 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToUa('Щохвилини в січні 1 числа о 0:00', '* 0 1 1 *'); 
        $this->assertCronTranslateToUa('Щохвилини в неділю в січні 1 числа о 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToUa('Раз на годину', '0 * * * *');
        $this->assertCronTranslateToUa('Раз на годину в неділю', '0 * * * 0');
        $this->assertCronTranslateToUa('Раз на годину в січні', '0 * * 1 *');
        $this->assertCronTranslateToUa('Раз на годину в неділю в січні', '0 * * 1 0');
        $this->assertCronTranslateToUa('Раз на годину щомісяця 1 числа', '0 * 1 * *');
        $this->assertCronTranslateToUa('Раз на годину в неділю щомісяця 1 числа', '0 * 1 * 0');
        $this->assertCronTranslateToUa('Раз на годину в січні 1 числа', '0 * 1 1 *');
        $this->assertCronTranslateToUa('Раз на годину в неділю в січні 1 числа', '0 * 1 1 0');    
        $this->assertCronTranslateToUa('Щодня о 0:00', '0 0 * * *');
        $this->assertCronTranslateToUa('Щотижня в неділю о 0:00', '0 0 * * 0');
        $this->assertCronTranslateToUa('Щодня в січні о 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToUa('Щотижня в неділю в січні о 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToUa('Щомісяця 1-е числа о 0:00', '0 0 1 * *');
        $this->assertCronTranslateToUa('Щомісяця 1-е числа в неділю о 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToUa('Щомісяця 3-є числа в неділю о 0:00', '0 0 3 * 0');
        $this->assertCronTranslateToUa('Щороку в січні 1 числа о 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToUa('В неділю в січні 1 числа о 0:00', '0 0 1 1 0');

       // More realistic examples.
        $this->assertCronTranslateToUa('Щороку в січні 1 числа о 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToUa('Щохвилини в понеділок о 15:00', '* 15 * * 1');
        $this->assertCronTranslateToUa('Щохвилини в січні 3 числа', '* * 3 1 *');
        $this->assertCronTranslateToUa('Щохвилини в понеділок в квітні', '* * * 4 1');
        $this->assertCronTranslateToUa('В понеділок в квітні 22 числа о 15:10', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateToUa('Щодня о 22:00', '0 22 * * *');
        $this->assertCronTranslateToUa('Щодня о 9:00', '0 9 * * *');
        $this->assertCronTranslateToUa('Щотижня у понеділок о 16:00', '0 16 * * 1');
        $this->assertCronTranslateToUa('Щотижня у вівторок о 16:00', '0 16 * * 2');
        $this->assertCronTranslateToUa('Щороку в січні 1 числа о 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToUa('Щомісяця 1-е числа о 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateToUa('Щохвилини 2 години на день', '* 8,18 * * *');
        $this->assertCronTranslateToUa('Щохвилини 3 години на день', '* 8,18,20 * * *');
        $this->assertCronTranslateToUa('Щохвилини 20 годин на день', '* 1-20 * * *');
        $this->assertCronTranslateToUa('Два рази на годину', '0,30 * * * *');
        $this->assertCronTranslateToUa('Два рази на годину 5 годин на день', '0,30 1-5 * * *');
        $this->assertCronTranslateToUa('5 разів на день', '0 1-5 * * *');
        $this->assertCronTranslateToUa('Щохвилини 5 годин на день', '* 1-5 * * *');
        $this->assertCronTranslateToUa('5 днів в місяць о 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToUa('5 днів в місяць 2 місяці на рік о 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToUa('2 місяці на рік на 5-е число о 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToUa('Щомісяця 5-е числа 4 дні на тиждень о 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateToUa('Що 2 хвилини', '*/2 * * * *');
        $this->assertCronTranslateToUa('Що 2 хвилини', '1/2 * * * *');
        $this->assertCronTranslateToUa('Два рази що 4 хвилини', '1,3/4 * * * *');
        $this->assertCronTranslateToUa('3 рази що 5 хвилин', '1-3/5 * * * *');
        $this->assertCronTranslateToUa('Що 2 хвилини о 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToUa('Раз на годину що 2 дні', '0 * */2 * *');
        $this->assertCronTranslateToUa('Щохвилини що 2 дні', '* * */2 * *');
        $this->assertCronTranslateToUa('Один раз що 2 години', '0 */2 * * *');
        $this->assertCronTranslateToUa('Два рази що 5 годин', '0 1,2/5 * * *');
        $this->assertCronTranslateToUa('5 разів що 8 годин', '0 1,2,3,4,5/8 * * *');
        $this->assertCronTranslateToUa('Щохвилини 2 години з 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToUa('Щодня що 4 місяці о 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateToUa('Щохвилини що 2 години', '* */2 * * *');
        $this->assertCronTranslateToUa('Щохвилини що 3 години щомісяця 2 числа', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateToUa('Щохвилини о 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToUa('Щохвилини в січні', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateToUa('Один раз при запуску', '@reboot');
        $this->assertCronTranslateToUa('Раз на годину', '@hourly');
        $this->assertCronTranslateToUa('Щодня о 0:00', '@daily');
        $this->assertCronTranslateToUa('Щотижня в неділю о 0:00', '@weekly');
        $this->assertCronTranslateToUa('Щомісяця 1-е числа о 0:00', '@monthly');
        $this->assertCronTranslateToUa('Щороку в січні 1 числа о 0:00', '@yearly');
        $this->assertCronTranslateToUa('Щороку в січні 1 числа о 0:00', '@annually');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateToUa('Щодня о 10:30 вечора', '30 22 * * *', false);
        $this->assertCronTranslateToUa('Щодня о 22:30', '30 22 * * *', true);
        $this->assertCronTranslateToUa('Щохвилини о 6 ранку', '* 6 * * *', false);
        $this->assertCronTranslateToUa('Щохвилини о 6:00', '* 6 * * *', true);
    }

    public function assertCronTranslateToUa(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'ua', $timeFormat24hours);
    }
}

