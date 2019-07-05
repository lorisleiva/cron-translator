<?php

namespace Lorisleiva\CronTranslator;

class DaysOfMonthField extends Field
{
    public function translateEvery()
    {
        return 'every day';
    }

    public function translateIncrement()
    {
        return 'TODO';
    }
    
    public function translateMultiple()
    {
        return 'TODO';
    }
    
    public function translateOnce($fields)
    {
        $month = $fields[3];
        
        if ($month->hasType('Every') && ! $month->dropped) {
            return;
        }

        if ($month->hasType('Every') && $month->dropped) {
            return 'on the ' . $this->format() . ' of every month';
        }

        return 'on the ' . $this->format();
    }

    public function format()
    {
        if (in_array($this->value, [1, 21, 31])) {
            return $this->value . 'st';
        }

        if (in_array($this->value, [2, 22])) {
            return $this->value . 'nd';
        }

        return $this->value . 'th';
    }
}
