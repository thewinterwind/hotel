<?php

use Illuminate\Database\Seeder;
use App\Models\UnavailableRoom;

class UnavailableRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnavailableRoom::create([
            'id' => 1,
            'room_id' => 101,
            'date' => '2017-06-30',
        ]);
    }
}
