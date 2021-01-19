<?php

namespace Lorisleiva\CronTranslator;

class DaysOfWeekField extends Field
{
    public $position = 4;

    public function translateEvery()
    {
        return $this->lang('years.every');
    }

    public function translateIncrement()
    {
        if ($this->getCount() > 1) {
            return $this->lang('days_of_week.multiple_days_out_of_few', [
                'count' => $this->getCount(),
                'increment' => $this->getIncrement(),
            ]);
        }

        return $this->lang('days_of_week.every_few_days_of_the_week', [
            'increment' => $this->getIncrement(),
        ]);
    }

    public function translateMultiple()
    {
        return $this->lang('days_of_week.multiple_days_a_week', [
            'count' => $this->getCount(),
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
        if ($this->getValue() < 0 || $this->getValue() > 7) {
            throw new CronParsingException($this->expression->raw);
        }

        return $this->langCountable('days', $this->getValue());
    }
}
