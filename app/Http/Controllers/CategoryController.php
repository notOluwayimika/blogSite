<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->is('api*')) return Category::all();
        return view('admin.categories.index',[
            'categories'=>Category::all()
        ]);
    }
    public function show($id)
    {
        return Category::find($id);
    }

    public function store(Request $request)
    {
        request()->validate([
            'category'=>'required',
        ]);
        return Category::create($request->all());
    }

    /**
     * Update the category
     */
    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $associated_posts = Post::all()->where('category_id',$id);
        foreach($associated_posts as $post){
            $post->delete();
        }
        Category::destroy($id);
        if(request()->is("/api*")) return 'category deleted';
        return back();
    }

}
