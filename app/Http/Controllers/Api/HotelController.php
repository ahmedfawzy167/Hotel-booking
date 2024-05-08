<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\HotelDetailsResource;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::paginate(2);
        if($hotels){
         if(request('page') > $hotels->lastPage()){
            return response()->json([
             'message' => 'Hotel Not Found'],404);
         }

        }
          return new HotelResource($hotels);
    }


    public function show($id)
    {
        $hotel = Hotel::find($id);
        if($hotel != null){
           return new HotelDetailsResource($hotel);
        }
        else{
            return response()->json([
             "message" => "Hotel Not Found"
            ],404);
        }

    }

    }

