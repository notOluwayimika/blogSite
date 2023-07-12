<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function edit(Category $category){
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function datatable(Request $request){
        if($request->ajax()){
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/admin/category/$row->id/edit' class='ml-3 text-blue-600 hover:text-blue-900'>Edit</a> 
                    <button type='submit' class='ml-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-red-200 text-red-800' data-id=$row->id>Delete</button>";
                    return $actionBtn;
                })->rawColumns(['action'])->make(true);
        }
}
}
