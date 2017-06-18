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
                'description' => 'A lovely room with a twin bed',
            ],
            [
                'id' => 2,
                'name' => 'Double Room',
                'sqm' => 150,
                'description' => 'A fantastic room with a queen size bed',
            ],
            [
                'id' => 3,
                'name' => 'Deluxe Room',
                'sqm' => 200,
                'description' => 'A large room with very soft towels',
            ],
            [
                'id' => 4,
                'name' => 'VIP Room',
                'sqm' => 250,
                'description' => 'A huge room with every amenity',
            ]
        ];

        foreach ($roomTypes as $type) {
            RoomType::create($type);
        }
    }
}
