<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookingTableSeeder::class);
        $this->call(HotelTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(PersonalIdTypesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(RoomTypesTableSeeder::class);
    }
}
