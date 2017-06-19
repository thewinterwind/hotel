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
                'sqm' => 100,
                'rate' => 200, // in baht
                'description' => 'A lovely room with a twin bed',
            ],
            [
                'id' => 2,
                'name' => 'Double Room',
                'sqm' => 150,
                'rate' => 400,
                'description' => 'A fantastic room with a queen size bed',
            ]
        ];

        foreach ($roomTypes as $type) {
            RoomType::create($type);
        }
    }
}
