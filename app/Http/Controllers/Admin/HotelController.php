<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $term = request('term');
        if ($term) {
            $hotels = Hotel::whereAny(['name', 'address'], "LIKE", "%$term%")->paginate(2);
        } else {
            $hotels = Hotel::with('images')->paginate(2);
        }
        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'description' => 'required|string|max:800',
            'address' => 'required|string|max:200',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:3000',
        ]);

        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->address = $request->address;
        $hotel->save();

        foreach ($request->file('images') as $imageFile) {
            $ext = $imageFile->getClientOriginalExtension();
            $fileName = Date("Y-m-d-h-i-s") . '.' . $ext;
            $location = "public/";
            $imageFile->storeAs($location, $fileName);

            $image = new Image();
            $image->path = $fileName;
            $image->imageable_id = $hotel->id;
            $image->imageable_type = 'App\Models\Hotel';
            $image->save();
        }

        Session::flash('message', 'Hotel is Created Successfully');
        return redirect(route('hotels.index'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,50',
            'description' => 'required|string|max:800',
            'address' => 'required|string|max:200',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:3000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $hotel = Hotel::find($id);
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->address = $request->address;
        $hotel->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $ext = $imageFile->getClientOriginalExtension();
                $fileName = time() . '.' . $ext;
                $location = "public/";
                $imageFile->storeAs($location, $fileName);

                $image = new Image();
                $image->path = $fileName;
                $image->imageable_id = $hotel->id;
                $image->imageable_type = 'App\Models\Hotel';
                $image->save();
            }
        }

        Session::flash('message', 'Hotel is Updated Successfully');
        return redirect(route('hotels.index'));
    }
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        Session::flash('message', 'Hotel is Trashed Successfully');
        return redirect(route('hotels.index'));
    }

    public function trashed()
    {
        $trashedHotels = Hotel::onlyTrashed()->get();
        return view('hotels.trash', compact('trashedHotels'));
    }

    public function restore($id)
    {
        $hotel = Hotel::withTrashed()->findOrFail($id);
        $hotel->restore();

        Session::flash('message', 'Hotel is Restored Successfully');
        return redirect(route('hotels.index'))->withInput();
    }

    public function delete($id)
    {
        $hotel = Hotel::withTrashed()->findOrFail($id);
        $hotel->forceDelete();

        Session::flash('message', 'Hotel is Permanently Deleted Successfully');
        return redirect(route('hotels.index'))->withInput();
    }
}
