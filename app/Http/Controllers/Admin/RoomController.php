<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['hotel', 'hotel.images'])->paginate(3);
        return view('rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $hotels = Hotel::all();
        return view('rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => 'required|numeric:gt:0',
            'type' => 'required|string|max:100',
            'price' => 'required',
            'hotel_id' => 'required|numeric:gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $room = Room::findOrFail($id);
        $room->room_number = $request->room_number;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->hotel_id = $request->hotel_id;
        $room->save();

        Session::flash('message', 'Room is Updated Successfully');
        return redirect(route('rooms.index'));
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        Session::flash('message', 'Room is Trashed Successfully');
        return redirect(route('rooms.index'));
    }

    public function trashed()
    {
        $trashedRooms = Room::onlyTrashed()->get();
        return view('rooms.trash', compact('trashedRooms'));
    }

    public function restore($id)
    {
        $room = Room::withTrashed()->findOrFail($id);
        $room->restore();

        Session::flash('message', 'Room is Restored Successfully');
        return redirect(route('rooms.index'))->withInput();
    }

    public function delete($id)
    {
        $room = Room::withTrashed()->findOrFail($id);
        $room->forceDelete();

        Session::flash('message', 'Room is Permanently Deleted Successfully');
        return redirect(route('rooms.index'))->withInput();
    }
}
