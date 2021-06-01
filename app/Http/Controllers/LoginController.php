<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index () {
        return view ('auth.login');
    }


    public function store (Request $request) {

        //validation
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))){
            return back()->with('status', 'Invalid credentials');
        };

        $request->session()->regenerate();
        return redirect ('/');

    }
}
