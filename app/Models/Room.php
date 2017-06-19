<?php

namespace App\Models;

use Eloquent;

class Room extends Eloquent
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
     * A room has a room type
     */
    public function roomTypes()
    {
        return $this->hasOne('App\Models\RoomType');
    }

    /**
     * A room has many bookings
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    /**
     * A room belongs to a hotel
     */
    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
