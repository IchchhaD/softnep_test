<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use Illuminate\Support\Facades\Validator;

use App\Model\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $register = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($register->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }

        $password = Hash::$request->password;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        if($user->save())
        {
            return response(['error'=>false,'message' => 'User Created']);
        }
        return response(['error'=>true, 'message' => 'User not created']);
    }
}
