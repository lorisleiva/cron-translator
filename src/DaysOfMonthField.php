<?php

namespace Lorisleiva\CronTranslator;

class DaysOfMonthField extends Field
{
    public $position = 2;

    public function translateEvery()
    {
        if ($this->expression->weekday->hasType('Once')) {
            return $this->lang('days_of_week.every', [
                'weekday' => $this->expression->weekday->format()
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

    public function translateOnce()
    {
        $month = $this->expression->month;

        if ($month->hasType('Once')) {
            return; // MonthsField adapts to "On January the 1st".
        }

        if ($month->hasType('Every') && ! $month->dropped) {
            return; // MonthsField adapts to "The 1st of every month".
        }

        if ($month->hasType('Every') && $month->dropped) {
            return $this->lang('days_of_month.every_on_day', [
                'day' => $this->format()
            ]);
        }

        return $this->lang('days_of_month.once_on_day', [
            'day' => $this->format()
        ]);
    }

    public function format()
    {
        return $this->langCountable('ordinals', $this->value);
    }
}
