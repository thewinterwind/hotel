<?php

use Illuminate\Database\Seeder;
use App\Models\RateOverride;

class RateOverridesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RateOverride::create([
            'id' => 1,
            'room_id' => 203,
            'rate' => 350,
            'date' => '2017-06-01',
        ]);

        RateOverride::create([
            'id' => 2,
            'room_id' => 203,
            'rate' => 350,
            'date' => '2017-06-02',
        ]);
    }
}
