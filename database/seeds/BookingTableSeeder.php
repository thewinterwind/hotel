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
                'customer_id' => null,
                'start_date' => '2017-06-10',
                'checkout_date' => '2017-06-12',
                'price' => 200,
            ],
            [
                'id' => 2,
                'room_id' => 1,
                'customer_id' => 1,
                'start_date' => '2017-06-12',
                'checkout_date' => '2017-06-14',
                'price' => 250,
            ],
            [
                'id' => 3,
                'room_id' => 2,
                'customer_id' => 2,
                'start_date' => '2017-06-20',
                'checkout_date' => '2017-06-21',
                'price' => 200,
            ],
            [
                'id' => 4,
                'room_id' => 2,
                'customer_id' => 3,
                'start_date' => '2017-06-21',
                'checkout_date' => '2017-06-22',
                'price' => 200,
            ],
            [
                'id' => 5,
                'room_id' => 3,
                'customer_id' => 4,
                'start_date' => '2017-06-22',
                'checkout_date' => '2017-06-24',
                'price' => 250,
            ],
            [
                'id' => 6,
                'room_id' => 3,
                'customer_id' => 6,
                'start_date' => '2017-06-24',
                'checkout_date' => '2017-06-26',
                'price' => 250,
            ],
            [
                'id' => 7,
                'room_id' => 4,
                'customer_id' => 5,
                'start_date' => '2017-06-14',
                'checkout_date' => '2017-06-17',
                'price' => 300,
            ]
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
