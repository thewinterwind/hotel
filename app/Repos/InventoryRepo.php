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
     * Get the rate/availability information for a single room on a specific date
     * 
     * @param $date string
     * @param $roomId integer
     * @return array
     */
    public function find(string $date, int $roomId)
    {
        $available = !$this->unavailableRoom->where([
            'room_id' => $roomId,
            'date' => $date,
        ])->exists();

        $customRate = $this->rate->where([
            'room_id' => $roomId,
            'date' => $date,
        ])->first();

        $room = $this->room->join('room_types', 'room_type_id', '=', 'room_types.id')
                ->where('rooms.id', $roomId)
                ->first();

        if ($customRate) {
            $rate = $customRate->rate;
        } else {
            $rate = $room->rate;
        }

        return [
            'room_id' => $roomId,
            'number' => $room->room_number,
            'date' => $date,
            'available' => $available,
            'rate' => $rate,
        ];
    }

    /**
     * Update room on a specific date
     * 
     * @param $roomId int
     * @param $rate int
     * @param $date string
     * @param $available bool
     * @return null
     */
    public function updateRoomOnSpecificDate(int $roomId, int $rate, string $date, bool $available)
    {
        $this->unavailableRoom->where([
            'date' => $date,
            'room_id' => $roomId,
        ])->delete();

        if (!$available) {
            $this->unavailableRoom->create([
                'date' => $date,
                'room_id' => $roomId,
            ]);
        }

        $this->rate->where([
            'date' => $date,
            'room_id' => $roomId,
        ])->delete();

        $room = $this->room->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->where('rooms.id', $roomId)
            ->first();

        // if the rate passed in is different than the default room rate, then add it as a custom rate
        if ($rate !== $room->rate) {
            $this->rate->create([
                'date' => $date,
                'room_id' => $roomId,
                'rate' => $rate,
            ]);
        }
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
        $today = date('Y-m-d');
        $sixMonthsAhead = (new DateTime('+6 months'))->format('Y-m-d');
        $dates = $this->date->getDatesWithinRange('now', '+6 months');
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
            ->where('date', '>=', $today)
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
            ->where('date', '>=', $today)
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
                    'id' => http_build_query(['date' => $date, 'room_id' => $room->id]),
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
