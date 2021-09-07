<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

use Auth;

class SubSubCategoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:sanctum,admin');
    }

    public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
     }

    public function viewSubSubCategories(){
        $categories=Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories=SubSubCategory::latest()->get();
        return view('admin.backendcontent.category.sub_sub_category_view', compact('categories', 'subsubcategories'));
    }

    public function storeSubSubCategory(Request $request){
        $validated = $request->validate([
            'subsubcategory_name_en' => 'required|min:2',
            'subsubcategory_name_id' => 'required|min:2',
            'category_id'=> 'required',
            'subcategory_id'=> 'required'
        ]);

        $item=SubCategory::find((int)$request->subcategory_id);

        $category=new SubSubCategory;
        $category->subsubcategory_name_en=$request->subsubcategory_name_en;
        $category->subsubcategory_name_id=$request->subsubcategory_name_id;
        
        $category->subsubcategory_slug_en=$item->subcategory_slug_en.strtolower(str_replace(' ', '-', $request->subsubcategory_name_en));
        $category->subsubcategory_slug_id=$item->subcategory_slug_id.strtolower(str_replace(' ', '-', $request->subsubcategory_name_id));
        
        $category->last_updated_by=Auth::user()->id;
        $category->category_id=$request->category_id;
        $category->subcategory_id=$request->subcategory_id;
        $category->save();

        $notification=array(
            'message'=>'New sub sub category is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function editSubSubCategory($id){
        $item=SubSubCategory::findOrFail($id);
        $categories=Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories=SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        return view('admin.backendcontent.category.sub_sub_category_edit', compact('item', 'categories', 'subcategories'));
    }

    public function updateSubSubCategory(Request $request){
        $validated = $request->validate([
            'subsubcategory_name_en' => 'required|min:2',
            'subsubcategory_name_id' => 'required|min:2',
            'category_id'=> 'required',
            'subcategory_id'=> 'required'
        ]);

        $item=SubCategory::find((int)$request->subcategory_id);

        $category=SubSubCategory::findOrFail($request->id);;
        $category->subsubcategory_name_en=$request->subsubcategory_name_en;
        $category->subsubcategory_name_id=$request->subsubcategory_name_id;

        $category->subsubcategory_slug_en=$item->subcategory_slug_en.strtolower(str_replace(' ', '-', $request->subsubcategory_name_en));
        $category->subsubcategory_slug_id=$item->subcategory_slug_id.strtolower(str_replace(' ', '-', $request->subsubcategory_name_id));
        
        $category->last_updated_by=Auth::user()->id;
        $category->category_id=$request->category_id;
        $category->subcategory_id=$request->subcategory_id;
        $category->save();

        $notification=array(
            'message'=>'Sub sub category is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.sub.sub.categories')->with($notification);
    }

    public function deleteSubSubCategory($id){
        $category=SubSubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Sub sub category is deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }
}
