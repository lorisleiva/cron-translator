<?php

namespace Lorisleiva\CronTranslator;

abstract class Field
{
    public CronType $type;
    public bool $dropped = false;
    public int $position;

    /**
     * @throws CronParsingException
     */
    public function __construct(public CronExpression $expression, public string $rawField)
    {
        $this->type = CronType::parse($rawField);
    }

    public function translate(): ?string
    {
        $method = 'translate' . $this->type->type;

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        return null;
    }

    public function hasType(): bool
    {
        return $this->type->hasType(...func_get_args());
    }

    public function getValue(): ?int
    {
        return $this->type->value;
    }

    public function getCount(): ?int
    {
        return $this->type->count;
    }

    public function getIncrement(): ?int
    {
        return $this->type->increment;
    }

    public function getTimes(): array|string
    {
        return $this->langCountable('times', $this->getCount());
    }

    protected function langCountable(string $key, int $value): array|string
    {
        return $this->expression->langCountable($key, $value);
    }

    protected function lang(string $key, array $replacements = []): string
    {
        return $this->expression->lang($key, $replacements);
    }
}
