<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorDETest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        // All 32 (2^5) combinations of alle/Once.
        $this->assertCronTranslateToIT('Ogni minuto', '* * * * *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica', '* * * * 0');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio', '* * * 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel mese di Gennaio', '* * * 1 0');
        $this->assertCronTranslateToIT('Ogni minuto nel primo giorno di ogni mese', '* * 1 * *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel primo giorno di ogni mese', '* * 1 * 0');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio e nel primo giorno', '* * 1 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel mese di Gennaio e nel primo giorno', '* * 1 1 0');
        $this->assertCronTranslateToIT('Ogni minuto alle 0:00', '* 0 * * *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica alle 0:00', '* 0 * * 0');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio alle 0:00', '* 0 * 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel mese di Gennaio alle 0:00', '* 0 * 1 0');
        $this->assertCronTranslateToIT('Ogni minuto nel primo giorno di ogni mese alle 0:00', '* 0 1 * *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel primo giorno di ogni mese alle 0:00', '* 0 1 * 0');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio e nel primo giorno alle 0:00', '* 0 1 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Domenica nel mese di Gennaio e nel primo giorno alle 0:00', '* 0 1 1 0');
        $this->assertCronTranslateToIT('Una volta all\'ora', '0 * * * *');
        $this->assertCronTranslateToIT('Una volta all\'ora nel giorno Domenica', '0 * * * 0');
        $this->assertCronTranslateToIT('Una volta all\'ora nel mese di Gennaio', '0 * * 1 *');
        $this->assertCronTranslateToIT('Una volta all\'ora nel giorno Domenica nel mese di Gennaio', '0 * * 1 0');
        $this->assertCronTranslateToIT('Una volta all\'ora nel primo giorno di ogni mese', '0 * 1 * *');
        $this->assertCronTranslateToIT('Una volta all\'ora nel giorno Domenica nel primo giorno di ogni mese', '0 * 1 * 0');
        $this->assertCronTranslateToIT('Una volta all\'ora nel mese di Gennaio e nel primo giorno', '0 * 1 1 *');
        $this->assertCronTranslateToIT('Una volta all\'ora nel giorno Domenica nel mese di Gennaio e nel primo giorno', '0 * 1 1 0');
        $this->assertCronTranslateToIT('Ogni giorno alle 0:00', '0 0 * * *');
        $this->assertCronTranslateToIT('Ogni Domenica alle 0:00', '0 0 * * 0');
        $this->assertCronTranslateToIT('Ogni giorno nel mese di Gennaio alle 0:00', '0 0 * 1 *');
        $this->assertCronTranslateToIT('Ogni Domenica nel mese di Gennaio alle 0:00', '0 0 * 1 0');
        $this->assertCronTranslateToIT('Nel primo giorno di ogni mese alle 0:00', '0 0 1 * *');
        $this->assertCronTranslateToIT('Nel primo giorno di ogni mese nel giorno Domenica alle 0:00', '0 0 1 * 0');
        $this->assertCronTranslateToIT('Ogni anno nel mese di Gennaio e nel primo giorno alle 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToIT('nel giorno Domenica nel mese di Gennaio e nel primo giorno alle 0:00', '0 0 1 1 0');

        // More realistic examples.
        $this->assertCronTranslateToIT('Ogni anno nel mese di Gennaio e nel primo giorno alle 12:00', '0 12 1 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Lunedì alle 15:00', '* 15 * * 1');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio e nel terzo giorno', '* * 3 1 *');
        $this->assertCronTranslateToIT('Ogni minuto nel giorno Lunedì nel mese di Aprile', '* * * 4 1');
        $this->assertCronTranslateToIT('nel giorno Lunedì nel mese di Aprile e nel 22esimo giorno alle 15:10', '10 15 22 4 1');
        $this->assertCronTranslateToIT('Ogni giorno alle 22:00', '0 22 * * *');
        $this->assertCronTranslateToIT('Ogni giorno alle 9:00', '0 9 * * *');
        $this->assertCronTranslateToIT('Ogni Lunedì alle 16:00', '0 16 * * 1');
        $this->assertCronTranslateToIT('Ogni anno nel mese di Gennaio e nel primo giorno alle 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToIT('Nel primo giorno di ogni mese alle 0:00', '0 0 1 * *');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateToIT('Ogni minuto 2 ore al giorno', '* 8,18 * * *');
        $this->assertCronTranslateToIT('Ogni minuto 3 ore al giorno', '* 8,18,20 * * *');
        $this->assertCronTranslateToIT('Ogni minuto 20 ore al giorno', '* 1-20 * * *');
        $this->assertCronTranslateToIT('2 volte all\'ora', '0,30 * * * *');
        $this->assertCronTranslateToIT('2 volte all\'ora 5 ore al giorno', '0,30 1-5 * * *');
        $this->assertCronTranslateToIT('5 volte al giorno', '0 1-5 * * *');
        $this->assertCronTranslateToIT('Ogni minuto 5 ore al giorno', '* 1-5 * * *');
        $this->assertCronTranslateToIT('5 giorni al mese alle 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToIT('5 giorni al mese 2 mesi all\'anno alle 1:00', '0 1 1-5 5,6 *');
        $this->assertCronTranslateToIT('2 mesi all\'anno nel quinto giorno alle 1:00', '0 1 5 5,6 *');
        $this->assertCronTranslateToIT('Nel quinto giorno di ogni mese 4 giorni alla settimana alle 1:00', '0 1 5 * 1-4');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateToIT('Ogni 2 minuti', '*/2 * * * *');
        $this->assertCronTranslateToIT('Ogni 2 minuti', '1/2 * * * *');
        $this->assertCronTranslateToIT('2 volte ogni 4 minuti', '1,3/4 * * * *');
        $this->assertCronTranslateToIT('3 volte ogni 5 minuti', '1-3/5 * * * *');
        $this->assertCronTranslateToIT('Ogni 2 minuti alle 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToIT('Una volta all\'ora ogni 2 giorni', '0 * */2 * *');
        $this->assertCronTranslateToIT('Ogni minuto ogni 2 giorni', '* * */2 * *');
        $this->assertCronTranslateToIT('1 volta ogni 2 ore', '0 */2 * * *');
        $this->assertCronTranslateToIT('2 volte ogni 5 ore', '0 1,2/5 * * *');
        $this->assertCronTranslateToIT('Ogni minuto 2 ore ogni 5', '* 1,2/5 * * *');
        $this->assertCronTranslateToIT('Ogni giorno ogni 4 mesi alle 0:00', '0 0 * */4 *');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateToIT('Ogni minuto di ogni 2 ore', '* */2 * * *');
        $this->assertCronTranslateToIT('Ogni minuto di ogni 3 ore nel secondo giorno di ogni mese', '* 1/3 2 * *');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateToIT('Ogni minuto alle 8:00', '* 8-8 * * *');
        $this->assertCronTranslateToIT('Ogni minuto nel mese di Gennaio', '* * * 1-1 *');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateToIT('Una volta all\'ora', '@hourly');
        $this->assertCronTranslateToIT('Ogni giorno alle 0:00', '@daily');
        $this->assertCronTranslateToIT('Ogni Domenica alle 0:00', '@weekly');
        $this->assertCronTranslateToIT('Nel primo giorno di ogni mese alle 0:00', '@monthly');
        $this->assertCronTranslateToIT('Ogni anno nel mese di Gennaio e nel primo giorno alle 0:00', '@yearly');
        $this->assertCronTranslateToIT('Ogni anno nel mese di Gennaio e nel primo giorno alle 0:00', '@annually');
    }

    // TODO: missing test 'days_of_week' => 'multiple_per_increment'.

    public function assertCronTranslateToIT(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'it', $timeFormat24hours);
    }
}
