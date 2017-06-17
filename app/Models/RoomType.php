<?php

namespace App\Models;

use Eloquent;

class RoomType extends Eloquent
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
     * A roomType belongs to many rooms
     */
    public function bookings()
    {
        return $this->hasMany('App\Room');
    }
}
