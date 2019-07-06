<?php

namespace Lorisleiva\CronTranslator;

class HoursField extends Field
{
    public $position = 1;

    public function translateEvery($fields)
    {
        $minute = $fields[0];

        if ($minute->hasType('Once')) {
            return 'once an hour';
        }

        return 'every hour';
    }

    public function translateIncrement($fields)
    {
        $minute = $fields[0];

        if ($minute->hasType('Once')) {
            return $this->times($this->count) . " every {$this->increment} hours";
        }

        if ($this->count > 1) {
            return "{$this->count} hours out of {$this->increment}";
        }

        if ($minute->hasType('Every')) {
            return "of every {$this->increment} hours";
        }

        return "every {$this->increment} hours";
    }
    
    public function translateMultiple($fields)
    {
        $minute = $fields[0];

        if ($minute->hasType('Once')) {
            return $this->times($this->count) . " a day";
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
