<?php

namespace App\Models;

use Eloquent;

class CustomRate extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
}
