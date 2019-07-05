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

    public function __construct($expression)
    {
        $this->expression = $expression;
        $cronType = CronType::parse($expression);
        $this->type = $cronType->type;
        $this->value = $cronType->value;
        $this->count = $cronType->count;
        $this->increment = $cronType->increment;
    }

    public function translate($fields, $prev, $next)
    {
        if ($this->hasType('Every') && method_exists($this, 'translateEvery')) {
            return $this->translateEvery($fields, $prev, $next);
        }
        if ($this->hasType('Increment') && method_exists($this, 'translateIncrement')) {
            return $this->translateIncrement($fields, $prev, $next);
        }
        if ($this->hasType('Multiple') && method_exists($this, 'translateMultiple')) {
            return $this->translateMultiple($fields, $prev, $next);
        }
        if ($this->hasType('Once') && method_exists($this, 'translateOnce')) {
            return $this->translateOnce($fields, $prev, $next);
        }
    }

    public function hasType()
    {
        return in_array($this->type, func_get_args());
    }
}
