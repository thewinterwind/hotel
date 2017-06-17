<?php

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomTypes = [
            [
                'id' => 1,
                'name' => 'Single Room',
                'description' => 'A lovely room with a twin bed',
            ],
            [
                'id' => 2,
                'name' => 'Double Room',
                'description' => 'A fantastic room with a queen size bed',
            ]
        ];

        RoomType::insert($roomTypes);
    }
}
