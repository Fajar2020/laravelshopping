<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use Auth;

class CategoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:sanctum,admin');
    }

    public function viewCategories(){
        $categories=Category::latest()->get();
        return view('admin.backendcontent.category.category_view', compact('categories'));
    }

    public function storeCategory(Request $request){
        $validated = $request->validate([
            'category_name_en' => 'required|unique:categories|min:2',
            'category_name_id' => 'required|unique:categories|min:2',
            'category_icon'=> 'required'
        ]);

        $category=new Category;
        $category->category_name_en=$request->category_name_en;
        $category->category_name_id=$request->category_name_id;
        $category->category_slug_en=strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_id=strtolower(str_replace(' ', '-', $request->category_name_id));
        $category->last_updated_by=Auth::user()->id;
        $category->category_icon=$request->category_icon;
        $category->save();

        $notification=array(
            'message'=>'New category is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function editCategory($id){
        // ORM method
        $item=Category::find($id);
        return view('admin.backendcontent.category.category_edit', compact('item'));
    }

    public function updateCategory(Request $request,$id){
        $validated = $request->validate([
            'category_name_en' => 'required|min:2',
            'category_name_id' => 'required|min:2',
            'category_icon'=> 'required'
        ]);

        $category=Category::findOrFail($id);
        $category->category_name_en=$request->category_name_en;
        $category->category_name_id=$request->category_name_id;
        $category->category_slug_en=strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_id=strtolower(str_replace(' ', '-', $request->category_name_id));
        $category->last_updated_by=Auth::user()->id;
        $category->category_icon=$request->category_icon;
        $category->save();

        $notification=array(
            'message'=>'Category is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.categories')->with($notification);
    }

    public function deleteCategory($id){
        $category=Category::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Category is deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

}
