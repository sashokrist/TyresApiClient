<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validationData = $request->validate([
           'name' => 'required|max:55',
           'email' => 'email|required|unique:users',
           'password' => 'required|confirmed'
        ]);

        $validationData['password'] = bcrypt($request->password);
        $user = User::create($validationData);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=> $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return response('You are already logged');
        }
        $loginData = $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($loginData)){
            return response('message','invalid credentials');
        }
        $accessToken = auth()->user()->createToken('authToken');
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout() {
        DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update([
                'revoked' => true
            ]);
        return response()->json(null, 204);
    }
}
