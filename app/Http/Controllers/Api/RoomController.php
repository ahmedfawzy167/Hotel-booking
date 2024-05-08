<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\RoomDetailsResource;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(3);
        if($rooms){
         if(request('page') > $rooms->lastPage()){
            return response()->json([
             'message' => 'Room Not Found'
            ],404);
         }

        }
          return new RoomResource($rooms);
    }

    public function show($id)
    {
        $room = Room::find($id);
        if($room != null){
           return new RoomDetailsResource($room);
        }
        else{
            return response()->json([
              "message" => "Room Not Found"
            ],404);
        }

    }


}
