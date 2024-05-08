<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['hotel', 'user', 'hotel.images'])->get();
        return view('reviews.index', compact('reviews'));
    }
}
