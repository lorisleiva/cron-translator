<?php

namespace Lorisleiva\CronTranslator;

/**
 * Days of week field translation class
 */
class DaysOfWeekField extends Field
{

    /**
     * Field position
     *
     * @var int
     */
    public int $position = 4;

    /**
     * Translate every expression
     *
     * @return string
     */
    public function translateEvery(): string
    {
        return $this->lang('years.every');
    }

    /**
     * Translate increment expression
     *  
     * @return string
     */
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

    /**
     * Translate multiple expression
     *
     * @return string
     */
    public function translateMultiple(): string
    {
        return $this->lang('days_of_week.multiple_days_a_week', [
            'count' => $this->getCount(),
        ]);
    }

    /**
     * Translate once expression
     *
     * @return string|null
     * @throws CronParsingException
     */
    public function translateOnce(): ?string
    {
        if ($this->expression->day->hasType('Every') && !$this->expression->day->dropped) {
            return null; // DaysOfMonthField adapts to "Every Sunday".
        }

        return $this->lang('days_of_week.once_on_day', [
            'day' => $this->format('dative')
        ]);
    }

    /**
     * Format day of week
     * 
     * @param string $case
     * @return string
     * @throws CronParsingException
     */
    public function format(string $case = 'nominative'): string
    {
        $weekday = $this->getValue() === 0 ? 7 : $this->getValue();

        if ($weekday < 1 || $weekday > 7) {
            throw new CronParsingException($this->expression->raw);
        }

        return $this->langCountable('days', $weekday, $case);
    }
}
