<?php

namespace Lorisleiva\CronTranslator;

class DaysOfMonthField extends Field
{
    public $position = 2;

    public function translateEvery($fields)
    {
        if ($fields->weekday->hasType('Once')) {
            return "every {$fields->weekday->format()}";
        }

        return 'every day';
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return "{$this->count} days out of {$this->increment}";
        }

        return "every {$this->increment} days";
    }
    
    public function translateMultiple()
    {
        return "{$this->count} days a month";
    }
    
    public function translateOnce($fields)
    {
        if ($fields->month->hasType('Once')) {
            return; // MonthsField adapts to "On January the 1st".
        }
        
        if ($fields->month->hasType('Every') && ! $fields->month->dropped) {
            return; // MonthsField adapts to "The 1st of every month".
        }

        if ($fields->month->hasType('Every') && $fields->month->dropped) {
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

        if (in_array($this->value, [3, 23])) {
            return $this->value . 'rd';
        }

        return $this->value . 'th';
    }
}
