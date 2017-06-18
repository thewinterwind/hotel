<?php

use Illuminate\Database\Seeder;
use App\Models\PersonalIdType;

class PersonalIdTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personalIdTypes = [
            [
                'id' => 1,
                'name' => 'passport',
            ],
            [
                'id' => 2,
                'name' => 'dl', // driver's license
            ]
        ];

        foreach ($personalIdTypes as $type) {
            PersonalIdType::create($type);
        }
    }
}
