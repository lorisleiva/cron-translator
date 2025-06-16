<?php /** @noinspection PhpRedundantOptionalArgumentInspection */

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorDATest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_hver_and_once(): void
    {
        // All 32 (2^5) combinations of Every/Once.
        $this->assertCronTranslateTo('Hvert minut', '* * * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage', '* * * * 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut i Januar', '* * * 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage i Januar', '* * * 1 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut den 1. hver måned', '* * 1 * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage den 1. hver måned', '* * 1 * 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut den 1. Januar', '* * 1 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage den 1. Januar', '* * 1 1 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut kl. 0:00', '* 0 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage kl. 0:00', '* 0 * * 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut i Januar kl. 0:00', '* 0 * 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage i Januar kl. 0:00', '* 0 * 1 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut den 1. hver måned kl. 0:00', '* 0 1 * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage den 1. hver måned kl. 0:00', '* 0 1 * 0', 'da', true);
        $this->assertCronTranslateTo('Hvert minut den 1. Januar kl. 0:00', '* 0 1 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Søndage den 1. Januar kl. 0:00', '* 0 1 1 0', 'da', true);
        $this->assertCronTranslateTo('En gang i timen', '0 * * * *', 'da', true);
        $this->assertCronTranslateTo('En gang i timen på Søndage', '0 * * * 0', 'da', true);
        $this->assertCronTranslateTo('En gang i timen i Januar', '0 * * 1 *', 'da', true);
        $this->assertCronTranslateTo('En gang i timen på Søndage i Januar', '0 * * 1 0', 'da', true);
        $this->assertCronTranslateTo('En gang i timen den 1. hver måned', '0 * 1 * *', 'da', true);
        $this->assertCronTranslateTo('En gang i timen på Søndage den 1. hver måned', '0 * 1 * 0', 'da', true);
        $this->assertCronTranslateTo('En gang i timen den 1. Januar', '0 * 1 1 *', 'da', true);
        $this->assertCronTranslateTo('En gang i timen på Søndage den 1. Januar', '0 * 1 1 0', 'da', true);
        $this->assertCronTranslateTo('Alle dage kl. 0:00', '0 0 * * *', 'da', true);
        $this->assertCronTranslateTo('Hver Søndag kl. 0:00', '0 0 * * 0', 'da', true);
        $this->assertCronTranslateTo('Alle dage i Januar kl. 0:00', '0 0 * 1 *', 'da', true);
        $this->assertCronTranslateTo('Hver Søndag i Januar kl. 0:00', '0 0 * 1 0', 'da', true);
        $this->assertCronTranslateTo('Den 1. hver måned kl. 0:00', '0 0 1 * *', 'da', true);
        $this->assertCronTranslateTo('Den 1. hver måned på Søndage kl. 0:00', '0 0 1 * 0', 'da', true);
        $this->assertCronTranslateTo('Hvert år den 1. Januar kl. 0:00', '0 0 1 1 *', 'da', true);
        $this->assertCronTranslateTo('På Søndage den 1. Januar kl. 0:00', '0 0 1 1 0', 'da', true);

        // More realistic examples.
        $this->assertCronTranslateTo('Hvert år den 1. Januar kl. 12:00', '0 12 1 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Mandage kl. 15:00', '* 15 * * 1', 'da', true);
        $this->assertCronTranslateTo('Hvert minut den 3. Januar', '* * 3 1 *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut på Mandage i April', '* * * 4 1', 'da', true);
        $this->assertCronTranslateTo('På Mandage den 22. April kl. 15:10', '10 15 22 4 1', 'da', true);

        // Paparazzi examples.
        $this->assertCronTranslateTo('Alle dage kl. 22:00', '0 22 * * *', 'da', true);
        $this->assertCronTranslateTo('Alle dage kl. 9:00', '0 9 * * *', 'da', true);
        $this->assertCronTranslateTo('Hver Mandag kl. 16:00', '0 16 * * 1', 'da', true);
        $this->assertCronTranslateTo('Hvert år den 1. Januar kl. 0:00', '0 0 1 1 *', 'da', true);
        $this->assertCronTranslateTo('Den 1. hver måned kl. 0:00', '0 0 1 * *', 'da', true);
    }

    /** @test */
    public function it_translate_expressions_with_multiple(): void
    {
        $this->assertCronTranslateTo('Hvert minut 2 timer om dagen', '* 8,18 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut 3 timer om dagen', '* 8,18,20 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut 20 timer om dagen', '* 1-20 * * *', 'da', true);
        $this->assertCronTranslateTo('To i timen', '0,30 * * * *', 'da', true);
        $this->assertCronTranslateTo('To i timen 5 timer om dagen', '0,30 1-5 * * *', 'da', true);
        $this->assertCronTranslateTo('5 gange om dagen', '0 1-5 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut 5 timer om dagen', '* 1-5 * * *', 'da', true);
        $this->assertCronTranslateTo('5 dage om måneden kl. 1:00', '0 1 1-5 * *', 'da', true);
        $this->assertCronTranslateTo('5 dage om måneden 2 måneder om året kl. 1:00', '0 1 1-5 5,6 *', 'da', true);
        $this->assertCronTranslateTo('2 måneder om året på dag 5. kl. 1:00', '0 1 5 5,6 *', 'da', true);
        $this->assertCronTranslateTo('Den 5. hver måned 4 dage om ugen kl. 1:00', '0 1 5 * 1-4', 'da', true);
    }

    /** @test */
    public function it_translate_expressions_with_increment(): void
    {
        $this->assertCronTranslateTo('Hver 2. minut', '*/2 * * * *', 'da', true);
        $this->assertCronTranslateTo('Hver 2. minut', '1/2 * * * *', 'da', true);
        $this->assertCronTranslateTo('To gange hver 4. minut', '1,3/4 * * * *', 'da', true);
        $this->assertCronTranslateTo('3 gange hver 5. minut', '1-3/5 * * * *', 'da', true);
        $this->assertCronTranslateTo('Hver 2. minut kl. 14:00', '*/2 14 * * *', 'da', true);
        $this->assertCronTranslateTo('En gang i timen hver 2. dag', '0 * */2 * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut hver 2. dag', '* * */2 * *', 'da', true);
        $this->assertCronTranslateTo('En gang hver 2. time', '0 */2 * * *', 'da', true);
        $this->assertCronTranslateTo('To gang hver 5. time', '0 1,2/5 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut 2 timer ud af 5', '* 1,2/5 * * *', 'da', true);
        $this->assertCronTranslateTo('Alle dage hver 4. måned kl. 0:00', '0 0 * */4 *', 'da', true);
    }

    /** @test */
    public function it_adds_junctions_to_certain_combinations_of_cron_types(): void
    {
        $this->assertCronTranslateTo('Hvert minut for hver 2. time', '* */2 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut for hver 3. time den 2. hver måned', '* 1/3 2 * *', 'da', true);
    }

    /** @test */
    public function it_converts_ranges_of_one_into_once_cron_types(): void
    {
        $this->assertCronTranslateTo('Hvert minut kl. 8:00', '* 8-8 * * *', 'da', true);
        $this->assertCronTranslateTo('Hvert minut i Januar', '* * * 1-1 *', 'da', true);
    }

    /** @test */
    public function it_handles_extended_cron_syntax(): void
    {
        $this->assertCronTranslateTo('Kør ved opstart', '@reboot', 'da', true);
        $this->assertCronTranslateTo('En gang i timen', '@hourly', 'da', true);
        $this->assertCronTranslateTo('Alle dage kl. 0:00', '@daily', 'da', true);
        $this->assertCronTranslateTo('Hver Søndag kl. 0:00', '@weekly', 'da', true);
        $this->assertCronTranslateTo('Den 1. hver måned kl. 0:00', '@monthly', 'da', true);
        $this->assertCronTranslateTo('Hvert år den 1. Januar kl. 0:00', '@yearly', 'da', true);
        $this->assertCronTranslateTo('Hvert år den 1. Januar kl. 0:00', '@annually', 'da', true);
    }

    /** @test */
    public function it_returns_parsing_errors_when_something_goes_wrong(): void
    {
        $this->assertCronThrowsParsingError('I_AM_NOT_A_CRON_EXPRESSION');
        $this->assertCronThrowsParsingError('A * * * *');
        $this->assertCronThrowsParsingError('1,2-3 * * * *');
        $this->assertCronThrowsParsingError('1/2/3 * * * *');
        $this->assertCronThrowsParsingError('* * * 0 *');
        $this->assertCronThrowsParsingError('* * * 13 *');
        $this->assertCronThrowsParsingError('* * * * 8');
    }
}