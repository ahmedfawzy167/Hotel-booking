<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Booking;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    public function index()
    {
        //Fetch The Number Of Rooms Avaliable//
        $rooms = Room::count();

        //Fetch The Number Of Hotels Avaliable//
        $hotels = Hotel::count();

        //Fetch The Latest Of Users in Our System//
        $latestUsersCount = User::count();

        //Fetch The Number Of Reviews//
        $reviewsCount = Review::count();

        //Fetch The Number Of Bookings//
        $bookingsCount = Booking::count();

        $today = Carbon::today();
        $bookingsToday = Booking::with(['hotel', 'user', 'hotel.images'])->whereDate('created_at', $today)->get();

        return view('home', compact('rooms', 'hotels', 'latestUsersCount', 'bookingsToday', 'reviewsCount', 'bookingsCount'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(Booking::class, 'check_in_date')
            ->registerModel(Hotel::class, 'name')
            ->registerModel(Room::class, 'room_number')
            ->search($query);

        return view('search', compact('searchResults'));
    }
}
