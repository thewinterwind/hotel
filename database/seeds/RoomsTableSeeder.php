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
                'calendar_color' => '#7D3C98',
            ],
            [
                'id' => 2,
                'hotel_id' => 1,
                'room_number' => '102',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#2471A3',
            ],
            [
                'id' => 3,
                'hotel_id' => 1,
                'room_number' => '103',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#2E86C1',
            ],
            [
                'id' => 4,
                'hotel_id' => 1,
                'room_number' => '104',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#17A589',
            ],
            [
                'id' => 5,
                'hotel_id' => 1,
                'room_number' => '105',
                'room_type_id' => 1,
                'direction' => 'S',
                'calendar_color' => '#138D75',
            ],
            [
                'id' => 6,
                'hotel_id' => 1,
                'room_number' => '201',
                'room_type_id' => 2,
                'direction' => 'N',
                'sqm' => '200',
                'smoking' => true,
                'calendar_color' => '#229954',
            ],
            [
                'id' => 7,
                'hotel_id' => 1,
                'room_number' => '202',
                'room_type_id' => 2,
                'direction' => 'S',
                'calendar_color' => '#D4AC0D',
            ],
            [
                'id' => 8,
                'hotel_id' => 1,
                'room_number' => '203',
                'room_type_id' => 2,
                'direction' => 'N',
                'calendar_color' => '#D68910',
            ],
            [
                'id' => 9,
                'hotel_id' => 1,
                'room_number' => '204',
                'room_type_id' => 2,
                'direction' => 'S',
                'calendar_color' => '#CA6F1E',
            ],
            [
                'id' => 10,
                'hotel_id' => 1,
                'room_number' => '205',
                'room_type_id' => 2,
                'direction' => 'W',
                'calendar_color' => '#BA4A00',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
