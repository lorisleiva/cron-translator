<?php

namespace Lorisleiva\CronTranslator;

class DaysOfWeekField extends Field
{
    public $position = 4;

    public function translateEvery()
    {
        return $this->lang('days_of_week.every');
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return $this->lang('days_of_week.multiple_days_out_of_few', [
                'count' => $this->count,
                'increment' => $this->increment
            ]);
        }

        return $this->lang('days_of_week.every_few_days_of_the_week', [
            'increment' => $this->increment
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('days_of_week.multiple_days_a_week', [
            'count' => $this->count
        ]);
    }

    public function translateOnce($fields)
    {
        if ($fields->day->hasType('Every') && ! $fields->day->dropped) {
            return; // DaysOfMonthField adapts to "Every Sunday".
        }

        return $this->lang('days_of_week.once_on_day', [
            'day' => $this->format()
        ]);
    }

    public function format()
    {
        if ($this->value < 0 || $this->value > 7) {
            throw new \Exception();
        }

        return $this->days[$this->value];
    }
}
