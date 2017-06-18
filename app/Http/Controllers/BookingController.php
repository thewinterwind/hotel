<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repos\BookingRepo;

class BookingController extends Controller
{
    public function __construct(BookingRepo $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the bookings (formatted for datepicker calendar)
     */
    public function index()
    {
        return response()->json([
            'monthly' => $this->booking->get(true)
        ]);
    }
}
