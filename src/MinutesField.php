<?php

namespace Lorisleiva\CronTranslator;

class MinutesField extends Field
{
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
        return 'TODO';
    }

    public function format()
    {   
        return ($this->value < 10 ? '0' : '') . $this->value;
    }
}
