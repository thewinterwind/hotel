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
                'facing' => 'E',
                'sqm' => '200',
                'smoking' => true,
            ],
            [
                'id' => 1,
                'hotel_id' => 1,
                'room_number' => '102',
                'room_type_id' => 2,
                'facing' => 'S',
                'sqm' => '150',
            ]
        ];

        Room::insert($rooms);
    }
}
