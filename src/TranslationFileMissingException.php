<?php

namespace Lorisleiva\CronTranslator;

use Exception;

/**
 * Exception when translation file is missing
 */
class TranslationFileMissingException extends Exception
{

    /**
     * Constructor 
     *
     * @param string $locale The locale
     * @param string $file The missing file
     */
    public function __construct(string $locale, string $file)
    {
        parent::__construct("Failed to load the translation file [{$file}] from the locale [{$locale}].");
    }
}
