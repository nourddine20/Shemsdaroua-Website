<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminAuthController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        var_dump('hhhhh');
        return view('panel.auth.login');
    }

    public function login(Request $request)
    {
        var_dump('helloo dd');
        $credentials = $request->only('email', 'password');
            var_dump($credentials);
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            var_dump('yes good');
            return redirect()->intended(route('panel.dashboard'));
        } else {
            var_dump('yes faild');
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('panel.login');
    }
}
