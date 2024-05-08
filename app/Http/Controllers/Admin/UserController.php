<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('city')->cityName(2)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $cities = City::all();
        return view('users.create', compact('cities'));
    }

    public function store(StoreUserRequest $request)
    {
        //get the data from request//
        $request->validated();
        // store the User in the Database//
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->city_id = $request->city_id;
        $user->save();

        Session::flash('message', 'User is Created Successfully');
        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        $user->load('city');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $cities = City::all();
        return view('users.edit', get_defined_vars());
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|max:400',
            'password' => ['required', Password::defaults()],
            'city_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->email = Str::mask($request->email, '*', 3);
        $user->password = bcrypt($request->password);
        $user->city_id = $request->city_id;
        $user->update();

        Session::flash('message', 'User is Updated Successfully');
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('message', 'User is Deleted Successfully');
        return redirect(route('users.index'));
    }
}
