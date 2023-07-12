<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }
    public function show($id)
    {
        return Comment::find($id);
    }

    public function store(Request $request, $id)
    {
        request()->validate([
            'body'=>'required',
        ]);
        $post = Post::find($id);
        $comment = $post->comments()->create([
            'body'=>Request('body'),
            'user_id'=>auth()->user()->id,
        ]); 
        if(request()->is('api*')){
        return $comment;           
    }
        return redirect("/posts/$post->id");

        
        
    }

    /**
     * Update the category
     */
    public function update(Request $request,$post_id)
    {
        $comment = Comment::find($post_id);
        $comment->update($request->all());
        if(request()->is('api*')) return $comment;
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        if(request()->is('api*')) return 'comment deleted';
        return back();
        
    }
}
