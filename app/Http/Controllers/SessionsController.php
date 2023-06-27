<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/posts')->with('success','logged out successfully');
    }

    public function create(){
        return view('sessions.create');
    }
}
