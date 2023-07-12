<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->is('api*')) return Post::all(); 
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search','category','author']))->paginate(9)->withQueryString(),
            'categories' => Category::all(),
            'currentCategory'=>Category::firstWhere('category',request('category'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'title'=>'required',
            'thumbnail'=>'image',
            'excerpt'=>'required',
            'body'=>'required',
            'category_id'=>['required', Rule::exists('categories','id')]
        ]);
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(request()->is('api*'))return Post::find($id);
        return view('post',[
            'post' => Post::find($id),
            'categories' => Category::all()
        ]) ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $post = Post::find($id);
        $post->update($request->all());
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       return Post::destroy($id);
    }

    /**
     * Search For A Resource
     */
    public function search($title)
    {
       return Post::where('title','like','%'.$title.'%')->get();
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

        public function category_datatable(Request $request){
            if($request->ajax()){
                $data = Category::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = "<a href='/admin/posts/$row->id/edit' class='ml-3 text-blue-600 hover:text-blue-900'>Edit</a> 
                        <button type='submit' class='ml-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-red-200 text-red-800' data-id=$row->id>Delete</button>";
                        return $actionBtn;
                    })->rawColumns(['action'])->make(true);
            }
    }
}

