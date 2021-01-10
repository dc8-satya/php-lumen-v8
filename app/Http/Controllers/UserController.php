<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $record = new User();
        $record->name= $request->name;
        $record->email = $request->email;
        $record->password= Hash::make($request->password);

        $record->save();

        return response()->json($record);
    }


    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if(Hash::check($request->password, $user->password)){
            $apikey = base64_encode(Str::random(40));
             User::where('email', $request->email)->update(['api_key' => "$apikey"]);
            return response()->json(['status' => 'success','api_key' => $apikey]);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
    }
}
