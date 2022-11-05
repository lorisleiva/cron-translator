<?php /** @noinspection PhpRedundantOptionalArgumentInspection */

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorROTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_romanian_with_alle_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('În fiecare minut', '* * * * *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă', '* * * * 0');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie', '* * * 1 *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în luna Ianuarie', '* * * 1 0');
        $this->assertCronTranslateTo('În fiecare minut în data de 1 în fiecare lună', '* * 1 * *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în data de 1 în fiecare lună', '* * 1 * 0');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie în data de 1', '* * 1 1 *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în luna Ianuarie în data de 1', '* * 1 1 0');
        $this->assertCronTranslateTo('În fiecare minut la 12am', '* 0 * * *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă la 12am', '* 0 * * 0');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie la 12am', '* 0 * 1 *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în luna Ianuarie la 12am', '* 0 * 1 0');
        $this->assertCronTranslateTo('În fiecare minut în data de 1 în fiecare lună la 12am', '* 0 1 * *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în data de 1 în fiecare lună la 12am', '* 0 1 * 0');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie în data de 1 la 12am', '* 0 1 1 *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Sâmbătă în luna Ianuarie în data de 1 la 12am', '* 0 1 1 0');
        $this->assertCronTranslateTo('Odată pe oră', '0 * * * *');
        $this->assertCronTranslateTo('Odată pe oră în zilele de Sâmbătă', '0 * * * 0');
        $this->assertCronTranslateTo('Odată pe oră în luna Ianuarie', '0 * * 1 *');
        $this->assertCronTranslateTo('Odată pe oră în zilele de Sâmbătă în luna Ianuarie', '0 * * 1 0');
        $this->assertCronTranslateTo('Odată pe oră în data de 1 în fiecare lună', '0 * 1 * *');
        $this->assertCronTranslateTo('Odată pe oră în zilele de Sâmbătă în data de 1 în fiecare lună', '0 * 1 * 0');
        $this->assertCronTranslateTo('Odată pe oră în luna Ianuarie în data de 1', '0 * 1 1 *');
        $this->assertCronTranslateTo('Odată pe oră în zilele de Sâmbătă în luna Ianuarie în data de 1', '0 * 1 1 0');
        $this->assertCronTranslateTo('În fiecare zi la 12:00am', '0 0 * * *');
        $this->assertCronTranslateTo('În fiecare sâmbătă la :00am', '0 0 * * 0');
        $this->assertCronTranslateTo('În fiecare zi în luna Ianuarie la 12:00am', '0 0 * 1 *');
        $this->assertCronTranslateTo('În fiecare sâmbătă în luna Ianuarie la 12:00am', '0 0 * 1 0');
        $this->assertCronTranslateTo('În data de 1 în fiecare lună la 12:00am', '0 0 1 * *');
        $this->assertCronTranslateTo('În data de 1 în fiecare lună în zilele de Sâmbătă la 12:00am', '0 0 1 * 0');
        $this->assertCronTranslateTo('În fiecare an în luna Ianuarie în data de 1 la 12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('În zilele de Sâmbătă în luna Ianuarie pe data de 1 la 12:00am', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateTo('În fiecare an în luna Ianuarie pe data de 1 la 12:00pm', '0 12 1 1 *');
        $this->assertCronTranslateTo('În fiecare minut în fiecare Luni la 3pm', '* 15 * * 1');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie pe data de 3', '* * 3 1 *');
        $this->assertCronTranslateTo('În fiecare minut în zilele de Mondays în luna Aprilie', '* * * 4 1');
        $this->assertCronTranslateTo('În zilele de luni în luna Aprilie pe data de 22 la 3:10pm', '10 15 22 4 1');

        // Paparazzi examples.
        $this->assertCronTranslateTo('În fiecare zi la 10:00pm', '0 22 * * *');
        $this->assertCronTranslateTo('În fiecare zi la 9:00am', '0 9 * * *');
        $this->assertCronTranslateTo('În fiecare Marți la 4:00pm', '0 16 * * 1');
        $this->assertCronTranslateTo('În fiecare an în luna Ianuarie pe data de 1 la 12:00am', '0 0 1 1 *');
        $this->assertCronTranslateTo('În data de 1 a fiecărei luni la 12:00am', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('În fiecare minut de 2 ori pe zi', '* 8,18 * * *');
        $this->assertCronTranslateTo('În fiecare minut de 3 ori pe zi', '* 8,18,20 * * *');
        $this->assertCronTranslateTo('În fiecare minut de 20 de ori pe zi', '* 1-20 * * *');
        $this->assertCronTranslateTo('De două ori pe oră', '0,30 * * * *');
        $this->assertCronTranslateTo('De două ori pe oră de 5 ori pe zi', '0,30 1-5 * * *');
        $this->assertCronTranslateTo('De 5 ori pe zi', '0 1-5 * * *');
        $this->assertCronTranslateTo('În fiecare minut de 5 ori pe zi', '* 1-5 * * *');
        $this->assertCronTranslateTo('De 5 ori pe lună la 1:00am', '0 1 1-5 * *');
        $this->assertCronTranslateTo('De 5 ori pe lună 2 luni pe an la 1:00am', '0 1 1-5 5,6 *');
        $this->assertCronTranslateTo('2 luni pe an în data de 5 la 1:00am', '0 1 5 5,6 *');
        $this->assertCronTranslateTo('În data de 5 a fiecărei luni 4 zile ale sătămânii la 1:00am', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('În fiecare 2 minute', '*/2 * * * *');
        $this->assertCronTranslateTo('În fiecare 2 minute', '1/2 * * * *');
        $this->assertCronTranslateTo('De 2 ori în fiecare 4 minute', '1,3/4 * * * *');
        $this->assertCronTranslateTo('De 3 ori în fiecare 5 minute', '1-3/5 * * * *');
        $this->assertCronTranslateTo('În fiecare 2 minute la 2pm', '*/2 14 * * *');
        $this->assertCronTranslateTo('O singură dată pe oră în fiecare 2  zile', '0 * */2 * *');
        $this->assertCronTranslateTo('În fiecare minut în fiecare 2 zile', '* * */2 * *');
        $this->assertCronTranslateTo('O singură dată în fiecare 2 ore', '0 */2 * * *');
        $this->assertCronTranslateTo('De 2 ori în fiecare 5 ore', '0 1,2/5 * * *');
        $this->assertCronTranslateTo('În fiecare minut 2 ore din 5', '* 1,2/5 * * *');
        $this->assertCronTranslateTo('În fiecare zi în fiecare 4 luni la 12:00am', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('În fiecare minut în fiecare 2 ore', '* */2 * * *');
        $this->assertCronTranslateTo('În fiecare minut în fiecare 3 ore în data de 2 a fiecărei luni', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('În fiecare minut la 8am', '* 8-8 * * *');
        $this->assertCronTranslateTo('În fiecare minut în luna Ianuarie', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('O singură dată pe oră', '@hourly');
        $this->assertCronTranslateTo('În fiecare zi la 12:00am', '@daily');
        $this->assertCronTranslateTo('În fiecare Sâmbătă la 12:00am', '@weekly');
        $this->assertCronTranslateTo('În data de 1 a fiecărei luni la 12:00am', '@monthly');
        $this->assertCronTranslateTo('În fiecare an în luna ianuarie în data de 1 la 12:00am', '@yearly');
        $this->assertCronTranslateTo('În fiecare an în luna ianuarie în data de 1 la 12:00am', '@annually');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateTo('În fiecare zi la 10:30pm', '30 22 * * *', 'en', false);
        $this->assertCronTranslateTo('În fiecare zi la 22:30', '30 22 * * *', 'en', true);
        $this->assertCronTranslateTo('În fiecare minut la 6am', '* 6 * * *', 'en', false);
        $this->assertCronTranslateTo('În fiecare minut la 6:00', '* 6 * * *', 'en', true);
    }

    public function assertCronTranslateToRo(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'ro', $timeFormat24hours);
    }
}
