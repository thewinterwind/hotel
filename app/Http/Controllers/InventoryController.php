<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $data['title'] = 'Room Inventory Control';

        return view('inventory.index', $data);
    }

    public function getInventory()
    {
        return response()->json([
            '2017-06-24' => 'Something'
        ]);
    }
}
