<?php

use Lorisleiva\CronTranslator\Tests\TestCase;

class CronTranslatorCSTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once(): void
    {
        $this->assertCronTranslateTo('Každou minutu', '* * * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli', '* * * * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v měsíci lednu', '* * * 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v měsíci lednu', '* * * 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu na každý 1. den v měsíci', '* * 1 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli na každý 1. den v měsíci', '* * 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu na 1. den v měsíci lednu', '* * 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli na 1. den v měsíci lednu', '* * 1 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v 0:00', '* 0 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v 0:00', '* 0 * * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu v měsíci lednu v 0:00', '* 0 * 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli v měsíci lednu v 0:00', '* 0 * 1 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu na každý 1. den v měsíci v 0:00', '* 0 1 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli na každý 1. den v měsíci v 0:00', '* 0 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každou minutu na 1. den v měsíci lednu v 0:00', '* 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v neděli na 1. den v měsíci lednu v 0:00', '* 0 1 1 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu', '0 * * * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli', '0 * * * 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v měsíci lednu', '0 * * 1 *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli v měsíci lednu', '0 * * 1 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu na každý 1. den v měsíci', '0 * 1 * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli na každý 1. den v měsíci', '0 * 1 * 0', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu na 1. den v měsíci lednu', '0 * 1 1 *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu v neděli na 1. den v měsíci lednu', '0 * 1 1 0', 'cs');
        $this->assertCronTranslateTo('Každý den v 0:00', '0 0 * * *', 'cs');
        $this->assertCronTranslateTo('Každá neděle v 0:00', '0 0 * * 0', 'cs');
        $this->assertCronTranslateTo('Každý den v měsíci lednu v 0:00', '0 0 * 1 *', 'cs');
        $this->assertCronTranslateTo('Každé neděle v měsíci lednu v 0:00', '0 0 * 1 0', 'cs');
        $this->assertCronTranslateTo('Každý 1. den v měsíci v 0:00', '0 0 1 * *', 'cs');
        $this->assertCronTranslateTo('Každý 1. den v měsíci v neděli v 0:00', '0 0 1 * 0', 'cs');
        $this->assertCronTranslateTo('Každý rok na 1. den v měsíci lednu v 0:00', '0 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('V neděli na 1. den v měsíci lednu v 0:00', '0 0 1 1 0', 'cs');

        $this->assertCronTranslateTo('Každý rok na 1. den v měsíci lednu v 12:00', '0 12 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v pondělí v 15:00', '* 15 * * 1', 'cs');
        $this->assertCronTranslateTo('Každou minutu na 3. den v měsíci lednu', '* * 3 1 *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v pondělí v měsíci dubnu', '* * * 4 1', 'cs');
        $this->assertCronTranslateTo('V pondělí na 22. den v měsíci dubnu v 15:10', '10 15 22 4 1', 'cs');

        $this->assertCronTranslateTo('Každý den v 22:00', '0 22 * * *', 'cs');
        $this->assertCronTranslateTo('Každý den v 9:00', '0 9 * * *', 'cs');
        $this->assertCronTranslateTo('Každé pondělí v 16:00', '0 16 * * 1', 'cs');
        $this->assertCronTranslateTo('Každý rok na 1. den v měsíci lednu v 0:00', '0 0 1 1 *', 'cs');
        $this->assertCronTranslateTo('Každý 1. den v měsíci v 0:00', '0 0 1 * *', 'cs');
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('Každou minutu 2 hodin za den', '* 8,18 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 3 hodin za den', '* 8,18,20 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 20 hodin za den', '* 1-20 * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát za hodinu', '0,30 * * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát za hodinu 5 hodin za den', '0,30 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('Pětkrát za den', '0 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu 5 hodin za den', '* 1-5 * * *', 'cs');
        $this->assertCronTranslateTo('5 dnů v měsíci v 1:00', '0 1 1-5 * *', 'cs');
        $this->assertCronTranslateTo('5 dnů v měsíci 2 měsíců ročně v 1:00', '0 1 1-5 5,6 *', 'cs');
        $this->assertCronTranslateTo('2 měsíců ročně 5. dne v měsíci v 1:00', '0 1 5 5,6 *', 'cs');
        $this->assertCronTranslateTo('Každý 5. den v měsíci 4 dnů v týdnu v 1:00', '0 1 5 * 1-4', 'cs');
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('Každých 2 minut', '*/2 * * * *', 'cs');
        $this->assertCronTranslateTo('Každých 2 minut', '1/2 * * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát každých 4 minut', '1,3/4 * * * *', 'cs');
        $this->assertCronTranslateTo('Třikrát každých 5 minut', '1-3/5 * * * *', 'cs');
        $this->assertCronTranslateTo('Každých 2 minut v 14:00', '*/2 14 * * *', 'cs');
        $this->assertCronTranslateTo('Jednou za hodinu každých 2 dnů', '0 * */2 * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu každých 2 dnů', '* * */2 * *', 'cs');
        $this->assertCronTranslateTo('Jednou každých 2 hodin', '0 */2 * * *', 'cs');
        $this->assertCronTranslateTo('Dvakrát každých 5 hodin', '0 1,2/5 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu ze 5 hodin', '* 1,2/5 * * *', 'cs');
        $this->assertCronTranslateTo('Každý den každých 4 měsíců v 0:00', '0 0 * */4 *', 'cs');
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('Každou minutu každých 2 hodin', '* */2 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu každých 3 hodin na každý 2. den v měsíci', '* 1/3 2 * *', 'cs');
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('Každou minutu v 8:00', '* 8-8 * * *', 'cs');
        $this->assertCronTranslateTo('Každou minutu v měsíci lednu', '* * * 1-1 *', 'cs');
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('Jednou za hodinu', '@hourly', 'cs');
        $this->assertCronTranslateTo('Každý den v 0:00', '@daily', 'cs');
        $this->assertCronTranslateTo('Každá neděle v 0:00', '@weekly', 'cs');
        $this->assertCronTranslateTo('Každý 1. den v měsíci v 0:00', '@monthly', 'cs');
        $this->assertCronTranslateTo('Každý rok na 1. den v měsíci lednu v 0:00', '@yearly', 'cs');
        $this->assertCronTranslateTo('Každý rok na 1. den v měsíci lednu v 0:00', '@annually', 'cs');
    }
}
