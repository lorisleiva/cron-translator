<?php

namespace Lorisleiva\CronTranslator;

class MonthsField extends Field
{
    public $position = 3;

    public function translateEvery($fields)
    {
        $day = $fields[2];

        if ($day->hasType('Once')) {
            return 'the ' . $day->format() . ' of every month';
        }

        return 'every month';
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return "{$this->count} months out of {$this->increment}";
        }

        return "every {$this->increment} months";
    }
    
    public function translateMultiple()
    {
        return "{$this->count} months a year";
    }
    
    public function translateOnce($fields)
    {
        $day = $fields[2];

        if ($day->hasType('Once')) {
            return "on {$this->format()} the {$day->format()}";
        }

        return "on {$this->format()}";
    }

    public function format()
    {
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ][$this->value];
    }
}
