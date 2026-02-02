<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorPTTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_to_french(): void
    {
        $this->assertCronTranslateToPT('Todos os minutos', '* * * * *');
        $this->assertCronTranslateToPT('Todos os minutos nas/nos Domingos', '* * * * 0');
        $this->assertCronTranslateToPT('Todos os minutos de cada 2 horas', '* */2 * * *');
        $this->assertCronTranslateToPT('Todos os minutos de cada 3 horas no 2º dia de cada mês', '* 1/3 2 * *');
        $this->assertCronTranslateToPT('Todos os anos no 1º de Janeiro às 1:01am', '1 1 1 1 *');
        $this->assertCronTranslateToPT('Cada Quarta-feira às 10:00am', '0 10 * * 3');
        $this->assertCronTranslateToPT('Nas/nos Terça-feiras no 2º de Fevereiro às 2:02am', '2 2 2 2 2');
        $this->assertCronTranslateToPT('Cada Segunda-feira e Quinta-feira às 9:00am', '0 9 * * 1,4');
        $this->assertCronTranslateToPT('Cada Segunda-feira, Quarta-feira e Sexta-feira às 9:00am', '0 9 * * 1,3,5');
        $this->assertCronTranslateToPT('Cada Sábado e Domingo às 10:00am', '0 10 * * 6,0');
    }

    public function assertCronTranslateToPT(string $expected, string $actual, bool $timeFormat24hours = false): void
    {
        $this->assertCronTranslateTo($expected, $actual, 'pt', $timeFormat24hours);
    }
}
