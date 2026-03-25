<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorCSTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('Každou minutu', '* * * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli', '* * * * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v lednu', '* * * 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v lednu', '* * * 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu dne 1. každého měsíce', '* * 1 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli dne 1. každého měsíce', '* * 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu dne 1. v lednu', '* * 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli dne 1. v lednu', '* * 1 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v 12am', '* 0 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v 12am', '* 0 * * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v lednu v 12am', '* 0 * 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v lednu v 12am', '* 0 * 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu dne 1. každého měsíce v 12am', '* 0 1 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli dne 1. každého měsíce v 12am', '* 0 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu dne 1. v lednu v 12am', '* 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli dne 1. v lednu v 12am', '* 0 1 1 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu', '0 * * * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli', '0 * * * 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v lednu', '0 * * 1 *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli v lednu', '0 * * 1 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu dne 1. každého měsíce', '0 * 1 * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli dne 1. každého měsíce', '0 * 1 * 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu dne 1. v lednu', '0 * 1 1 *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli dne 1. v lednu', '0 * 1 1 0', 'cs');
        $this->assertCronTranslateTo('Každý den v 12:00am', '0 0 * * *', 'cs');
        $this->assertCronTranslateTo('Každou neděli v 12:00am', '0 0 * * 0', 'cs');
        $this->assertCronTranslateTo('Každý den v lednu v 12:00am', '0 0 * 1 *', 'cs');
        $this->assertCronTranslateTo('Každou neděli v lednu v 12:00am', '0 0 * 1 0', 'cs');
        $this->assertCronTranslateTo('Dne 1. každého měsíce v 12:00am', '0 0 1 * *', 'cs');
        $this->assertCronTranslateTo('Dne 1. každého měsíce v neděli v 12:00am', '0 0 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každý rok dne 1. v lednu v 12:00am', '0 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('V neděli dne 1. v lednu v 12:00am', '0 0 1 1 0', 'cs');

        // More realistic examples.
        $this->assertCronTranslateTo('Každý rok dne 1. v lednu v 12:00pm', '0 12 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v pondělí v 3pm', '* 15 * * 1', 'cs');
        $this->assertCronTranslateTo('Každou minutu dne 3. v lednu', '* * 3 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v pondělí v dubnu', '* * * 4 1', 'cs');
        $this->assertCronTranslateTo('V pondělí dne 22. v dubnu v 3:10pm', '10 15 22 4 1', 'cs');

        // Paparazzi examples.
        $this->assertCronTranslateTo('Každý den v 10:00pm', '0 22 * * *', 'cs');
        $this->assertCronTranslateTo('Každý den v 9:00am', '0 9 * * *', 'cs');
        $this->assertCronTranslateTo('Každé pondělí v 4:00pm', '0 16 * * 1', 'cs');
        $this->assertCronTranslateTo('Každý rok dne 1. v lednu v 12:00am', '0 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('Dne 1. každého měsíce v 12:00am', '0 0 1 * *', 'cs');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('Každou minutu 2 hodiny denně', '* 8,18 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 3 hodiny denně', '* 8,18,20 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 20 hodin denně', '* 1-20 * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát za hodinu', '0,30 * * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát za hodinu 5 hodin denně', '0,30 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('5krát denně', '0 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 5 hodin denně', '* 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('5 dní v měsíci v 1:00am', '0 1 1-5 * *', 'cs');
        $this->assertCronTranslateTo('5 dní v měsíci 2 měsíce ročně v 1:00am', '0 1 1-5 5,6 *', 'cs');
        $this->assertCronTranslateTo('2 měsíce ročně dne 5. v 1:00am', '0 1 5 5,6 *', 'cs');
        $this->assertCronTranslateTo('Dne 5. každého měsíce 4 dny v týdnu v 1:00am', '0 1 5 * 1-4', 'cs');
        $this->assertCronTranslateTo('Každé pondělí a každý čtvrtek v 9:00am', '0 9 * * 1,4', 'cs');
        $this->assertCronTranslateTo('Každé pondělí, každou středu a každý pátek v 9:00am', '0 9 * * 1,3,5', 'cs');
        $this->assertCronTranslateTo('Každou sobotu a každou neděli v 10:00am', '0 10 * * 6,0', 'cs');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('Co 2 minuty', '*/2 * * * *', 'cs');
        $this->assertCronTranslateTo('Co 2 minuty', '1/2 * * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát co 4 minuty', '1,3/4 * * * *', 'cs');
        $this->assertCronTranslateTo('3krát co 5 minut', '1-3/5 * * * *', 'cs');
        $this->assertCronTranslateTo('Co 2 minuty v 2pm', '*/2 14 * * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu co 2 dny', '0 * */2 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu co 2 dny', '* * */2 * *', 'cs');
        $this->assertCronTranslateTo('Jednou za 2 hodiny', '0 */2 * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát za 5 hodin', '0 1,2/5 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 2 hodiny z 5', '* 1,2/5 * * *', 'cs');
        $this->assertCronTranslateTo('Každý den co 4 měsíce v 12:00am', '0 0 * */4 *', 'cs');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('Každou minutu co 2 hodiny', '* */2 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu co 3 hodiny dne 2. každého měsíce', '* 1/3 2 * *', 'cs');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('Každou minutu v 8am', '* 8-8 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v lednu', '* * * 1-1 *', 'cs');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('Spustit jednou při startu', '@reboot', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu', '@hourly', 'cs');
        $this->assertCronTranslateTo('Každý den v 12:00am', '@daily', 'cs');
        $this->assertCronTranslateTo('Každou neděli v 12:00am', '@weekly', 'cs');
        $this->assertCronTranslateTo('Dne 1. každého měsíce v 12:00am', '@monthly', 'cs');
        $this->assertCronTranslateTo('Každý rok dne 1. v lednu v 12:00am', '@yearly', 'cs');
        $this->assertCronTranslateTo('Každý rok dne 1. v lednu v 12:00am', '@annually', 'cs');
    }

    /** @test */
    public function it_can_translate_in_czech_with_24_hour_time_format(): void
    {
        $this->assertCronTranslateTo('Každý den v 22:30', '30 22 * * *', 'cs', true);
        $this->assertCronTranslateTo('Každou minutu v 6:00', '* 6 * * *', 'cs', true);
    }
}
