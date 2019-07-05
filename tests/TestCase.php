<?php

namespace Lorisleiva\CronTranslator\Tests;

use Lorisleiva\CronTranslator\CronTranslator;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function assertCronTranslateTo($expected, $actual)
    {
        $this->assertEquals($expected, CronTranslator::translate($actual));
    }
}
