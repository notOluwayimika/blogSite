<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'logged out'
        ];
    }

    public function create(){
        return view('sessions.create');
    }



    public function store(){
        $attributes =  request()->validate([
            'email' => 'required|email|max:255|min:3|exists:users,email',
            'password' => 'required|max:255|min:8'
        ]);
        if(!auth()->attempt($attributes)){  
            return response([
                'message'=>'Credentials Incorrect'
            ],401);
                    }
        
        $attributes['password']=bcrypt($attributes['password']);
        $user=User::where('email',$attributes['email'])->first();
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }}