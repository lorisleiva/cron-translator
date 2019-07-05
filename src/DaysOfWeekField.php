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
        return 'TODO';
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
