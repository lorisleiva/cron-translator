<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once()
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('Every minute', '* * * * *');
        $this->assertCronTranslateTo('Every minute on Sundays', '* * * * 0');
        $this->assertCronTranslateTo('Every minute on January', '* * * 1 *');
        $this->assertCronTranslateTo('Every minute on Sundays on January', '* * * 1 0');
        $this->assertCronTranslateTo('Every minute on the 1st of every month', '* * 1 * *');
        $this->assertCronTranslateTo('Every minute on Sundays on the 1st of every month', '* * 1 * 0');
        $this->assertCronTranslateTo('Every minute on January the 1st', '* * 1 1 *');
        $this->assertCronTranslateTo('Every minute on Sundays on January the 1st', '* * 1 1 0');
        $this->assertCronTranslateTo('Every minute at 12am', '* 0 * * *');
        $this->assertCronTranslateTo('Every minute on Sundays at 12am', '* 0 * * 0');
        $this->assertCronTranslateTo('Every minute on January at 12am', '* 0 * 1 *');
        $this->assertCronTranslateTo('Every minute on Sundays on January at 12am', '* 0 * 1 0');
        $this->assertCronTranslateTo('Every minute on the 1st of every month at 12am', '* 0 1 * *');
        $this->assertCronTranslateTo('Every minute on Sundays on the 1st of every month at 12am', '* 0 1 * 0');
        $this->assertCronTranslateTo('Every minute on January the 1st at 12am', '* 0 1 1 *');
        $this->assertCronTranslateTo('Every minute on Sundays on January the 1st at 12am', '* 0 1 1 0');
        $this->assertCronTranslateTo('Once an hour', '0 * * * *');
        $this->assertCronTranslateTo('Once an hour on Sundays', '0 * * * 0');
        $this->assertCronTranslateTo('Once an hour on January', '0 * * 1 *');
        $this->assertCronTranslateTo('Once an hour on Sundays on January', '0 * * 1 0');
        $this->assertCronTranslateTo('Once an hour on the 1st of every month', '0 * 1 * *');
        $this->assertCronTranslateTo('Once an hour on Sundays on the 1st of every month', '0 * 1 * 0');
        $this->assertCronTranslateTo('Once an hour on January the 1st', '0 * 1 1 *');
        $this->assertCronTranslateTo('Once an hour on Sundays on January the 1st', '0 * 1 1 0');
        $this->assertCronTranslateTo('Every day at 12:00am', '0 0 * * *');
        $this->assertCronTranslateTo('Every Sunday at 12:00am', '0 0 * * 0');
        $this->assertCronTranslateTo('Every day on January at 12:00am', '0 0 * 1 *');
        $this->assertCronTranslateTo('Every Sunday on January at 12:00am', '0 0 * 1 0');
        $this->assertCronTranslateTo('The 1st of every month at 12:00am', '0 0 1 * *');
        $this->assertCronTranslateTo('The 1st of every month on Sundays at 12:00am', '0 0 1 * 0');
        $this->assertCronTranslateTo('Every year on January the 1st at 12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('On Sundays on January the 1st at 12:00am', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateTo('Every year on January the 1st at 12:00pm', '0 12 1 1 *');
        $this->assertCronTranslateTo('Every minute on Mondays at 3pm', '* 15 * * 1');
        $this->assertCronTranslateTo('Every minute on January the 3rd', '* * 3 1 *');
        $this->assertCronTranslateTo('Every minute on Mondays on April', '* * * 4 1');
        $this->assertCronTranslateTo('On Mondays on April the 22nd at 3:10pm', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateTo('Every day at 10:00pm', '0 22 * * *');
        $this->assertCronTranslateTo('Every day at 9:00am', '0 9 * * *');
        $this->assertCronTranslateTo('Every Monday at 4:00pm', '0 16 * * 1');
        $this->assertCronTranslateTo('Every year on January the 1st at 12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('The 1st of every month at 12:00am', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple()
    {
        $this->assertCronTranslateTo('Every minute 2 hours a day', '* 8,18 * * *');
        $this->assertCronTranslateTo('Every minute 3 hours a day', '* 8,18,20 * * *');
        $this->assertCronTranslateTo('Every minute 20 hours a day', '* 1-20 * * *');
        $this->assertCronTranslateTo('Twice an hour', '0,30 * * * *');
        $this->assertCronTranslateTo('Twice an hour 5 hours a day', '0,30 1-5 * * *');
        $this->assertCronTranslateTo('5 times a day', '0 1-5 * * *');
        $this->assertCronTranslateTo('Every minute 5 hours a day', '* 1-5 * * *');
        $this->assertCronTranslateTo('5 days a month at 1:00am', '0 1 1-5 * *');
        $this->assertCronTranslateTo('5 days a month 2 months a year at 1:00am', '0 1 1-5 5,6 *');
        $this->assertCronTranslateTo('2 months a year on the 5th at 1:00am', '0 1 5 5,6 *');
        $this->assertCronTranslateTo('The 5th of every month 4 days a week at 1:00am', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment()
    {
        $this->assertCronTranslateTo('Every 2 minutes', '*/2 * * * *');
        $this->assertCronTranslateTo('Every 2 minutes', '1/2 * * * *');
        $this->assertCronTranslateTo('Twice every 4 minutes', '1,3/4 * * * *');
        $this->assertCronTranslateTo('3 times every 5 minutes', '1-3/5 * * * *');
        $this->assertCronTranslateTo('Every 2 minutes at 2pm', '*/2 14 * * *');
        $this->assertCronTranslateTo('Once an hour every 2 days', '0 * */2 * *');
        $this->assertCronTranslateTo('Every minute every 2 days', '* * */2 * *');
        $this->assertCronTranslateTo('Once every 2 hours', '0 */2 * * *');
        $this->assertCronTranslateTo('Twice every 5 hours', '0 1,2/5 * * *');
        $this->assertCronTranslateTo('Every minute 2 hours out of 5', '* 1,2/5 * * *');
        $this->assertCronTranslateTo('Every day every 4 months at 12:00am', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types()
    {
        $this->assertCronTranslateTo('Every minute of every 2 hours', '* */2 * * *');
        $this->assertCronTranslateTo('Every minute of every 3 hours on the 2nd of every month', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types()
    {
        $this->assertCronTranslateTo('Every minute at 8am', '* 8-8 * * *');
        $this->assertCronTranslateTo('Every minute on January', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax()
    {
        $this->assertCronTranslateTo('Once an hour', '@hourly');
        $this->assertCronTranslateTo('Every day at 12:00am', '@daily');
        $this->assertCronTranslateTo('Every Sunday at 12:00am', '@weekly');
        $this->assertCronTranslateTo('The 1st of every month at 12:00am', '@monthly');
        $this->assertCronTranslateTo('Every year on January the 1st at 12:00am', '@yearly');
        $this->assertCronTranslateTo('Every year on January the 1st at 12:00am', '@annually');
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
        $this->assertCronTranslateTo('Chaque minute les Dimanches', '* * * * 0', 'fr');
        $this->assertCronTranslateTo('Chaque minute toutes les 2 heures', '* */2 * * *', 'fr');
        $this->assertCronTranslateTo('Chaque minute toutes les 3 heures le 2 de chaque mois', '* 1/3 2 * *', 'fr');
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
}
