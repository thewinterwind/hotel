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
                'name' => 'credit_card',
            ],
            [
                'id' => 2,
                'name' => 'cash',
            ]
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
