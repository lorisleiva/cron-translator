<?php

namespace Lorisleiva\CronTranslator;

abstract class Field
{
    public $expression;
    public $type;
    public $value;
    public $count;
    public $increment;
    public $dropped = false;
    public $position;

    public function __construct($expression)
    {
        $this->expression = $expression;
        $cronType = CronType::parse($expression);
        $this->type = $cronType->type;
        $this->value = $cronType->value;
        $this->count = $cronType->count;
        $this->increment = $cronType->increment;
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
            case 1: return 'once';
            case 2: return 'twice';
            default: return "{$count} times";
        }
    }
}
