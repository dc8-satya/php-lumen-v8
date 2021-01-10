<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            //'password' => 'required|confirmed',
            'password' => 'required'
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    public function login(Request $request)
    {

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
//
//        //return "test";
//        //validate incoming request
//        $this->validate($request, [
//            'email' => 'required|string',
//            'password' => 'required|string',
//        ]);
//
//        $credentials = $request->only(['email', 'password']);
//
//        if (! $token = Auth::attempt($credentials)) {
//            return response()->json(['message' => 'Unauthorized'], 401);
//        }
//
//        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
