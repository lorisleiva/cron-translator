<?php

namespace Lorisleiva\CronTranslator;

use Exception;

class TranslationDirMissingException extends Exception
{
    public function __construct(string $locale)
    {
        parent::__construct("Failed to find the translation directory for locale [{$locale}].");
    }
}
