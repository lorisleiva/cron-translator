<?php

namespace Lorisleiva\CronTranslator;

use Exception;

/**
 * Exception for cron parsing errors
 */
class CronParsingException extends Exception
{

    /**
     * Constructor
     * 
     * @param string $cron The invalid cron expression
     */
    public function __construct(string $cron)
    {
        parent::__construct("Failed to parse the following CRON expression: $cron");
    }
}
