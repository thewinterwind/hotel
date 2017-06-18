<?php

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [
            [
                'id' => 1,
                'room_id' => 1,
                'date' => '2017-06-10',
                'rate' => 200,
            ],
            [
                'id' => 2,
                'room_id' => 2,
                'date' => '2017-06-12',
                'rate' => 250,
            ],
            [
                'id' => 3,
                'room_id' => 3,
                'date' => '2017-06-20',
                'rate' => 200,
            ],
            [
                'id' => 4,
                'room_id' => 4,
                'date' => '2017-06-21',
                'rate' => 200,
            ],
            [
                'id' => 5,
                'room_id' => 5,
                'date' => '2017-06-22',
                'rate' => 250,
            ],
            [
                'id' => 6,
                'room_id' => 6,
                'date' => '2017-06-24',
                'rate' => 250,
            ],
            [
                'id' => 7,
                'room_id' => 7,
                'date' => '2017-06-14',
                'rate' => 300,
            ],
            [
                'id' => 8,
                'room_id' => 8,
                'date' => '2017-06-01',
                'rate' => 300,
            ],
            [
                'id' => 9,
                'room_id' => 9,
                'date' => '2017-06-12',
                'rate' => 300,
            ],
            [
                'id' => 10,
                'room_id' => 10,
                'date' => '2017-06-14',
                'rate' => 300,
            ]
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
