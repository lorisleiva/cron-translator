<?php

namespace Lorisleiva\CronTranslator;

class CronType
{
    public $type;
    public $value;
    public $count;
    public $increment;

    private function __construct($type, $value = null, $count = null, $increment = null)
    {
        $this->type = $type;
        $this->value = $value;
        $this->count = $count;
        $this->increment = $increment;
    }

    public static function every()
    {
        return new static('Every');
    }

    public static function Increment($increment, $count = 1)
    {
        return new static('Increment', null, $count, $increment);
    }

    public static function Multiple($count)
    {
        return new static('Multiple', null, $count);
    }

    public static function once($value)
    {
        return new static('Once', $value);
    }

    public static function parse($expression)
    {
        // Parse "*".
        if ($expression === '*') {
            return static::every();
        }

        // Parse fixed values like "1".
        if (preg_match("/^[0-9]+$/", $expression)) {
            return static::once((int) $expression);
        }

        // Parse multiple selected values like "1,2,5".
        if (preg_match("/^[0-9]+(,[0-9]+)+$/", $expression)) {
            return static::multiple(count(explode(',', $expression)));
        }

        // Parse ranges of selected values like "1-5".
        if (preg_match("/^([0-9]+)\-([0-9]+)$/", $expression, $matches)) {
            $count = $matches[2] - $matches[1] + 1;
            return $count > 1 
                ? static::multiple($count) 
                : static::once((int) $matches[1]);
        }

        // Parse incremental expressions like "*/2", "1-4/10" or "1,3/4".
        if (preg_match("/(.+)\/([0-9]+)$/", $expression, $matches)) {
            $range = static::parse($matches[1]);
            if ($range->hasType('Once', 'Every')) {
                return static::Increment($matches[2]);
            }
            if ($range->hasType('Multiple')) {
                return static::Increment($matches[2], $range->count);
            }
            throw new \Exception('Parsing error');
        }

        // Unsupported expressions throw exceptions.
        throw new \Exception('Parsing error');
    }

    public function hasType()
    {
        return in_array($this->type, func_get_args());
    }
}
