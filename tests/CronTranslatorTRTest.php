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
        $this->assertCronTranslateToTR('Her Çarşamba saat 10:00', '0 10 * * 3');
        $this->assertCronTranslateToTR('Günde 5 kez', '0 1-5 * * *');
        $this->assertCronTranslateToTR('Her ayın 1\'inci günü saat 0:00', '0 0 1 * *');
        $this->assertCronTranslateToTR('Her yıl Ocak ayında 1\'inci günü saat 0:00', '0 0 1 1 *');
        $this->assertCronTranslateToTR('Her Çarşamba saat 15:10', '10 15 * * 3');
        $this->assertCronTranslateToTR('Başlangıçta bir kez', '@reboot');
    }

    /** @test */
    public function it_translates_increments_multiples_and_ranges_to_turkish(): void
    {
        $this->assertCronTranslateToTR('Her 2 dakikada bir saat 14:00', '*/2 14 * * *');
        $this->assertCronTranslateToTR('Her dakika günde 2 saat', '* 8,18 * * *');
        $this->assertCronTranslateToTR('Her dakika 5 saatten 2', '* 1,2/5 * * *');
        $this->assertCronTranslateToTR('Ayda 5 gün saat 1:00', '0 1 1-5 * *');
        $this->assertCronTranslateToTR('Her gün haftada 4 gün saat 9:00', '0 9 * * 1-4');
        $this->assertCronTranslateToTR('Her yıl Haziran ayında 15\'inci günü saat 12:00', '0 12 15 6 *');
    }

    /** @test */
    public function it_can_format_the_time_in_12_and_24_hours(): void
    {
        $this->assertCronTranslateToTR('Her gün saat 10:30 akşam', '30 22 * * *', false);
        $this->assertCronTranslateToTR('Her gün saat 22:30', '30 22 * * *', true);
        $this->assertCronTranslateToTR('Her dakika saat 6 sabah', '* 6 * * *', false);
        $this->assertCronTranslateToTR('Her dakika saat 6:00', '* 6 * * *', true);
    }

    public function assertCronTranslateToTR(string $expected, string $actual, bool $timeFormat24hours = true): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'tr', $timeFormat24hours);
    }
}
