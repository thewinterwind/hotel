<?php

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [
            [
                'id' => 1,
                'name' => 'Ibiza Motel',
                'check_in_time' => '12:00',
                'check_out_time' => '11:00',
            ],
            [
                'id' => 2,
                'name' => 'Hotel California',
                'check_in_time' => '11:30',
                'check_out_time' => '10:30',
            ]
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
