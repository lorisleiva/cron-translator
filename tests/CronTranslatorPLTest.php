<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorPLTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('Co minutę', '* * * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę', '* * * * 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu', '* * * 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w styczniu', '* * * 1 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w 1. dniu miesiąca', '* * 1 * *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w 1. dniu miesiąca', '* * 1 * 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu dnia 1.', '* * 1 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w styczniu dnia 1.', '* * 1 1 0', 'pl');
        $this->assertCronTranslateTo('Co minutę o 12am', '* 0 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę o 12am', '* 0 * * 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu o 12am', '* 0 * 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w styczniu o 12am', '* 0 * 1 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w 1. dniu miesiąca o 12am', '* 0 1 * *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w 1. dniu miesiąca o 12am', '* 0 1 * 0', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu dnia 1. o 12am', '* 0 1 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w niedzielę w styczniu dnia 1. o 12am', '* 0 1 1 0', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę', '0 * * * *', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w niedzielę', '0 * * * 0', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w styczniu', '0 * * 1 *', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w niedzielę w styczniu', '0 * * 1 0', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w 1. dniu miesiąca', '0 * 1 * *', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w niedzielę w 1. dniu miesiąca', '0 * 1 * 0', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w styczniu dnia 1.', '0 * 1 1 *', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę w niedzielę w styczniu dnia 1.', '0 * 1 1 0', 'pl');
        $this->assertCronTranslateTo('Każdego dnia o 12:00am', '0 0 * * *', 'pl');
        $this->assertCronTranslateTo('W niedzielę o 12:00am', '0 0 * * 0', 'pl');
        $this->assertCronTranslateTo('Każdego dnia w styczniu o 12:00am', '0 0 * 1 *', 'pl');
        $this->assertCronTranslateTo('W niedzielę w styczniu o 12:00am', '0 0 * 1 0', 'pl');
        $this->assertCronTranslateTo('W 1. dniu miesiąca o 12:00am', '0 0 1 * *', 'pl');
        $this->assertCronTranslateTo('W 1. dniu każdego miesiąca w niedzielę o 12:00am', '0 0 1 * 0', 'pl');
        $this->assertCronTranslateTo('Co roku w styczniu dnia 1. o 12:00am', '0 0 1 1 *', 'pl');
        $this->assertCronTranslateTo('W niedzielę w styczniu dnia 1. o 12:00am', '0 0 1 1 0', 'pl');

        // More realistic examples.
        $this->assertCronTranslateTo('Co roku w styczniu dnia 1. o 12:00pm', '0 12 1 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w poniedziałek o 3pm', '* 15 * * 1', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu dnia 3.', '* * 3 1 *', 'pl');
        $this->assertCronTranslateTo('Co minutę w poniedziałek w kwietniu', '* * * 4 1', 'pl');
        $this->assertCronTranslateTo('W poniedziałek w kwietniu dnia 22. o 3:10pm', '10 15 22 4 1', 'pl');

        // Paparazzi examples.
        $this->assertCronTranslateTo('Każdego dnia o 10:00pm', '0 22 * * *', 'pl');
        $this->assertCronTranslateTo('Każdego dnia o 9:00am', '0 9 * * *', 'pl');
        $this->assertCronTranslateTo('W poniedziałek o 4:00pm', '0 16 * * 1', 'pl');
        $this->assertCronTranslateTo('Co roku w styczniu dnia 1. o 12:00am', '0 0 1 1 *', 'pl');
        $this->assertCronTranslateTo('W 1. dniu każdego miesiąca o 12:00am', '0 0 1 * *', 'pl');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('Co minutę 2 godziny dziennie', '* 8,18 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę 3 godziny dziennie', '* 8,18,20 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę 20 godzin dziennie', '* 1-20 * * *', 'pl');
        $this->assertCronTranslateTo('Dwa razy na godzinę', '0,30 * * * *', 'pl');
        $this->assertCronTranslateTo('Dwa razy na godzinę 5 godzin dziennie', '0,30 1-5 * * *', 'pl');
        $this->assertCronTranslateTo('5 razy dziennie', '0 1-5 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę 5 godzin dziennie', '* 1-5 * * *', 'pl');
        $this->assertCronTranslateTo('5 dni w miesiącu o 1:00am', '0 1 1-5 * *', 'pl');
        $this->assertCronTranslateTo('5 dni w miesiącu 2 miesiące w roku o 1:00am', '0 1 1-5 5,6 *', 'pl');
        $this->assertCronTranslateTo('2 miesiące w roku dnia 5. o 1:00am', '0 1 5 5,6 *', 'pl');
        $this->assertCronTranslateTo('W 5. dniu każdego miesiąca 4 dni w tygodniu o 1:00am', '0 1 5 * 1-4', 'pl');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('Co 2 minuty', '*/2 * * * *', 'pl');
        $this->assertCronTranslateTo('Co 2 minuty', '1/2 * * * *', 'pl');
        $this->assertCronTranslateTo('Dwa razy co 4 minuty', '1,3/4 * * * *', 'pl');
        $this->assertCronTranslateTo('3 razy co 5 minut', '1-3/5 * * * *', 'pl');
        $this->assertCronTranslateTo('Co 2 minuty o 2pm', '*/2 14 * * *', 'pl');
        $this->assertCronTranslateTo('Raz na godzinę co 2 dni', '0 * */2 * *', 'pl');
        $this->assertCronTranslateTo('Co minutę co 2 dni', '* * */2 * *', 'pl');
        $this->assertCronTranslateTo('Raz co 2 godziny', '0 */2 * * *', 'pl');
        $this->assertCronTranslateTo('Dwa razy co 5 godzin', '0 1,2/5 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę 2 godziny z 5', '* 1,2/5 * * *', 'pl');
        $this->assertCronTranslateTo('Każdego dnia co 4 miesiące o 12:00am', '0 0 * */4 *', 'pl');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('Co minutę co 2 godziny', '* */2 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę co 3 godziny w 2. dniu miesiąca', '* 1/3 2 * *', 'pl');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('Co minutę o 8am', '* 8-8 * * *', 'pl');
        $this->assertCronTranslateTo('Co minutę w styczniu', '* * * 1-1 *', 'pl');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('Raz na godzinę', '@hourly', 'pl');
        $this->assertCronTranslateTo('Każdego dnia o 12:00am', '@daily', 'pl');
        $this->assertCronTranslateTo('W niedzielę o 12:00am', '@weekly', 'pl');
        $this->assertCronTranslateTo('W 1. dniu każdego miesiąca o 12:00am', '@monthly', 'pl');
        $this->assertCronTranslateTo('Co roku w styczniu dnia 1. o 12:00am', '@yearly', 'pl');
        $this->assertCronTranslateTo('Co roku w styczniu dnia 1. o 12:00am', '@annually', 'pl');
    }
}
