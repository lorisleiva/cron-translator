<?php

namespace Lorisleiva\CronTranslator;

class MinutesField extends Field
{
    public $position = 0;

    public function translateEvery()
    {
        return $this->lang('minutes.every_minute');
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return $this->lang('minutes.multiple_times_every_few_minutes', [
                'times' => $this->times($this->count),
                'increment' => $this->increment,
            ]);
        }

        return $this->lang('minutes.every_few_minutes', [
            'increment' => $this->increment
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('minutes.multiple_times_an_hour', [
            'times' => $this->times($this->count)
        ]);
    }

    public function format()
    {
        return ($this->value < 10 ? '0' : '') . $this->value;
    }
}
