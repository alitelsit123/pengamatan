<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function viewLogin(){
        return view('auth.login');
    }
    public function viewForget(){
        return view('auth.forget');
    }
    public function login(Request $r) {
        $credentials = $r->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        if(auth()->attempt($credentials)) {
            $r->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'login' => 'Username / Password salah !!!'
        ]);
    }
    public function logout(Request $r) {
        auth()->logout();
        return redirect()->intended('/login');
    }
}
