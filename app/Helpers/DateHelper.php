<?php

namespace App\Helpers;

use DatePeriod;
use DateInterval;
use DateTime;

class DateHelper {

    /**
     * Return an array of date times between two specified times
     * You can pass any kind of strings in that are accepted by the DateTime constructor
     * DatePeriod will not include the last day passed by default so we will force it to
     *
     * @param $from string
     * @param $to string
     * @return DatePeriod
     */
    public function getDatesWithinRange(string $from, string $to)
    {
        return new DatePeriod(
            new DateTime($from),
            new DateInterval('P1D'),
            (new DateTime($to))->modify('+1 day')
        );
    }

    /**
     * Returns the day of the week from a timestamp: 0 (for Sunday) through 6 (for Saturday)
     *
     * @param $timestamp int
     * @return int
     */
    public function getDayOfWeek(int $timestamp)
    {
        return date('w', $timestamp);
    }
}