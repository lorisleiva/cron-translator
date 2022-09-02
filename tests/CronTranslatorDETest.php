<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorDETest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_german_with_alle_and_once(): void
    {
        // All 32 (2^5) combinations of alle/Once.
        $this->assertCronTranslateToDE('Jede Minute', '* * * * *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags', '* * * * 0');
        $this->assertCronTranslateToDE('Jede Minute im Januar', '* * * 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags im Januar', '* * * 1 0');
        $this->assertCronTranslateToDE('Jede Minute am 1. eines jeden Monats', '* * 1 * *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags am 1. eines jeden Monats', '* * 1 * 0');
        $this->assertCronTranslateToDE('Jede Minute im Januar den 1.', '* * 1 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags im Januar den 1.', '* * 1 1 0');
        $this->assertCronTranslateToDE('Jede Minute um 0:00', '* 0 * * *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags um 0:00', '* 0 * * 0');
        $this->assertCronTranslateToDE('Jede Minute im Januar um 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags im Januar um 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToDE('Jede Minute am 1. eines jeden Monats um 0:00', '* 0 1 * *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags am 1. eines jeden Monats um 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToDE('Jede Minute im Januar den 1. um 0:00', '* 0 1 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Sonntags im Januar den 1. um 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToDE('Ein mal pro Stunde', '0 * * * *');
        $this->assertCronTranslateToDE('Ein mal pro Stunde des Sonntags', '0 * * * 0');
        $this->assertCronTranslateToDE('Ein mal pro Stunde im Januar', '0 * * 1 *');
        $this->assertCronTranslateToDE('Ein mal pro Stunde des Sonntags im Januar', '0 * * 1 0');
        $this->assertCronTranslateToDE('Ein mal pro Stunde am 1. eines jeden Monats', '0 * 1 * *');
        $this->assertCronTranslateToDE('Ein mal pro Stunde des Sonntags am 1. eines jeden Monats', '0 * 1 * 0');
        $this->assertCronTranslateToDE('Ein mal pro Stunde im Januar den 1.', '0 * 1 1 *');
        $this->assertCronTranslateToDE('Ein mal pro Stunde des Sonntags im Januar den 1.', '0 * 1 1 0');
        $this->assertCronTranslateToDE('Jeden Tag um 0:00', '0 0 * * *');
        $this->assertCronTranslateToDE('Jeden Sonntag um 0:00', '0 0 * * 0');
        $this->assertCronTranslateToDE('Jeden Tag im Januar um 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToDE('Jeden Sonntag im Januar um 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToDE('Jeden 1. eines jeden Monats um 0:00', '0 0 1 * *');
        $this->assertCronTranslateToDE('Jeden 1. eines jeden Monats des Sonntags um 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToDE('Jedes Jahr im Januar den 1. um 0:00', '0 0 1 1 *');
        // TODO 'Des Sonntags'
        $this->assertCronTranslateToDE('Des Sonntags im Januar den 1. um 0:00', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateToDE('Jedes Jahr im Januar den 1. um 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Montags um 15:00', '* 15 * * 1');
        $this->assertCronTranslateToDE('Jede Minute im Januar den 3.', '* * 3 1 *');
        $this->assertCronTranslateToDE('Jede Minute des Montags im April', '* * * 4 1');
        // TODO "Des Montags"
        $this->assertCronTranslateToDE('Des Montags im April den 22. um 15:10', '10 15 22 4 1');
        $this->assertCronTranslateToDE('Jeden Tag um 22:00', '0 22 * * *');
        $this->assertCronTranslateToDE('Jeden Tag um 9:00', '0 9 * * *');
        $this->assertCronTranslateToDE('Jeden Montag um 16:00', '0 16 * * 1');
        $this->assertCronTranslateToDE('Jedes Jahr im Januar den 1. um 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToDE('Jeden 1. eines jeden Monats um 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_to_german_with_multiple(): void
    {
        $this->assertCronTranslateToDE('Jede Minute 2 Stunden pro Tag', '* 8,18 * * *');
        $this->assertCronTranslateToDE('Jede Minute 3 Stunden pro Tag', '* 8,18,20 * * *');
        $this->assertCronTranslateToDE('Jede Minute 20 Stunden pro Tag', '* 1-20 * * *');
        $this->assertCronTranslateToDE('Zwei mal pro Stunde', '0,30 * * * *');
        $this->assertCronTranslateToDE('Zwei mal pro Stunde 5 Stunden pro Tag', '0,30 1-5 * * *');
        $this->assertCronTranslateToDE('5 mal am Tag', '0 1-5 * * *');
        $this->assertCronTranslateToDE('Jede Minute 5 Stunden pro Tag', '* 1-5 * * *');
        $this->assertCronTranslateToDE('5 Tage im Monat um 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToDE('5 Tage im Monat 2 Monate im Jahr um 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToDE('2 Monate im Jahr am 5. um 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToDE('Jeden 5. eines jeden Monats 4 Tage in der Woche um 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_to_german_with_increment(): void
    {
        $this->assertCronTranslateToDE('Jede 2 Minute', '*/2 * * * *');
        $this->assertCronTranslateToDE('Jede 2 Minute', '1/2 * * * *');
        $this->assertCronTranslateToDE('Zwei mal alle 4 Minuten', '1,3/4 * * * *');
        $this->assertCronTranslateToDE('3 mal alle 5 Minuten', '1-3/5 * * * *');
        $this->assertCronTranslateToDE('Jede 2 Minute um 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToDE('Ein mal pro Stunde alle 2 Tage', '0 * */2 * *');
        $this->assertCronTranslateToDE('Jede Minute alle 2 Tage', '* * */2 * *');
        $this->assertCronTranslateToDE('Ein mal alle 2 Stunden', '0 */2 * * *');
        $this->assertCronTranslateToDE('Zwei mal alle 5 Stunden', '0 1,2/5 * * *');
        $this->assertCronTranslateToDE('Jede Minute 2 Stunden aus 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToDE('Jeden Tag alle 4 Monate um 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types_in_german(): void
    {
        $this->assertCronTranslateToDE('Jede Minute alle 2 Stunden', '* */2 * * *');
        $this->assertCronTranslateToDE('Jede Minute alle 3 Stunden am 2. eines jeden Monats', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types_in_german(): void
    {
        $this->assertCronTranslateToDE('Jede Minute um 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToDE('Jede Minute im Januar', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax_in_german(): void
    {
        $this->assertCronTranslateToDE('Ein mal pro Stunde', '@hourly');
        $this->assertCronTranslateToDE('Jeden Tag um 0:00', '@daily');
        $this->assertCronTranslateToDE('Jeden Sonntag um 0:00', '@weekly');
        $this->assertCronTranslateToDE('Jeden 1. eines jeden Monats um 0:00', '@monthly');
        $this->assertCronTranslateToDE('Jedes Jahr im Januar den 1. um 0:00', '@yearly');
        $this->assertCronTranslateToDE('Jedes Jahr im Januar den 1. um 0:00', '@annually');
    }

    // TODO: missing test 'days_of_week' => 'multiple_per_increment'.

    public function assertCronTranslateToDE(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'de', $timeFormat24hours);
    }
}
