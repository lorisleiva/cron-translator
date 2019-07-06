<?php

namespace Lorisleiva\CronTranslator;

class HoursField extends Field
{
    public $position = 1;

    public function translateEvery($fields)
    {
        if ($fields->minute->hasType('Once')) {
            return 'once an hour';
        }

        return 'every hour';
    }

    public function translateIncrement($fields)
    {
        if ($fields->minute->hasType('Once')) {
            return $this->times($this->count) . " every {$this->increment} hours";
        }

        if ($this->count > 1) {
            return "{$this->count} hours out of {$this->increment}";
        }

        if ($fields->minute->hasType('Every')) {
            return "of every {$this->increment} hours";
        }

        return "every {$this->increment} hours";
    }
    
    public function translateMultiple($fields)
    {
        if ($fields->minute->hasType('Once')) {
            return $this->times($this->count) . " a day";
        }

        return "{$this->count} hours a day";
    }
    
    public function translateOnce($fields)
    {
        return 'at ' . $this->format(
            $fields->minute->hasType('Once') ? $fields->minute : null
        );
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
