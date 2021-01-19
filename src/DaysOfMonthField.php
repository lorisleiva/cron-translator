<?php

namespace Lorisleiva\CronTranslator;

class DaysOfMonthField extends Field
{
    public $position = 2;

    public function translateEvery($fields)
    {
        if ($fields->weekday->hasType('Once')) {
            return $this->lang('days_of_month.every_once_on_day', [
                'weekday' => $fields->weekday->format()
            ]);
        }

        return $this->lang('days_of_month.every');
    }

    public function translateIncrement()
    {
        if ($this->count > 1) {
            return $this->lang('days_of_month.multiple_days_ot_of_few', [
                'count' => $this->count,
                'increment' => $this->increment
            ]);
        }

        return $this->lang('days_of_month.every_few_days', [
            'increment' => $this->increment
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('days_of_month.multiple_days_a_month', [
            'count' => $this->count
        ]);
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
            return $this->lang('days_of_month.once_on_day_of_every', [
                'day' => $this->format()
            ]);
        }

        return $this->lang('days_of_month.once_on_day', [
            'day' => $this->format()
        ]);
    }

    public function format()
    {
        if (! $this->isEnglishLocale()) {
            return $this->value;
        }

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
