<?php

namespace Lorisleiva\CronTranslator;

use Throwable;

class CronTranslator
{
    /**
     * @throws CronParsingException|TranslationFileMissingException
     */
    public static function translate(
        string $cron,
        string $locale = 'en',
        bool $timeFormat24hours = false
    ): string {
        return static::translateExpression(
            static::parse($cron, $locale, $timeFormat24hours)
        );
    }

    /**
     * @throws CronParsingException
     */
    public static function translateExpression(CronExpression $expression): string
    {
        try {
            return $expression->translate();
        } catch (Throwable $th) {
            throw new CronParsingException($expression->raw);
        }
    }

    /**
     * @throws CronParsingException|TranslationFileMissingException
     */
    public static function parse(
        string $cron,
        string $locale = 'en',
        bool $timeFormat24hours = false
    ): CronExpression {
        return new CronExpression($cron, $locale, $timeFormat24hours);
    }
}
