<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\BookingDetailsResource;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::paginate(3);
        if($bookings){
         if(request('page') > $bookings->lastPage()){
            return response()->json([
             'message' => 'Booking Not Found'],404);
         }

        }
          return new BookingResource($bookings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_in_date' => 'required|date_format:Y-m-d H:i:s',
            'check_out_date' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required|numeric|gt:0',
            'hotel_id' => 'required|numeric|gt:0',
        ]);

        if($validator->fails()) {
           return response()->json($validator->errors()->toJson(),400);
        }
        $booking = new Booking();
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->user_id = $request->user_id;
        $booking->hotel_id = $request->hotel_id;
        $booking->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Booking Created Successfully!",
            "booking" => $booking
        ],201);
    }

    public function show($id)
    {
        $booking = Booking::find($id);
        if($booking != null){
           return new BookingDetailsResource($booking);
        }
        else{
            return response()->json([
             "message" => "Booking Not Found"
            ],404);
        }

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'check_in_date' => 'required|date_format:Y-m-d H:i:s',
            'check_out_date' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required|numeric|gt:0',
         ]);

         if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
         }

        $booking = Booking::findOrFail($id);
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->user_id = $request->user_id;
        $booking->save();

        return response()->json([
            "status" => 'Success',
            "message" => "Booking Updated Successfully!",
            "booking" => $booking
        ],201);

    }

    public function destroy($id)
    {
       $booking = Booking::findOrFail($id);
       if($booking!= null){
        $booking->delete();
        return response()->json([
         "status" => 'Success',
         "message" => "Booking is Deleted"
        ],204);
       }

       else{
        return response()->json([
            "message" => "This ID Not Correct"
        ],404);
       }
    }
}
