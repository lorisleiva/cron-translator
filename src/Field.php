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

    public function translate()
    {
        $method = 'translate' . $this->type->type;

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
    }

    public function hasType()
    {
        return in_array($this->type, func_get_args());
    }

    protected function langCountable(string $key, int $value)
    {
        return $this->expression->langCountable($key, $value);
    }

    protected function lang(string $key, array $replacements = [])
    {
        return $this->expression->lang($key, $replacements);
    }
}
