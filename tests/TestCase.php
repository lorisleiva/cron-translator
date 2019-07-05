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

    public function generateCombinationsFromMatrix($matrix)
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
            echo "\n" . $cron . "\t=> " . CronTranslator::translate($cron);
        }
    }
}
