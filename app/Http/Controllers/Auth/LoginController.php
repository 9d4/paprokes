<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('v2.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login_with = filter_var($request['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $login_with => $request['username'],
            'password' => $request['password'],
        ];

        Auth::attempt($credentials);
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return back();
    }
}
