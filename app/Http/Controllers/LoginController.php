<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function auth(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required',
    ]);

    // Periksa apakah checkbox "Remember Me" dicentang
    $remember = $request->has('remember');

    // Coba autentikasi dengan kredensial dan remember option
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->with('loginError', 'Login Failed');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
