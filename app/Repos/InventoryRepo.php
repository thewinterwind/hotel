<?php

namespace App\Repos;

use App\Models\UnavailableRoom;
use App\Models\CustomRate;
use App\Models\Room;
use DateTime;
use DateInterval;
use DatePeriod;
use Log;

class InventoryRepo {

    public function __construct(UnavailableRoom $unavailableRoom, Room $room, CustomRate $rate)
    {
        $this->unavailableRoom = $unavailableRoom;
        $this->rate = $rate;
        $this->room = $room;
    }

    /**
     * Update multiple days of inventory at once
     * 
     * @return null
     */
    public function multidayUpdate(array $data)
    {
        Log::info($data);

        dd($data);
    }

    /**
     * Get inventory
     * 
     * @return mixed
     */
    public function get()
    {
        $sixMonthsAgo = (new DateTime('-6 months'))->format('Y-m-d');
        $sixMonthsAhead = (new DateTime('+6 months'))->format('Y-m-d');
        $dates = $this->getYearOfDates();
        $unavailableRoomsByDate = [];
        $customRates = [];
        $rooms = $this->room->select([
            'rooms.id', 
            'room_number', 
            'calendar_color',
            'rate'
        ])->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')->get();

        $results = $this->unavailableRoom
            ->select('room_id', 'date')
            ->where('date', '>=', $sixMonthsAgo)
            ->where('date', '<', $sixMonthsAhead)
            ->get();

        foreach ($results as $result) {
            if (!array_key_exists($result->date, $unavailableRoomsByDate)) {
                $unavailableRoomsByDate[$result->date] = [];
            }

            $unavailableRoomsByDate[$result->date][$result->room_id] = true; 
        }

        $results = $this->rate
            ->select('room_id', 'date', 'rate')
            ->where('date', '>=', $sixMonthsAgo)
            ->where('date', '<', $sixMonthsAhead)
            ->get();

        foreach ($results as $result) {
            if (!array_key_exists($result->date, $customRates)) {
                $customRates[$result->date] = [];
            }

            $customRates[$result->date][$result->room_id] = $result->rate; 
        }

        $formatted = [];

        foreach ($dates as $date) {
            $date = $date->format('Y-m-d');
            foreach ($rooms as $room) {
                // if the room is unavailable on a date then don't include it
                $notAvailable = $unavailableRoomsByDate[$date][$room->id] ?? false;

                if ($notAvailable) continue;

                // if a room has a has a rate set to override the default rate, then use that
                $rate = $customRates[$date][$room->id] ?? $room->rate;

                $formatted[] = [
                    'id' => $date . '_' . $room->id,
                    'name' => $room->room_number . ' (' . $rate . config('app.currency') . ')',
                    'startdate' => $date,
                    'enddate' => $date,
                    'starttime' => config('app.check_in_time'),
                    'endtime' => null,
                    'color' => $room->calendar_color,
                ];
            }
        }

        return $formatted;
    }

    /**
     * Get a year of dates going 6 months into the past and future
     * 
     * @return array
     */
    protected function getYearOfDates()
    {
        return new DatePeriod(
            new DateTime('-6 months'),
            new DateInterval('P1D'),
            new DateTime('+6 months')
        );
    }
}
