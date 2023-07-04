<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/posts')->with('success','logged out successfully');
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(){
        $attributes = request()->validate([
            'email'=>'required|exists:users,email',
            'password'=>'required'
        ]);
        if(!auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email'=>'Your credentials are incorrect'
            ]);
        }
        session()->regenerate();
            return redirect('/')->with('success','You have logged in successfully');
    }
}
