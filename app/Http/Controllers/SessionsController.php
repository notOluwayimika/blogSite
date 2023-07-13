<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy(Request $request){
        $user = request()->user();
        // $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        $user->tokens()->delete();
        if(request()->is('api*'))
        return [
            'message' => 'logged out'
        ];
        auth()->logout();
        return redirect('/posts');
    }

    public function create(){
        return view('sessions.create');
    }



    public function store(){
        try{
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
            if(request()->is('api*')){
                return response($response,201);
            } 
            return redirect('/posts')->with('success','Login Successful');
        }catch(Exception $e){
            return back()->with('failure','Login Was Unsuccessful');
        }
        
        
    }}