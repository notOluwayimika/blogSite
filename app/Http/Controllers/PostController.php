<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(){
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search','category','author']))->paginate(15)->withQueryString(),
            'categories' => Category::all(),
            'currentCategory'=>Category::firstWhere('category',request('category'))
        ]);
        }

        public function show(Post $post){
            return view('post',[
                'post' => $post,
                'categories' => Category::all()
            ]) ; 
        }

        public function datatable(Request $request){
            if($request->ajax()){
                $data = Post::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = "<a href='/admin/posts/$row->id/edit' class='text-blue-600 hover:text-blue-900'>Edit</a> 
                        <button type='submit' class='text-red-600 hover:text-red-900' data-id=$row->id>Delete</button>";
                        return $actionBtn;
                    })->rawColumns(['action'])->make(true);
            }
        }
        

}
