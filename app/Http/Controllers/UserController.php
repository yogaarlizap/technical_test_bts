<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'name' => 'required',
            'postcode' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'name' => $request->name,
            'postcode' => $request->postcode
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()
        ->json([
            'email' => $user->email,
            'token' => $token,
            'username' => $user->username
        ]);
    }

    public function signin(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'email' => $user->email,
            'token' => $token,
            'username' => $user->username
        ]);
    }

    public function all_users()
    {
        $user = User::all();

        return response()->json($user);
    }
}
