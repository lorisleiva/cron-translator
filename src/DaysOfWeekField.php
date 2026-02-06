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
    public function translateMultiple(): ?string
    {
        if ($this->expression->day->hasType('Every') && !$this->expression->day->dropped && $this->isDiscreteList()) {
            return null; // DaysOfMonthField adapts to "Every Monday and Friday".
        }

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

    public function isDiscreteList(): bool
    {
        return $this->hasType('Multiple') && preg_match('/^\d+(,\d+)+$/', $this->rawField);
    }

    public function getFormattedDiscreteList(): string
    {
        $days = explode(',', $this->rawField);
        $dayNames = [];

        foreach ($days as $day) {
            $dayValue = (int)$day;
            $weekday = $dayValue === 0 ? 7 : $dayValue;

            if ($weekday >= 1 && $weekday <= 7) {
                $dayNames[] = $this->langCountable('days', $weekday);
            }
        }

        if (count($dayNames) > 1) {
            $lastDay = array_pop($dayNames);
            return implode(', ', $dayNames) . ' ' . $this->lang('connector.and') . ' ' . $lastDay;
        }

        return $dayNames[0] ?? '';
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
