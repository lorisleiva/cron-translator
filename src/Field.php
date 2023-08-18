<?php

namespace Lorisleiva\CronTranslator;

/**
 * Abstract cron field translation class
 */
abstract class Field
{

    /**
     * The field cron type
     * 
     * @var CronType
     */
    public CronType $type;

    /**
     * Whether field was dropped
     * 
     * @var bool 
     */
    public bool $dropped = false;

    /**
     * The field position
     *
     * @var int
     */
    public int $position;

    /**
     * Constructor
     *
     * @param CronExpression $expression The cron expression
     * @param string $rawField The raw field value
     *
     * @throws CronParsingException
     */
    public function __construct(
        protected CronExpression $expression,
        protected string $rawField
    ) {
        $this->type = CronType::parse($rawField);
    }

    /**
     * Translate the field
     *
     * @return string|null
     */
    public function translate(): ?string
    {
        $method = 'translate' . $this->type->type;

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return null;
    }

    /**
     * Check if field type matches
     *
     * @return bool
     */
    public function hasType(): bool
    {
        return $this->type->hasType(...func_get_args());
    }

    /**
     * Get field value
     *
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->type->value;
    }

    /**
     * Get field count
     *
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->type->count;
    }

    /**
     * Get field increment
     *
     * @return int|null 
     */
    public function getIncrement(): ?int
    {
        return $this->type->increment;
    }

    /**
     * Get localized times
     *
     * @return array|string
     */
    public function getTimes(): array|string
    {
        return $this->langCountable('times', $this->getCount());
    }

    /**
     * Get localized countable translation
     *
     * @param string $key
     * @param int $value
     * @param string $case
     * @return array|string
     */
    protected function langCountable(string $key, int $value, string $case = 'nominative'): array|string
    {
        return $this->expression->langCountable($key, $value, $case);
    }

    /**
     * Get localized translation
     *
     * @param string $key
     * @param array $replacements
     * @return string
     */
    protected function lang(string $key, array $replacements = []): string
    {
        return $this->expression->lang($key, $replacements);
    }
}
