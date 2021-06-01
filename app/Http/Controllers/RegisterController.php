<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    

    public function index () {
        return view ('auth.register');
    }

    public function store (Request $request) {

        //validation
        //eventualmente previeni caratteri speciali nel nome e nella password, richiedi lunghezza minima password
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed',
        ]);

        //hash pwd and add user to DB
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->isAdmin = false;
        $user->save();

        //sign user in
        if (Auth::attempt($request->only('email', 'password'))){
            //redirect
            return redirect('/');
        };
        
    }
}
