<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repos\InventoryRepo;
use App\Repos\RoomRepo;
use App\Helpers\RequestHelper;

class InventoryController extends Controller
{
    public function __construct(InventoryRepo $inventory, RoomRepo $room, RequestHelper $requestHelper)
    {
        $this->inventory = $inventory;
        $this->room = $room;
        $this->requestHelper = $requestHelper;
    }

    public function index()
    {
        $data['title'] = 'Room Inventory Control';
        $data['roomTypes'] = $this->room->getRoomTypes();

        return view('inventory.index', $data);
    }

    public function getInventory()
    {
        return response()->json([
            'monthly' => $this->inventory->get()
        ]);
    }

    public function updateInventory(Request $request)
    {
        if (is_null($request->available) && is_null($request->rate)) {
            return response()->json(['error' => 'You must update either availability or the rate'], 400);
        }

        $daysOfTheWeek = $this->requestHelper->getUniqueDaysOfWeek($request->day_range);

        $this->inventory->multidayUpdate([
            'days' => $daysOfTheWeek,
            'from' => $request->from,
            'to' => $request->to,
            'room_type' => $request->room_type,
            'rate' => $request->rate,
            'available' => $request->available,
        ]);

        return ['success' => true];
    }
}
