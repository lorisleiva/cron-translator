<?php

namespace Lorisleiva\CronTranslator;

/**
 * Days of month field translation class
 */
class DaysOfMonthField extends Field
{

    /**
     * Field position
     *
     * @var int
     */
    public int $position = 2;

    /**
     * Translate every expression
     *
     * @return string
     * @throws CronParsingException
     */
    public function translateEvery(): string
    {
        if ($this->expression->weekday->hasType('Once')) {
            return $this->lang('days_of_week.every', [
                'weekday' => $this->expression->weekday->format(),
            ]);
        }

        return $this->lang('days_of_month.every');
    }

    /**
     * Translate increment expression
     *
     * @return string
     */
    public function translateIncrement(): string
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

    /**
     * Translate multiple expression
     *
     * @return string
     */
    public function translateMultiple(): string
    {
        return $this->lang('days_of_month.multiple_per_month', [
            'count' => $this->getCount(),
        ]);
    }

    /**
     * Translate once expression
     *
     * @return string|null
     */
    public function translateOnce(): ?string
    {
        $month = $this->expression->month;

        if ($month->hasType('Once')) {
            return null; // MonthsField adapts to "On January the 1st".
        }

        if ($month->hasType('Every') && ! $month->dropped) {
            return null; // MonthsField adapts to "The 1st of every month".
        }

        if ($month->hasType('Every') && $month->dropped) {
            return $this->lang('days_of_month.every_on_day', [
                'day' => $this->format('dative'),
            ]);
        }

        return $this->lang('days_of_month.once_on_day', [
            'day' => $this->format(),
        ]);
    }

    /**
     * Format day of month
     *
     * @param string $case
     * @return string
     */
    public function format(string $case = 'nominative'): string
    {
        return $this->langCountable('ordinals', $this->getValue(), $case);
    }
}
