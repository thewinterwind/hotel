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
                'start_date' => '2017-06-20',
                'checkout_date' => '2017-06-22',
                'price' => 200,
            ],
            [
                'id' => 2,
                'room_id' => 2,
                'customer_id' => 1,
                'start_date' => '2017-06-20',
                'checkout_date' => '2017-06-21',
                'price' => 250,
            ],
            [
                'id' => 3,
                'room_id' => 1,
                'customer_id' => 2,
                'start_date' => '2017-06-22',
                'checkout_date' => '2017-06-24',
                'price' => 200,
            ]
        ];

        Booking::insert($bookings);
    }
}
