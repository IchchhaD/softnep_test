<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
   
        ]);

        if ($login->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(!auth()->attempt($credentials))
        {
            return response(['error'=>true,'message' => 'Invalid username or password']);
        }

        $user = User::where('email', $request->email)->get();

        $token = rand(100000000000000,999999999999999);

        $user = auth()->user();

        return response()->json([
            'success'=> true,
            'error' => false,
            'id' => $user->id,
            'email' => $user->email,
            'access_token' => $token,
            'isLoggedIn' => true,
            'token_type' => 'Bearer',
        ]);
    }
}
