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

    // load the main page
    public function index()
    {
        $data['title'] = 'Room Inventory Control';
        $data['roomTypes'] = $this->room->getRoomTypes();

        return view('inventory.index', $data);
    }

    // provide the calendar's data
    public function getInventory()
    {
        return response()->json([
            'monthly' => $this->inventory->get()
        ]);
    }

    // update the inventory based off parameters from the bulk update tool
    public function updateInventory(Request $request)
    {
        if (is_null($request->available) && is_null($request->rate)) {
            return response('You must enter at least one of the availability or the rate.', 400);
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

    // update a room's availability and rate on a single date
    public function updateSingleInventory(Request $request, $roomId)
    {
        $this->inventory->updateRoomOnSpecificDate(
            $roomId,
            $request->get('rate'),
            $request->get('date'),
            $request->get('available')
        );
    }

    // fetch the inventory information for a single room on a single date
    public function findInventory(Request $request)
    {
        $data = $this->inventory->find(
            $request->get('date'),
            $request->get('room_id')
        );

        return $data + [
            'modal_body' => view('partials.modal-content', $data)->render(),
            'modal_header' => 'Edit room ' . $data['number'] . ' for ' . $data['date']
        ];
    }
}
