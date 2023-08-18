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
        '@reboot' => '@reboot',
        '@yearly' => '0 0 1 1 *',
        '@annually' => '0 0 1 1 *',
        '@monthly' => '0 0 1 * *',
        '@weekly' => '0 0 * * 0',
        '@daily' => '0 0 * * *',
        '@midnight' => '0 0 * * *',
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
            $translations = (new LanguageLoader($locale))->translations;

            if (str_starts_with($cron, '@')) {
                return self::mbUcfirst($translations["fields"]["extended"][$cron]);
            }

            $expression = new CronExpression($cron, $translations, $timeFormat24hours);
            $fields = $expression->getFields();
            $orderedFields = self::orderFields($fields);

            $answer = array_map(fn (Field $field) => $field->translate(), $orderedFields);

            return self::mbUcfirst(implode(' ', array_filter($answer)));
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
            array_slice($everys, 0, $numberOfEverysKept),
            $incrementsAndMultiples,
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

    /**
     * Capitalize the first letter
     *
     * @param string $string 
     * @return string 
     */
    protected static function mbUcfirst(string $string): string
    {
        $fc = mb_strtoupper(mb_substr($string, 0, 1));
        return $fc . mb_substr($string, 1);
    }
}
