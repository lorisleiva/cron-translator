<?php

namespace Lorisleiva\CronTranslator;

/**
 * Minutes field translation class
 */
class MinutesField extends Field
{

    /**
     * Field position
     *
     * @var int
     */
    public int $position = 0;

    /**
     * Translate every expression
     *
     * @return string
     */
    public function translateEvery(): string
    {
        return $this->lang('minutes.every');
    }

    /**
     * Translate increment expression
     *
     * @return string
     */
    public function translateIncrement(): string
    {
        if ($this->getCount() > 1) {
            return $this->lang('minutes.times_per_increment', [
                'times' => $this->getTimes(),
                'increment' => $this->getIncrement()
            ]);
        }

        return $this->lang('minutes.increment', [
            'increment' => $this->getIncrement()
        ]);
    }

    /**
     * Translate multiple expression
     *
     * @return string
     */
    public function translateMultiple(): string
    {
        return $this->lang('minutes.multiple', [
            'times' => $this->getTimes()
        ]);
    }

    /**
     * Format minute
     *
     * @return string
     */
    public function format(): string
    {
        return ($this->getValue() < 10 ? '0' : '') . $this->getValue();
    }
}
