<?php

namespace App\Repos;

use App\Models\UnavailableRoom;
use App\Models\CustomRate;
use App\Models\Room;
use App\Helpers\DateHelper;
use DateTime;
use DateInterval;
use DatePeriod;
use Log;

class InventoryRepo {

    public function __construct(UnavailableRoom $unavailableRoom, Room $room, CustomRate $rate, DateHelper $date)
    {
        $this->unavailableRoom = $unavailableRoom;
        $this->rate = $rate;
        $this->room = $room;
        $this->date = $date;
    }

    /**
     * Update multiple days of inventory at once
     * 
     * @param $data array
     * @return null
     */
    public function multidayUpdate(array $data)
    {
        $dates = $this->date->getDatesWithinRange($data['from'], $data['to']);
        $rooms = $this->room->where('room_type_id', $data['room_type'])->get();
        $daysOfTheWeekToUpdate = $data['days'];
        $datesToUpdate = [];

        foreach ($dates as $date) {
            $dayOfTheWeek = $this->date->getDayOfWeek($date->getTimestamp());

            if (in_array($dayOfTheWeek, $daysOfTheWeekToUpdate)) {
                $datesToUpdate[] = $date->format('Y-m-d');
            }
        }

        Log::info($datesToUpdate);

        // if they wanted to update the availability of rooms, first delete all rooms in the date range
        if ($data['available'] !== null) {
            $this->unavailableRoom
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->where('rooms.room_type_id', '=', $data['room_type'])
                ->whereIn('date', $datesToUpdate)
                ->delete();
        }

        // if they chose to add unavailability to rooms, we add those here
        // if they set available equal to 1, we have already handled that in the deletion above by removing them
        // from the unavailable table, hence making them available again

        Log::info($data['available']);

        if ($data['available'] === '0') {
            $unavailableRooms = [];

            foreach ($datesToUpdate as $date) {
                foreach ($rooms as $room) {
                    $unavailableRooms[] = [
                        'room_id' => $room->id,
                        'date' => $date,
                        'created_at' => new Datetime,
                        'updated_at' => new Datetime,
                    ];
                }
            }

            Log::info($unavailableRooms);

            $this->unavailableRoom->insert($unavailableRooms);
        }

        if ($data['rate'] !== null) {
            // first delete the old rates
            $this->rate
                ->join('rooms', 'room_id', '=', 'rooms.id')
                ->where('rooms.room_type_id', '=', $data['room_type'])
                ->whereIn('date', $datesToUpdate)
                ->delete();

            $newRates = [];

            foreach ($datesToUpdate as $date) {
                foreach ($rooms as $room) {
                    $newRates[] = [
                        'room_id' => $room->id,
                        'date' => $date,
                        'rate' => $data['rate'],
                        'created_at' => new Datetime,
                        'updated_at' => new Datetime,
                    ];
                }
            }

            $this->rate->insert($newRates);
        }
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
        $dates = $this->date->getDatesWithinRange('-6 months', '+6 months');
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
}
