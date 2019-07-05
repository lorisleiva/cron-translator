<?php

namespace Lorisleiva\CronTranslator;

class MonthsField extends Field
{
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
        return 'TODO';
    }
    
    public function translateMultiple()
    {
        return 'TODO';
    }
    
    public function translateOnce()
    {
        return 'TODO';
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
