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
                'calendar_color' => '#ff0000',
            ],
            [
                'id' => 2,
                'hotel_id' => 1,
                'room_number' => '102',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#ff8000',
            ],
            [
                'id' => 3,
                'hotel_id' => 1,
                'room_number' => '103',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#00bfff',
            ],
            [
                'id' => 4,
                'hotel_id' => 1,
                'room_number' => '104',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#0040ff',
            ],
            [
                'id' => 5,
                'hotel_id' => 1,
                'room_number' => '105',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#8000ff',
            ],
            [
                'id' => 6,
                'hotel_id' => 1,
                'room_number' => '201',
                'room_type_id' => 2,
                'direction' => 'N',
                'sqm' => '200',
                'smoking' => true,
                'calendar_color' => '#bf00ff',
            ],
            [
                'id' => 7,
                'hotel_id' => 1,
                'room_number' => '202',
                'room_type_id' => 2,
                'direction' => 'S',
                'calendar_color' => '#ff0080',
            ],
            [
                'id' => 8,
                'hotel_id' => 1,
                'room_number' => '203',
                'room_type_id' => 2,
                'direction' => 'N',
                'calendar_color' => '#808080',
            ],
            [
                'id' => 9,
                'hotel_id' => 1,
                'room_number' => '204',
                'room_type_id' => 2,
                'direction' => 'S',
                'calendar_color' => '#1a0000',
            ],
            [
                'id' => 10,
                'hotel_id' => 1,
                'room_number' => '205',
                'room_type_id' => 2,
                'direction' => 'W',
                'calendar_color' => '#790000',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
