<?php

namespace Lorisleiva\CronTranslator;

class MonthsField extends Field
{
    public $position = 3;

    public function translateEvery($fields)
    {
        if ($fields->day->hasType('Once')) {
            return $this->lang('months.every_once_on_day', [
                'day' => $fields->day->format()
            ]);
        }

        return $this->lang('months.every_month');
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return $this->lang('months.multiple_months_out_of_few', [
                'count' => $this->count,
                'increment' => $this->increment
            ]);
        }

        return $this->lang('months.every_few_months', [
            'increment' => $this->increment
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('months.multiple_months_a_year', [
            'count' => $this->count
        ]);
    }

    public function translateOnce($fields)
    {
        if ($fields->day->hasType('Once')) {
            return $this->lang('months.once_on_day_of_month', [
                'month' => $this->format(),
                'day' => $fields->day->format(),
            ]);
        }

        return $this->lang('months.once_on_month', [
            'month' => $this->format()
        ]);
    }

    public function format()
    {
        if ($this->value < 1 || $this->value > 12) {
            throw new \Exception();
        }

        return $this->months[$this->value];
    }
}
