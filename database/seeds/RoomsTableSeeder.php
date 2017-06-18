<?php

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'id' => 1,
                'hotel_id' => 1,
                'room_number' => '101',
                'room_type_id' => 1,
                'direction' => 'E',
                'sqm' => '100',
                'smoking' => true,
                'calendar_color' => '#A52A2A',
            ],
            [
                'id' => 2,
                'hotel_id' => 1,
                'room_number' => '102',
                'room_type_id' => 2,
                'direction' => 'S',
                'sqm' => '150',
                'smoking' => false,
                'calendar_color' => '#8A2BE2',
            ],
            [
                'id' => 3,
                'hotel_id' => 1,
                'room_number' => '201',
                'room_type_id' => 3,
                'direction' => 'S',
                'sqm' => '200',
                'smoking' => false,
                'calendar_color' => '#6495ED',
            ],
            [
                'id' => 4,
                'hotel_id' => 1,
                'room_number' => '301',
                'room_type_id' => 4,
                'direction' => 'S',
                'sqm' => '250',
                'smoking' => false,
                'calendar_color' => '#006400',
            ]
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
