<?php

namespace Lorisleiva\CronTranslator;

class HoursField extends Field
{
    public $position = 1;

    public function translateEvery()
    {
        return 'every hour';
    }

    public function translateIncrement()
    {
        return 'TODO';
    }
    
    public function translateMultiple($fields)
    {
        $minute = $fields[0];

        if ($minute->hasType('Once')) {
            return $this->count === 2 ? "twice a day" : "{$this->count} times a day";
        }

        return "{$this->count} hours a day";
    }
    
    public function translateOnce($fields)
    {
        $minute = $fields[0];
        $minute = $minute->hasType('Once') ? $minute : null;

        return 'at ' . $this->format($minute);
    }

    public function format($minute = null)
    {
        $amOrPm = $this->value < 12 ? 'am' : 'pm';
        $hour = $this->value === 0 ? 12 : $this->value;
        $hour = $hour > 12 ? $hour - 12 : $hour;

        return $minute 
            ? "{$hour}:{$minute->format()}{$amOrPm}" 
            : "{$hour}{$amOrPm}";
    }
}
