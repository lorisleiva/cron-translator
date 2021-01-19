<?php

namespace Lorisleiva\CronTranslator;

class HoursField extends Field
{
    public $position = 1;

    public function translateEvery()
    {
        if ($this->expression->minute->hasType('Once')) {
            return $this->lang('hours.once_an_hour');
        }

        return $this->lang('hours.every');
    }

    public function translateIncrement()
    {
        if ($this->expression->minute->hasType('Once')) {
            return $this->lang('hours.times_per_increment', [
                'times' => $this->getTimes(),
                'increment' => $this->getIncrement(),
            ]);
        }

        if ($this->getCount() > 1) {
            return $this->lang('hours.multiple_per_increment', [
                'count' => $this->getCount(),
                'increment' => $this->getIncrement(),
            ]);
        }

        if ($this->expression->minute->hasType('Every')) {
            return $this->lang('hours.increment_chained', [
                'increment' => $this->getIncrement(),
            ]);
        }

        return $this->lang('hours.increment', [
            'increment' => $this->getIncrement(),
        ]);
    }

    public function translateMultiple()
    {
        if ($this->expression->minute->hasType('Once')) {
            return $this->lang('hours.times_per_day', [
                'times' => $this->getTimes(),
            ]);
        }

        return $this->lang('hours.multiple_per_day', [
            'count' => $this->getCount(),
        ]);
    }

    public function translateOnce()
    {
        $minute = $this->expression->minute->hasType('Once')
            ? $this->expression->minute
            : null;

        return $this->lang('hours.once_at_time', [
            'time' => $this->format($minute)
        ]);
    }

    public function format(?MinutesField $minute = null)
    {
        $amOrPm = '';
        if (! $this->expression->timeFormat24hours) {
            $amOrPm = $this->getValue() < 12 ? 'am' : 'pm';
        }
        $hour = $this->getValue() === 0 ? 12 : $this->getValue();
        $hour = $hour > 12 ? $hour - 12 : $hour;

        if ($this->expression->timeFormat24hours) {
            return $minute
                ? date("H:i", strtotime("{$hour}:{$minute->format()} {$amOrPm}"))
                : date("H:i", strtotime("{$hour} {$amOrPm}"));
        }

        return $minute
            ? "{$hour}:{$minute->format()}{$amOrPm}"
            : "{$hour}{$amOrPm}";
    }
}
