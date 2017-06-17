<?php

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class BookingTableSeeder extends Seeder
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
            ],
            [
                'id' => 2,
                'name' => 'Hotel California',
            ]
        ];

        Hotel::insert($hotels);
    }
}
