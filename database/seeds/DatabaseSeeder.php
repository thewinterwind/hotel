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
        $this->call(RoomsTableSeeder::class);
        $this->call(RoomTypesTableSeeder::class);
        $this->call(UnavailableRoomTableSeeder::class);
        $this->call(RateOverridesTableSeeder::class);
    }
}
