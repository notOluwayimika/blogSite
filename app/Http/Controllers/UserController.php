<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        try{
            $users = User::all();
            if(request()->is('api*')) return $users;
            return view('admin.users.index',[
                'users'=>$users
        ]);
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function show($id){
        try{
            return view('admin.users.update',[
                'user'=>User::find($id)
            ]);
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function datatable(Request $request){
        if($request->ajax()){
            $data = User::latest()->get();
            try{
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = "<a href='/admin/users/$row->id/edit' class='ml-3 text-blue-600 hover:text-blue-900'>Edit</a> 
                        <button type='submit' class='ml-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-red-200 text-red-800' data-id=$row->id>Delete</button>";
                        return $actionBtn;
                    })->rawColumns(['action'])->make(true);
            }catch(Exception $e){
                return back()->with('failure', $e->getMessage());
            }
            
        }
    }

    public function edit(User $user){
        try{
            return view('admin.users.edit', [
                'user' => $user,
                'roles'=> $user->getRoleNames(),
                'allroles'=>Role::all()
            ]);
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function role(User $user){
        try{
            $user->roles()->detach();
            $user->assignRole(request('helper-radio'));
            if(request()->is('api*')) return $user;
            return back()->with('success','User Role Updated');
        }
        catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
    }
    public function update($id)
    {
        try{
            $user = User::find($id);
            $uniqueid = request()->route('id');
            $attributes =  request()->validate([
                'name' => 'min:8|max:255',
                'email' => "required|email|max:255|min:3|unique:users,email,$uniqueid",
                'username' => "min:8|max:255|min:3|unique:users,username,$uniqueid",
            ]);
            if(request('password')){
                $attributes['password']=bcrypt(request('password'));
            } 
            $user->update($attributes);
            if(request()->is('api*'))return $user;
            return back()->with('success','Details Updated'); 
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function destroy($id)
    {
        try{
            User::destroy($id);
            if(request()->is("/api*")) return 'category deleted';
            return back()->with('success','User Deleted');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
}
