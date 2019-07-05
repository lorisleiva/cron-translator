<?php

namespace Lorisleiva\CronTranslator;

class MinutesField extends Field
{
    public $position = 0;

    public function translateEvery()
    {
        return 'every minute';
    }

    public function translateIncrement()
    {
        return 'TODO';
    }

    public function translateMultiple()
    {
        return $this->count === 2 ? "twice an hour" : "{$this->count} times an hour";
    }

    public function format()
    {   
        return ($this->value < 10 ? '0' : '') . $this->value;
    }
}
