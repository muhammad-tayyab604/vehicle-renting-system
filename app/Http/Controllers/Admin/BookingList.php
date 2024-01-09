<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingList extends Controller
{
    public function bookingList()
    {
        $bookings = Booking::with('vehicle')->orderBy('created_at', 'desc')->paginate(5);

        return view('AdminPanel.bookingList', compact('bookings'));
    }
}