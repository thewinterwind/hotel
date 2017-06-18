<?php

namespace App\Models;

use Eloquent;

class Booking extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'checkout_date'];

    /**
     * A booking belongs to a room
     */
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    /**
     * A booking has one payment
     */
    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
}
