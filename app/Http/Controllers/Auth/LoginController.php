<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $authenticator = filter_var($request['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $authenticator => $request['username'],
            'password' => $request['password'],
        ];

        if (!Auth::attempt($credentials)){
            return back()->withInput();
        }

        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return back();
    }
}
