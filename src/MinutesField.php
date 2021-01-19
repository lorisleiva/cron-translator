<?php

namespace Lorisleiva\CronTranslator;

class MinutesField extends Field
{
    public $position = 0;

    public function translateEvery()
    {
        return $this->lang('minutes.every');
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return $this->lang('minutes.times_per_increment', [
                'times' => $this->langCountable('times', $this->count),
                'increment' => $this->increment,
            ]);
        }

        return $this->lang('minutes.increment', [
            'increment' => $this->increment
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('minutes.multiple', [
            'times' => $this->times($this->count)
        ]);
    }

    public function format()
    {
        return ($this->value < 10 ? '0' : '') . $this->value;
    }
}
