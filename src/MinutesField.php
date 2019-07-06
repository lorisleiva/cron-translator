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
        if ($this->count > 1) {
            return $this->times($this->count) . " every {$this->increment} minutes";
        }

        return "every {$this->increment} minutes";
    }

    public function translateMultiple()
    {
        return $this->times($this->count) . " an hour";
    }

    public function format()
    {   
        return ($this->value < 10 ? '0' : '') . $this->value;
    }
}
