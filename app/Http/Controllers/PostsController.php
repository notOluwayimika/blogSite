<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
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
        return Post::find($id);
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
}

