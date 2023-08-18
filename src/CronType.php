<?php

namespace Lorisleiva\CronTranslator;

/**
 * Class representing a cron schedule type
 */
class CronType
{

    /**
     * The cron type constants
     */
    public const TYPES = [
        'Every',
        'Increment',
        'Multiple',
        'Once',
    ];

    public string $type;
    public ?int $value;
    public ?int $count;
    public ?int $increment;

    /**
     * Constructor 
     *
     * @param string $type The cron type  
     * @param int|null $value The cron value
     * @param int|null $count The cron count
     * @param int|null $increment The cron increment
     */
    private function __construct(string $type, ?int $value = null, ?int $count = null, ?int $increment = null)
    {
        $this->type = $type;
        $this->value = $value;
        $this->count = $count;
        $this->increment = $increment;
    }

    /**
     * Create an Every cron type
     *
     * @return static
     */
    public static function every(): static
    {
        return new static(self::TYPES[0]);
    }

    /**
     * Create an Increment cron type 
     *
     * @param int $increment The increment
     * @param int $count The count
     *
     * @return static
     */
    public static function increment(int $increment, int $count = 1): static
    {
        return new static(self::TYPES[1], null, $count, $increment);
    }

    /**
     * Create a Multiple cron type
     * 
     * @param int $count The multiple count
     *
     * @return static
     */
    public static function multiple(int $count): static
    {
        return new static(self::TYPES[2], null, $count);
    }

    /**
     * Create an Once cron type
     *
     * @param int $value The once value
     *
     * @return static
     */
    public static function once(int $value): static
    {
        return new static(self::TYPES[3], $value);
    }

    /**
     * Parse a cron expression
     *
     * @param string $expression The expression  
     *
     * @return static
     *
     * @throws CronParsingException
     */
    public static function parse(string $expression): static
    {
        // Parse "*".
        if ($expression === '*') {
            return static::every();
        }

        // Parse fixed values like "1".
        if (preg_match("/^\d+$/", $expression)) {
            return static::once((int)$expression);
        }

        // Parse multiple values like "1,2,5".
        if (preg_match("/^\d+(,\d+)+$/", $expression)) {
            return static::multiple(count(explode(',', $expression)));
        }

        // Parse ranges like "1-5".
        if (preg_match("/^(\d+)-(\d+)$/", $expression, $matches)) {
            $count = $matches[2] - $matches[1] + 1;
            return $count > 1 ? static::multiple($count) : static::once((int)$matches[1]);
        }

        // Parse increments like "*/2", "1-4/10". 
        if (preg_match("/(.+)\/(\d+)$/", $expression, $matches)) {
            $range = static::parse($matches[1]);
            if ($range->hasType(self::TYPES[0], self::TYPES[3])) {
                return static::increment($matches[2]);
            }
            if ($range->hasType(self::TYPES[2])) {
                return static::increment($matches[2], $range->count);
            }
        }

        // Invalid expression
        throw new CronParsingException($expression);
    }

    /**
     * Check if the type matches
     *
     * @return bool
     */
    public function hasType(): bool
    {
        return in_array($this->type, func_get_args(), true);
    }
}
