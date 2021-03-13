<?php

namespace Lorisleiva\CronTranslator\Tests;

use Lorisleiva\CronTranslator\CronTranslator;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Lorisleiva\CronTranslator\CronParsingException;

class TestCase extends BaseTestCase
{
    public function assertCronTranslateTo($expected, $actual, $locale = 'en', $timeFormat24hours = false)
    {
        $this->assertEquals($expected, CronTranslator::translate($actual, $locale, $timeFormat24hours));
    }

    public function assertCronThrowsParsingError($cron)
    {
        try {
            CronTranslator::translate($cron);
        } catch (CronParsingException $expression) {
            $this->addToAssertionCount(1);
        }

        $this->fail("Expected CronParsingError exception for [$cron]");
    }

    public function generateCombinationsFromMatrix($matrix, $locale = 'en', $timeFormat24hours = false)
    {
        function combinations($matrix, $acc = []) {
            if (empty($matrix)) {
                return [implode(' ', $acc)];
            }

            $current = array_shift($matrix);
            $results = [];

            foreach ($current as $value) {
                $results[] = combinations($matrix, array_merge($acc, [$value]));
            }

            return array_merge(...$results);
        }

        foreach (combinations($matrix) as $cron) {
            echo "\n" . $cron . "\t=> " . CronTranslator::translate($cron, $locale, $timeFormat24hours);
        }
    }
}
