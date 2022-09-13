<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorFRTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_french(): void
    {
        $this->assertCronTranslateToFR('Chaque minute', '* * * * *');
        $this->assertCronTranslateToFR('Chaque minute les dimanches', '* * * * 0');
        $this->assertCronTranslateToFR('Chaque minute toutes les 2 heures', '* */2 * * *');
        $this->assertCronTranslateToFR('Chaque minute toutes les 3 heures le 2 de chaque mois', '* 1/3 2 * *');
        $this->assertCronTranslateToFR('Chaque année le 1er janvier à 1:01am', '1 1 1 1 *');
        $this->assertCronTranslateToFR('Chaque mercredi à 10:00am', '0 10 * * 3');
        $this->assertCronTranslateToFR('Les mardis le 2 février à 2:02am', '2 2 2 2 2');
        $this->assertCronTranslateToFR('4 fois par jour', '0 2,8,14,20 * * *');
    }

    public function assertCronTranslateToFR(string $expected, string $actual, bool $timeFormat24hours = false): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'fr', $timeFormat24hours);
    }
}
