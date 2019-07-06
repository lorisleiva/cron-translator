<?php

namespace Lorisleiva\CronTranslator;

class DaysOfWeekField extends Field
{
    public $position = 4;

    public function translateEvery()
    {
        return 'every year';
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return "{$this->count} days of the week out of {$this->increment}";
        }

        return "every {$this->increment} days of the week";
    }
    
    public function translateMultiple()
    {
        return "{$this->count} days a week";
    }
    
    public function translateOnce($fields)
    {
        $day = $fields[2];

        if ($day->hasType('Every') && ! $day->dropped) {
            return;
        }

        return "on {$this->format()}s";
    }

    public function format()
    {
        return [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ][$this->value];
    }
}
