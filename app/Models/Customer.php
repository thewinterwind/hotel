<?php

namespace App\Models;

use Eloquent;

class Customer extends Eloquent
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
     * A customer can make many bookings
     */
    public function payment()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
