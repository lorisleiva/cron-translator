<?php

namespace Lorisleiva\CronTranslator;

class DaysOfWeekField extends Field
{
    public int $position = 4;

    public function translateEvery(): string
    {
        return $this->lang('years.every');
    }

    public function translateIncrement(): string
    {
        if ($this->getCount() > 1) {
            return $this->lang('days_of_week.multiple_per_increment', [
                'count' => $this->getCount(),
                'increment' => $this->getIncrement(),
            ]);
        }

        return $this->lang('days_of_week.increment', [
            'increment' => $this->getIncrement(),
        ]);
    }

    public function translateMultiple(): string
    {
        return $this->lang('days_of_week.multiple_days_a_week', [
            'count' => $this->getCount(),
        ]);
    }

    /**
     * @throws CronParsingException
     */
    public function translateOnce(): ?string
    {
        if ($this->expression->day->hasType('Every') && ! $this->expression->day->dropped) {
            return null; // DaysOfMonthField adapts to "Every Sunday".
        }

        return $this->lang('days_of_week.once_on_day', [
            'day' => $this->format()
        ]);
    }

    /**
     * @throws CronParsingException
     */
    public function format(): string
    {
        $weekday = $this->getValue() === 0 ? 7 : $this->getValue();

        if ($weekday < 1 || $weekday > 7) {
            throw new CronParsingException($this->expression->raw);
        }

        return $this->langCountable('days', $weekday);
    }
}
