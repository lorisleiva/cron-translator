<?php

namespace Lorisleiva\CronTranslator;

abstract class Field
{
    /** @var CronExpression */
    public $expression;

    /** @var string */
    public $rawField;

    /** @var CronType */
    public $type;

    /** @var bool */
    public $dropped = false;

    /** @var int */
    public $position;

    public function __construct(CronExpression $expression, string $rawField)
    {
        $this->expression = $expression;
        $this->rawField = $rawField;
        $this->type = CronType::parse($expression);
    }

    public function translate($fields)
    {
        foreach (CronType::TYPES as $type) {
            if ($this->hasType($type) && method_exists($this, "translate{$type}")) {
                return $this->{"translate{$type}"}($fields);
            }
        }
    }

    public function hasType()
    {
        return in_array($this->type, func_get_args());
    }

    public function times($count)
    {
        switch ($count) {
            case 1: return $this->lang('times.once');
            case 2: return $this->lang('times.twice');
            default: return $this->lang('times.count', ['count' => $count]);
        }
    }

    public function lang($key, $replace = [])
    {
        // Get translation value by key. Dot notation is supported.
        $translation = $this->getLangValue($key);

        // Replace placeholders with associated values. Multiple placeholders are supported.
        foreach ($replace as $key => $value) {
            $translation = str_replace(':' . $key, $value, $translation);
        }

        return $translation;
    }

    public function isEnglishLocale()
    {
        return $this->locale === 'en';
    }

    public function clock24Hour()
    {
        return $this->clock === '24hour';
    }

    private function getLangValue($key)
    {
        // Key can be a simple string or it can contain dot notation.
        $keys = explode('.', $key);

        // Create temporary variable. At this point $translation contains an array.
        $translation = $this->translations;

        // Find value for deepest $key level. As a result, $translation will contain a string.
        foreach ($keys as $key) {
            $translation = $translation[$key];
        }

        return $translation;
    }

    private function loadTranslations()
    {
        return include "lang/{$this->locale}/translations.php";
    }

    private function loadMonths()
    {
        return include "lang/{$this->locale}/months.php";
    }

    private function loadDays()
    {
        return include "lang/{$this->locale}/days.php";
    }
}
