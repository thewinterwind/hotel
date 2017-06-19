<?php

use Illuminate\Database\Seeder;
use App\Models\CustomRate;

class CustomRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomRate::create([
            'id' => 1,
            'room_id' => 8,
            'rate' => 350,
            'date' => '2017-06-01',
        ]);

        CustomRate::create([
            'id' => 2,
            'room_id' => 8,
            'rate' => 350,
            'date' => '2017-06-02',
        ]);
    }
}
