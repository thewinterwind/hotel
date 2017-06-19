<?php

namespace App\Repos;

use App\Models\RoomType;
use Log;

class RoomRepo {

    public function __construct(RoomType $roomType)
    {
        $this->roomType = $roomType;
    }

    /**
     * Get the room types
     * 
     * @return null
     */
    public function getRoomTypes()
    {
        return $this->roomType->all();
    }
}
