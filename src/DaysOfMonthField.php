<?php

namespace Lorisleiva\CronTranslator;

class DaysOfMonthField extends Field
{
    public $position = 2;

    public function translateEvery()
    {
        if ($this->expression->weekday->hasType('Once')) {
            return $this->lang('days_of_week.every', [
                'weekday' => $this->expression->weekday->format(),
            ]);
        }

        return $this->lang('days_of_month.every');
    }

    public function translateIncrement()
    {
        if ($this->getCount() > 1) {
            return $this->lang('days_of_month.multiple_per_increment', [
                'count' => $this->getCount(),
                'increment' => $this->getIncrement(),
            ]);
        }

        return $this->lang('days_of_month.increment', [
            'increment' => $this->getIncrement(),
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('days_of_month.multiple_per_month', [
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
        return $this->langCountable('ordinals', $this->getValue());
    }
}
