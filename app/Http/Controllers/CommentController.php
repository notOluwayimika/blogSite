<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        try{
            return Comment::all();
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
    public function show($id)
    {
        try{
           return Comment::find($id); 
        } catch(Exception $e){
        return back()->with('failure', $e->getMessage());
        }
    }

    public function store(Request $request, $id)
    {
        try{
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
        return redirect("/posts/$post->id")->with('success','Comment Posted');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
                  
        }

    /**
     * Update the category
     */
    public function update(Request $request,$post_id)
    {
        try{
            $comment = Comment::find($post_id);
            $comment->update($request->all());
            if(request()->is('api*')) return $comment;
            return back()->with('success','Comment Updated');
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
            Comment::destroy($id);
            if(request()->is('api*')) return 'comment deleted';
            return back()->with('success','Comment Deleted');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
        
    }
}
