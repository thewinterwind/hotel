<?php

namespace App\Models;

use Eloquent;

class Hotel extends Eloquent
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
     * A hotel has many rooms
     */
    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }
}
