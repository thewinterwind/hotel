<?php

namespace App\Models;

use Eloquent;

class Payment extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * A payment has a payment method
     */
    public function payment()
    {
        return $this->hasOne('App\Models\PaymentMethod');
    }
}
