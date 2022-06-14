<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorSKTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once()
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('Každú minútu', '* * * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa', '* * * * 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu v mesiaci január', '* * * 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa v mesiaci január', '* * * 1 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu na každý 1. deň v mesiaci', '* * 1 * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa na každý 1. deň v mesiaci', '* * 1 * 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu na 1. deň v mesiaci január', '* * 1 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa na 1. deň v mesiaci január', '* * 1 1 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu o 12am', '* 0 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa o 12am', '* 0 * * 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu v mesiaci január o 12am', '* 0 * 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa v mesiaci január o 12am', '* 0 * 1 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu na každý 1. deň v mesiaci o 12am', '* 0 1 * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa na každý 1. deň v mesiaci o 12am', '* 0 1 * 0', 'sk');
        $this->assertCronTranslateTo('Každú minútu na 1. deň v mesiaci január o 12am', '* 0 1 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v nedeľa na 1. deň v mesiaci január o 12am', '* 0 1 1 0', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu', '0 * * * *', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu v nedeľa', '0 * * * 0', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu v mesiaci január', '0 * * 1 *', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu v nedeľa v mesiaci január', '0 * * 1 0', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu na každý 1. deň v mesiaci', '0 * 1 * *', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu v nedeľa na každý 1. deň v mesiaci', '0 * 1 * 0', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu na 1. deň v mesiaci január', '0 * 1 1 *', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu v nedeľa na 1. deň v mesiaci január', '0 * 1 1 0', 'sk');
        $this->assertCronTranslateTo('Každý deň o 12:00am', '0 0 * * *', 'sk');
        $this->assertCronTranslateTo('Každá/ý nedeľa o 12:00am', '0 0 * * 0', 'sk');
        $this->assertCronTranslateTo('Každý deň v mesiaci január o 12:00am', '0 0 * 1 *', 'sk');
        $this->assertCronTranslateTo('Každá/ý nedeľa v mesiaci január o 12:00am', '0 0 * 1 0', 'sk');
        $this->assertCronTranslateTo('Každý 1. deň v mesiaci o 12:00am', '0 0 1 * *', 'sk');
        $this->assertCronTranslateTo('Každý 1. deň v mesiaci v nedeľa o 12:00am', '0 0 1 * 0', 'sk');
        $this->assertCronTranslateTo('Každý rok na 1. deň v mesiaci január o 12:00am', '0 0 1 1 *', 'sk');
        $this->assertCronTranslateTo('V nedeľa na 1. deň v mesiaci január o 12:00am', '0 0 1 1 0', 'sk');

        // More realistic examples.
        $this->assertCronTranslateTo('Každý rok na 1. deň v mesiaci január o 12:00pm', '0 12 1 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v pondelok o 3pm', '* 15 * * 1', 'sk');
        $this->assertCronTranslateTo('Každú minútu na 3. deň v mesiaci január', '* * 3 1 *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v pondelok v mesiaci apríl', '* * * 4 1', 'sk');
        $this->assertCronTranslateTo('V pondelok na 22. deň v mesiaci apríl o 3:10pm', '10 15 22 4 1', 'sk');

        // Paparazzi examples.
        $this->assertCronTranslateTo('Každý deň o 10:00pm', '0 22 * * *', 'sk');
        $this->assertCronTranslateTo('Každý deň o 9:00am', '0 9 * * *', 'sk');
        $this->assertCronTranslateTo('Každá/ý pondelok o 4:00pm', '0 16 * * 1', 'sk');
        $this->assertCronTranslateTo('Každý rok na 1. deň v mesiaci január o 12:00am', '0 0 1 1 *', 'sk');
        $this->assertCronTranslateTo('Každý 1. deň v mesiaci o 12:00am', '0 0 1 * *', 'sk');
    }

    /** @test */
    public function it_translate_expressions_with_multiple()
    {
        $this->assertCronTranslateTo('Každú minútu 2 hodín za deň', '* 8,18 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu 3 hodín za deň', '* 8,18,20 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu 20 hodín za deň', '* 1-20 * * *', 'sk');
        $this->assertCronTranslateTo('Dva razy za hodinu', '0,30 * * * *', 'sk');
        $this->assertCronTranslateTo('Dva razy za hodinu 5 hodín za deň', '0,30 1-5 * * *', 'sk');
        $this->assertCronTranslateTo('5-krát za deň', '0 1-5 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu 5 hodín za deň', '* 1-5 * * *', 'sk');
        $this->assertCronTranslateTo('5 dní v mesiaci o 1:00am', '0 1 1-5 * *', 'sk');
        $this->assertCronTranslateTo('5 dní v mesiaci 2 mesiacov ročne o 1:00am', '0 1 1-5 5,6 *', 'sk');
        $this->assertCronTranslateTo('2 mesiacov ročne 5. dňa v mesiaci o 1:00am', '0 1 5 5,6 *', 'sk');
        $this->assertCronTranslateTo('Každý 5. deň v mesiaci 4 dní v týždni o 1:00am', '0 1 5 * 1-4', 'sk');
    }

    /** @test */
    public function it_translate_expressions_with_increment()
    {
        $this->assertCronTranslateTo('Každých 2 minút', '*/2 * * * *', 'sk');
        $this->assertCronTranslateTo('Každých 2 minút', '1/2 * * * *', 'sk');
        $this->assertCronTranslateTo('Dva razy každých 4 minút', '1,3/4 * * * *', 'sk');
        $this->assertCronTranslateTo('3-krát každých 5 minút', '1-3/5 * * * *', 'sk');
        $this->assertCronTranslateTo('Každých 2 minút o 2pm', '*/2 14 * * *', 'sk');
        $this->assertCronTranslateTo('Raz za hodinu každých 2 dní', '0 * */2 * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu každých 2 dní', '* * */2 * *', 'sk');
        $this->assertCronTranslateTo('Raz každých 2 hodín', '0 */2 * * *', 'sk');
        $this->assertCronTranslateTo('Dva razy každých 5 hodín', '0 1,2/5 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu 2 hodín z 5', '* 1,2/5 * * *', 'sk');
        $this->assertCronTranslateTo('Každý deň každých 4 mesiacov o 12:00am', '0 0 * */4 *', 'sk');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types()
    {
        $this->assertCronTranslateTo('Každú minútu každých 2 hodín', '* */2 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu každých 3 hodín na každý 2. deň v mesiaci', '* 1/3 2 * *', 'sk');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types()
    {
        $this->assertCronTranslateTo('Každú minútu o 8am', '* 8-8 * * *', 'sk');
        $this->assertCronTranslateTo('Každú minútu v mesiaci január', '* * * 1-1 *', 'sk');
    }

    /** @test */
    public function it_handles_extended_cron_syntax()
    {
        $this->assertCronTranslateTo('Raz za hodinu', '@hourly', 'sk');
        $this->assertCronTranslateTo('Každý deň o 12:00am', '@daily', 'sk');
        $this->assertCronTranslateTo('Každá/ý nedeľa o 12:00am', '@weekly', 'sk');
        $this->assertCronTranslateTo('Každý 1. deň v mesiaci o 12:00am', '@monthly', 'sk');
        $this->assertCronTranslateTo('Každý rok na 1. deň v mesiaci január o 12:00am', '@yearly', 'sk');
        $this->assertCronTranslateTo('Každý rok na 1. deň v mesiaci január o 12:00am', '@annually', 'sk');
    }
}
