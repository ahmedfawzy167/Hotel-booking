<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user','hotel','hotel.images'])->where('status','pending')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Approved';
        $booking->save();
        session()->flash('message', 'Booking Has been Accepted');

        return redirect()->route('bookings.index');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Rejected';
        $booking->save();
        session()->flash('message', 'Booking Has been Rejected');

        return redirect()->route('bookings.index');
    }
}
