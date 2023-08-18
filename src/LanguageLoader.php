<?php

namespace Lorisleiva\CronTranslator;

class LanguageLoader
{
    public $translations;
    public $locale;

    public function __construct(string $locale = 'en')
    {
        $this->locale = $locale;
        $this->loadTranslations();
    }

    /**
     * Ensure the locale exists or use a fallback
     *
     * @param string $fallbackLocale The fallback locale
     */
    protected function ensureLocaleExists(string $fallbackLocale = 'en'): void
    {
        if (!is_dir($this->getTranslationDirectory())) {
            $this->locale = $fallbackLocale;
        }
    }

    /**
     * Load the translation files
     *
     * @throws TranslationFileMissingException
     */
    protected function loadTranslations(): void
    {
        $this->translations = [
            'days' => $this->loadTranslationFile('days'),
            'fields' => $this->loadTranslationFile('fields'),
            'months' => $this->loadTranslationFile('months'),
            'ordinals' => $this->loadTranslationFile('ordinals'),
            'times' => $this->loadTranslationFile('times'),
        ];
    }

    /**
     * Load a single translation file
     *
     * @param string $file The file name 
     *
     * @return array
     *
     * @throws TranslationFileMissingException
     */
    protected function loadTranslationFile(string $file): array
    {
        $filename = sprintf('%s/%s.php', $this->getTranslationDirectory(), $file);

        if (!is_file($filename)) {
            throw new TranslationFileMissingException($this->locale, $file);
        }

        return include $filename;
    }

    /**
     * Get the translation directory
     *
     * @return string
     */
    protected function getTranslationDirectory(): string
    {
        return __DIR__ . '/lang/' . $this->locale;
    }
}
