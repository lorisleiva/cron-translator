<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorTRTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_turkish(): void
    {
        $this->assertCronTranslateToTR('Her dakika', '* * * * *');
        $this->assertCronTranslateToTR('Her dakika Pazar günü', '* * * * 0');
        $this->assertCronTranslateToTR('Her dakika her 2 saatte bir', '* */2 * * *');
        $this->assertCronTranslateToTR('Saatte iki kez', '0,30 * * * *');
        $this->assertCronTranslateToTR('Her Çarşamba saat 10:00', '0 10 * * 3', true);
        $this->assertCronTranslateToTR('Günde 5 kez', '0 1-5 * * *', true);
        $this->assertCronTranslateToTR('Her ayın 1\'inci günü saat 0:00', '0 0 1 * *', true);
        $this->assertCronTranslateToTR('Her yıl Ocak ayında 1\'inci günü saat 0:00', '0 0 1 1 *', true);
        $this->assertCronTranslateToTR('Her Çarşamba saat 15:10', '10 15 * * 3', true);
        $this->assertCronTranslateToTR('Başlangıçta bir kez', '@reboot');
    }

    public function assertCronTranslateToTR(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'tr', $timeFormat24hours);
    }
}
