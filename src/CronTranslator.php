<?php

namespace Lorisleiva\CronTranslator;

use Throwable;

class CronTranslator
{

    /**
     * Extended cron map
     * 
     * @var array
     */
    private static array $extendedMap = [
        '@yearly' => '0 0 1 1 *',
        '@annually' => '0 0 1 1 *',
        '@monthly' => '0 0 1 * *',
        '@weekly' => '0 0 * * 0',
        '@daily' => '0 0 * * *',
        '@hourly' => '0 * * * *'
    ];

    /**
     * Translate a cron expression
     * 
     * @param string $cron The cron expression
     * @param string $locale The locale 
     * @param bool $timeFormat24hours Use 24 hour time
     *
     * @return string The translated expression
     *
     * @throws CronParsingException
     */
    public static function translate(string $cron, string $locale = 'en', bool $timeFormat24hours = false): string
    {
        // Use extended map if available
        if (isset(self::$extendedMap[$cron])) {
            $cron = self::$extendedMap[$cron];
        }

        try {
            // Parse expression
            $expression = new CronExpression($cron, $locale, $timeFormat24hours);

            // Optimize: get fields once
            $fields = $expression->getFields();

            // Order fields
            $orderedFields = self::orderFields($fields);

            // Translate fields
            $translations = array_map(fn (Field $field) => $field->translate(), $orderedFields);

            // Generate translation
            return ucfirst(implode(' ', array_filter($translations)));
        } catch (Throwable $th) {
            throw new CronParsingException($cron);
        }
    }

    /**
     * Order fields
     *
     * @param array $fields The fields
     *
     * @return array Ordered fields
     */
    protected static function orderFields(array $fields): array
    {
        // Filter by field type
        $onces = self::filterByType($fields, 'Once');
        $everys = self::filterByType($fields, 'Every');
        $incrementsAndMultiples = self::filterByType($fields, 'Increment', 'Multiple');

        // Only keep first every if incrementals exist
        $firstEvery = reset($everys)->position ?? PHP_INT_MIN;
        $firstIncrementOrMultiple = reset($incrementsAndMultiples)->position ?? PHP_INT_MAX;
        $numberOfEverysKept = $firstIncrementOrMultiple < $firstEvery ? 0 : 1;

        // Mark dropped fields
        array_map(fn (Field $field) => $field->dropped = true, array_slice($everys, $numberOfEverysKept));

        return array_merge(
            // First every
            array_slice($everys, 0, $numberOfEverysKept),

            // Incrementals
            $incrementsAndMultiples,

            // Reversed onces
            array_reverse($onces)
        );
    }

    /**
     * Filter fields by type
     * 
     * @param array $fields The fields
     * @param string ...$types The types
     *
     * @return array The filtered fields
     */
    protected static function filterByType(array $fields, string ...$types): array
    {
        return array_filter($fields, fn (Field $field) => $field->hasType(...$types));
    }
}
