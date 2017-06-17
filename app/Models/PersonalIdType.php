<?php

namespace App\Models;

use Eloquent;

class PersonalIdType extends Eloquent
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
     * A personal id type can belong to many customers
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
