<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;

use Auth;

class SubCategoryController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:sanctum,admin');
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function viewSubCategories(){
        $categories=Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories=SubCategory::latest()->get();
        return view('admin.backendcontent.category.sub_category_view', compact('subcategories', 'categories'));
    }

    public function storeSubCategory(Request $request){
        $validated = $request->validate([
            'subcategory_name_en' => 'required|min:2',
            'subcategory_name_id' => 'required|min:2',
            'category_id'=> 'required'
        ]);

        $item=Category::find((int)$request->category_id);

        $category=new SubCategory;
        $category->subcategory_name_en=$request->subcategory_name_en;
        $category->subcategory_name_id=$request->subcategory_name_id;
        $category->subcategory_slug_en=$item->category_slug_en.strtolower(str_replace(' ', '-', $request->subcategory_name_en));
        $category->subcategory_slug_id=$item->category_slug_id.strtolower(str_replace(' ', '-', $request->subcategory_name_id));
        $category->last_updated_by=Auth::user()->id;
        $category->category_id=$request->category_id;
        $category->save();

        $notification=array(
            'message'=>'New category is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function editSubCategory($id){
        $item=SubCategory::findOrFail($id);
        $categories=Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.backendcontent.category.sub_category_edit', compact('item', 'categories'));
    }

    public function updateSubCategory(Request $request){
        $validated = $request->validate([
            'subcategory_name_en' => 'required|min:2',
            'subcategory_name_id' => 'required|min:2',
            'category_id'=> 'required'
        ]);

        $item=Category::find((int)$request->category_id);

        $category=SubCategory::findOrFail($request->id);
        $category->subcategory_name_en=$request->subcategory_name_en;
        $category->subcategory_name_id=$request->subcategory_name_id;
        $category->subcategory_slug_en=$item->category_slug_en.strtolower(str_replace(' ', '-', $request->subcategory_name_en));
        $category->subcategory_slug_id=$item->category_slug_id.strtolower(str_replace(' ', '-', $request->subcategory_name_id));
        $category->last_updated_by=Auth::user()->id;
        $category->category_id=$request->category_id;
        $category->save();

        $notification=array(
            'message'=>'Sub Category is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.sub.categories')->with($notification);
    }

    public function deleteSubCategory($id){
        $category=SubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Sub Category is deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

}
