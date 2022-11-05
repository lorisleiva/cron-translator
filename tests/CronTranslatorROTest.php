<?php /** @noinspection PhpRedundantOptionalArgumentInspection */

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorROTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_romanian_with_alle_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateToRo('în fiecare minut', '* * * * *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică', '* * * * 0');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie', '* * * 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în luna Ianuarie', '* * * 1 0');
        $this->assertCronTranslateToRo('în fiecare minut în data de 1 a fiecărei luni', '* * 1 * *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în data de 1 a fiecărei luni', '* * 1 * 0');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie pe data de 1', '* * 1 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în luna Ianuarie pe data de 1', '* * 1 1 0');
        $this->assertCronTranslateToRo('în fiecare minut la 0:00', '* 0 * * *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică la 0:00', '* 0 * * 0');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie la 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în luna Ianuarie la 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToRo('în fiecare minut în data de 1 a fiecărei luni la 0:00', '* 0 1 * *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în data de 1 a fiecărei luni la 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie pe data de 1 la 0:00', '* 0 1 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Duminică în luna Ianuarie pe data de 1 la 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToRo('O singură dată pe oră', '0 * * * *');
        $this->assertCronTranslateToRo('O singură dată pe oră în zilele de Duminică', '0 * * * 0');
        $this->assertCronTranslateToRo('O singură dată pe oră în luna Ianuarie', '0 * * 1 *');
        $this->assertCronTranslateToRo('O singură dată pe oră în zilele de Duminică în luna Ianuarie', '0 * * 1 0');
        $this->assertCronTranslateToRo('O singură dată pe oră în data de 1 a fiecărei luni', '0 * 1 * *');
        $this->assertCronTranslateToRo('O singură dată pe oră în zilele de Duminică în data de 1 a fiecărei luni', '0 * 1 * 0');
        $this->assertCronTranslateToRo('O singură dată pe oră în luna Ianuarie pe data de 1', '0 * 1 1 *');
        $this->assertCronTranslateToRo('O singură dată pe oră în zilele de Duminică în luna Ianuarie pe data de 1', '0 * 1 1 0');
        $this->assertCronTranslateToRo('în fiecare zi la 0:00', '0 0 * * *');
        $this->assertCronTranslateToRo('în fiecare Duminică la 0:00', '0 0 * * 0');
        $this->assertCronTranslateToRo('în fiecare zi în luna Ianuarie la 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToRo('în fiecare Duminică în luna Ianuarie la 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToRo('Pe data de 1 a fiecărei luni la 0:00', '0 0 1 * *');
        $this->assertCronTranslateToRo('Pe data de 1 a fiecărei luni în zilele de Duminică la 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToRo('în fiecare an în luna Ianuarie pe data de 1 la 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRo('în zilele de Duminică în luna Ianuarie pe data de 1 la 0:00', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateToRo('în fiecare an în luna Ianuarie pe data de 1 la 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Luni la 15:00', '* 15 * * 1');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie pe data de 3', '* * 3 1 *');
        $this->assertCronTranslateToRo('în fiecare minut în zilele de Luni în luna Aprilie', '* * * 4 1');
        $this->assertCronTranslateToRo('în zilele de Luni în luna Aprilie pe data de 22 la 15:10', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateToRo('în fiecare zi la 22:00', '0 22 * * *');
        $this->assertCronTranslateToRo('în fiecare zi la 9:00', '0 9 * * *');
        $this->assertCronTranslateToRo('în fiecare Luni la 16:00', '0 16 * * 1');
        $this->assertCronTranslateToRo('în fiecare an în luna Ianuarie pe data de 1 la 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToRo('Pe data de 1 a fiecărei luni la 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateToRo('în fiecare minut de 2 ori pe zi', '* 8,18 * * *');
        $this->assertCronTranslateToRo('în fiecare minut de 3 ori pe zi', '* 8,18,20 * * *');
        $this->assertCronTranslateToRo('în fiecare minut de 20 ori pe zi', '* 1-20 * * *');
        $this->assertCronTranslateToRo('De 2 ori pe oră', '0,30 * * * *');
        $this->assertCronTranslateToRo('De 2 ori pe oră de 5 ori pe zi', '0,30 1-5 * * *');
        $this->assertCronTranslateToRo('De 5 ori pe zi', '0 1-5 * * *');
        $this->assertCronTranslateToRo('în fiecare minut de 5 ori pe zi', '* 1-5 * * *');
        $this->assertCronTranslateToRo('5 zile pe lună la 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToRo('5 zile pe lună 2 luni pe an la 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToRo('2 luni pe an în data de 5 la 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToRo('Pe data de 5 a fiecărei luni 4 zile ale săptămânii la 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateToRo('în fiecare 2 minute', '*/2 * * * *');
        $this->assertCronTranslateToRo('în fiecare 2 minute', '1/2 * * * *');
        $this->assertCronTranslateToRo('De 2 ori fiecare 4 minute', '1,3/4 * * * *');
        $this->assertCronTranslateToRo('De 3 ori fiecare 5 minute', '1-3/5 * * * *');
        $this->assertCronTranslateToRo('în fiecare 2 minute la 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToRo('O singură dată pe oră în fiecare 2 zile', '0 * */2 * *');
        $this->assertCronTranslateToRo('în fiecare minut în fiecare 2 zile', '* * */2 * *');
        $this->assertCronTranslateToRo('O singură dată fiecare 2 ore', '0 */2 * * *');
        $this->assertCronTranslateToRo('De 2 ori fiecare 5 ore', '0 1,2/5 * * *');
        $this->assertCronTranslateToRo('în fiecare minut 2 ore din 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToRo('în fiecare zi în fiecare 4 luni la 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateToRo('în fiecare minut în fiecare 2 ore', '* */2 * * *');
        $this->assertCronTranslateToRo('în fiecare minut în fiecare 3 ore în data de 2 a fiecărei luni', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateToRo('în fiecare minut la 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToRo('în fiecare minut în luna Ianuarie', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateToRo('O singură dată pe oră', '@hourly');
        $this->assertCronTranslateToRo('în fiecare zi la 0:00', '@daily');
        $this->assertCronTranslateToRo('în fiecare Duminică la 0:00', '@weekly');
        $this->assertCronTranslateToRo('Pe data de 1 a fiecărei luni la 0:00', '@monthly');
        $this->assertCronTranslateToRo('în fiecare an în luna Ianuarie pe data de 1 la 0:00', '@yearly');
        $this->assertCronTranslateToRo('în fiecare an în luna Ianuarie pe data de 1 la 0:00', '@annually');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateToRo('în fiecare zi la 22:30', '30 22 * * *', 'en', true);
        $this->assertCronTranslateToRo('în fiecare minut la 6:00', '* 6 * * *', 'en', true);
    }

    public function assertCronTranslateToRo(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'ro', $timeFormat24hours);
    }
}
