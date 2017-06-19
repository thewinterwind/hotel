<?php

namespace App\Helpers;

use DatePeriod;
use DateInterval;
use DateTime;

class RequestHelper {

    /**
     * Return a unique array of days of the week (0-6) from a multi-select checkbox
     *
     * @param $dayInput array
     * @return array
     */
    public function getUniqueDaysOfWeek(array $dayInput)
    {
        $daysOfTheWeek = [];

        // get the days of the week within the range that will be affected
        foreach ($dayInput as $range) {
            $days = explode(',', $range);

            foreach ($days as $day) {
                if (is_numeric($day) && !in_array($day, $daysOfTheWeek)) {
                    $daysOfTheWeek[] = $day;
                }
            }
        }

        return $daysOfTheWeek;
    }
}