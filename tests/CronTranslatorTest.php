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
        $this->assertCronTranslateTo('Every hour', '0 * * * *');
        $this->assertCronTranslateTo('Every hour on Sundays', '0 * * * 0');
        $this->assertCronTranslateTo('Every hour on January', '0 * * 1 *');
        $this->assertCronTranslateTo('Every hour on Sundays on January', '0 * * 1 0');
        $this->assertCronTranslateTo('Every hour on the 1st of every month', '0 * 1 * *');
        $this->assertCronTranslateTo('Every hour on Sundays on the 1st of every month', '0 * 1 * 0');
        $this->assertCronTranslateTo('Every hour on January the 1st', '0 * 1 1 *');
        $this->assertCronTranslateTo('Every hour on Sundays on January the 1st', '0 * 1 1 0');
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

        // Ranges of 1 are converted into "Once"s.
        $this->assertCronTranslateTo('Every minute at 8am', '* 8-8 * * *');
    }

    /**
     * @skip
     * @doesNotPerformAssertions
     */
    public function result_generator()
    {
        $this->generateCombinationsFromMatrix([
            ['*', '0', '1,2'],
            ['*', '0', '1,2'],
            ['*', '1', '1,2'],
            ['*', '1', '1,2'],
            ['*', '0', '1,2'],
        ]);
    }
}
