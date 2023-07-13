<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Error;
use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
        try{
            if(request()->is('api*')) return Post::all(); 
                return view('posts', [
                    'posts' => Post::latest()->filter(request(['search','category','author']))->paginate(9)->withQueryString(),
                    'categories' => Category::all(),
                    'currentCategory'=>Category::firstWhere('category',request('category'))
                ]);
        }catch(\Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
    public function admin_index(){
        try{
            return view('admin.posts.index',[
                'posts'=>Post::paginate(50)
            ]);
        }catch(Error $e){
            return back()->with('failure', $e->getMessage());
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
    public function create(){
        return view('admin.posts.create') ; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(){
        try{
            $attributes = request()->validate([
                'title'=>'required',
                'thumbnail'=>'image|required',
                'excerpt'=>'required',
                'body'=>'required',
                'category_id'=>['required', Rule::exists('categories','id')]
            ]);
            if(isset($attributes['thumbnail'])) $attributes['thumbnail']=request()->file('thumbnail')->store('public/thumbnails');
            $attributes['user_id']= auth()->id();
            $post =  Post::create($attributes);
            if(request()->is('api*')) return $post;
            return redirect('/posts');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        }
        
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $post = Post::findOrFail($id);
            
        }catch(ModelNotFoundException $e){
            return back()->with('failure', $e->getMessage());
        }catch(Error $e){
            return back()->with('failure', $e->getMessage());
        }  
        if(request()->is('api*'))return $post;
            return view('post',[
                'post' => Post::find($id),
                'categories' => Category::all()
            ]) ; 
    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Post $post){
        try{
            $attributes = request()->validate([
                'title'=>'required',
                'thumbnail'=>'image',
                'excerpt'=>'required',
                'body'=>'required',
                'category_id'=>['required', Rule::exists('categories','id')]
            ]);
            if(isset($attributes['thumbnail'])){
                $attributes['thumbnail']=request()->file('thumbnail')->store('public/thumbnails');
            }
            $post->update($attributes);
            if(request()->is('api*')) return $post;
            return back()->with('success', 'Post Updated Successfully');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            Post::destroy($id);
                if(request()->is('api*')) return 'Post Deleted';
                return back()->with('success', 'Post Updated Successfully');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    /**
     * Search For A Resource
     */
    public function search($title)
    {
        try{
            return Post::where('title','like','%'.$title.'%')->get();
        } catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
    public function datatable(Request $request){
        if($request->ajax()){
            $data = Post::latest()->get();
            try{
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/admin/posts/$row->id/edit' class='text-blue-600 hover:text-blue-900'>Edit</a> 
                    <button type='submit' class='text-red-600 hover:text-red-900' data-id=$row->id>Delete</button>";
                    return $actionBtn;
                })->rawColumns(['action'])->make(true);
        }
        catch(Exception $e){
            return $e;
        }
    }
    }
        
}

