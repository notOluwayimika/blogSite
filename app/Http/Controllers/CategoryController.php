<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Error;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            if(request()->is('api*')) return Category::all();
                return view('admin.categories.index',[
                    'categories'=>Category::all()
                ]);
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }
    public function show($id)
    {
        try{
            return Category::find($id);
        } catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function store(Request $request)
    {
        try{
            request()->validate([
                'category'=>'required',
            ]);
            $category = Category::create($request->all());
            if(request()->is('api*')) return $category; 
               return back()->with('success', 'Category Created Successfully');
        } catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    /**
     * Update the category
     */
    public function update(Request $request,$id)
    {
        try{
            $category = Category::find($id);
            $category->update($request->all()); 
        }
        catch(ModelNotFoundException $e){
            return back()->with('failure', $e->getMessage());
        }
        catch(QueryException $e){
            return back()->with('failure', $e->getMessage());
        }
        catch(Error $e){
            return back()->with('failure', $e->getMessage());
        }
        if(request()->is('api*')) return $category;
        return back()->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $associated_posts = Post::all()->where('category_id',$id);
                foreach($associated_posts as $post){
                    $post->delete();
                }
                Category::destroy($id);
                if(request()->is("/api*")) return 'category deleted';   
                     return back()->with('success','Category Deleted');
        }catch(Exception $e){
            return back()->with('failure', $e->getMessage());
        }
        
    }

    public function edit(Category $category){
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function datatable(Request $request){
        if($request->ajax()){
            $data = Category::latest()->get();
            try{
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a href='/admin/categories/$row->id/edit' class='ml-3 text-blue-600 hover:text-blue-900'>Edit</a> 
                    <button type='submit' class='ml-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-red-200 text-red-800' data-id=$row->id>Delete</button>";
                    return $actionBtn;
                })->rawColumns(['action'])->make(true);}
                catch(Exception $e){
                    return $e;
                }
        }
}
}
