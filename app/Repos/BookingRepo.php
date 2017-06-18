<?php

namespace App\Repos;

use App\Models\Booking;

class BookingRepo {

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get bookings
     * 
     * @return mixed
     */
    public function get($formatForCalender = false)
    {
        $bookings = $this->booking->all();

        if ($formatForCalender) {
            foreach ($bookings as $booking) {
                $formatted[] = [
                    'id' => $booking->id,
                    'name' => $booking->room->room_number . ' (' . $booking->rate . config('app.currency') . ')',
                    'startdate' => $booking->start_date->format('Y-m-d'),
                    // checkout date is on the following day but it doesn't add a day to the booking, subtract one day
                    'enddate' => $booking->checkout_date->subDay()->format('Y-m-d'),
                    'starttime' => $booking->room->hotel->check_in_time,
                    'endtime' => $booking->room->hotel->check_out_time,
                    'color' => $booking->room->calendar_color,
                ];

            }

            return $formatted;
        }

        return $bookings;
    }
}