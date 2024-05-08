<?php

namespace App\Http\Controllers\Api;

use App\Events\RegisterEvent;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' =>  'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'city_id' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = ($request->email);
        $user->password = bcrypt(($request->password));
        $user->city_id = $request->city_id;
        $user->save();

        event(new RegisterEvent($user));

        return response()->json([
            'status'  => 'Success',
            'message' => 'Registeration is Done!',
            'user'  => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' =>  'required|email|max:200',
            'password' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('UserLogin')->accessToken;
            return response()->json([
                'status' => 'Success',
                'message' => 'User Logged in Successfully',
                'user'  => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Invalid Email or Password!'
            ], 401);
        }
    }



    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully Logged out'], 200);
    }
}
