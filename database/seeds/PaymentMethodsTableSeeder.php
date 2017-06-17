<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            [
                'id' => 1,
                'method' => 'credit_card',
            ],
            [
                'id' => 2,
                'room_id' => 'cash',
            ]
        ];

        PaymentMethod::insert($paymentMethods);
    }
}
