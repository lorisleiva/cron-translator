<?php

namespace Lorisleiva\CronTranslator\Tests;

class CronTranslatorTest extends TestCase
{
    /** @test */
    public function it_translates_expressions_with_every_and_once()
    {
        $this->assertCronTranslateTo('Every minute', '* * * * *');
        $this->assertCronTranslateTo('Every hour', '0 * * * *');
        $this->assertCronTranslateTo('Every day at 12:00am', '0 0 * * *');
        $this->assertCronTranslateTo('The 1st of every month at 12:00am', '0 0 1 * *');
        $this->assertCronTranslateTo('Every minute on the 1st of every month at 12am', '* 0 1 * *');
        // $this->assertCronTranslateTo('Every year on January the 1st', '0 0 1 1 *');
        // $this->assertCronTranslateTo('Every minute on Mondays at 3pm', '* 15 * * 1');
    }
}
