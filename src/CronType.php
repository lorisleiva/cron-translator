<?php

namespace Lorisleiva\CronTranslator;

class CronType
{
    const TYPES = [
        'Every', 'Increment', 'Multiple', 'Once',
    ];

    /** @var string */
    public $type;

    /** @var ?int */
    public $value;

    /** @var ?int */
    public $count;

    /** @var ?int */
    public $increment;

    private function __construct(string $type, ?int $value = null, ?int $count = null, ?int $increment = null)
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

    public static function increment(int $increment, int $count = 1)
    {
        return new static('Increment', null, $count, $increment);
    }

    public static function multiple(int $count)
    {
        return new static('Multiple', null, $count);
    }

    public static function once(int $value)
    {
        return new static('Once', $value);
    }

    public static function parse(string $expression)
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

        // Parse ranges of selected values like "1-5,21-23" - it's multiple.
        if (preg_match("/^([0-9]+)\-([0-9]+),([0-9]+)\-([0-9]+)$/", $expression, $matches)) {
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
        }

        // Unsupported expressions throw exceptions.
        throw new CronParsingException($expression);
    }

    public function hasType()
    {
        return in_array($this->type, func_get_args());
    }
}
