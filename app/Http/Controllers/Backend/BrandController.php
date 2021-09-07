<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;

use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum,admin');
    }

    public function viewBrands(){
        $brands=Brand::latest()->get();
        return view('admin.backendcontent.brand.brand_view', compact('brands'));
    }

    public function editBrand($id){
        // ORM method
        $item=Brand::find($id);
        return view('admin.backendcontent.brand.brand_edit', compact('item'));
    }

    public function storeBrand(Request $request){
        $validated = $request->validate([
            'brand_name_en' => 'required|unique:brands|min:2',
            'brand_name_id' => 'required|unique:brands|min:2',
            'brand_image'=> 'required|mimes:jpg,jpeg,png'
        ]);

        $brand_image=$request->file('brand_image');

        $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img='upload/brand_images/'.$name_gen;

        // to use image don't forget to run 
        // composer require intervention/image
        Image::make($brand_image)->resize(300, 300)->save($last_img);

        $brand=new Brand;
        $brand->brand_name_en=$request->brand_name_en;
        $brand->brand_name_id=$request->brand_name_id;
        $brand->brand_slug_en=strtolower(str_replace(' ', '-', $request->brand_name_en));
        $brand->brand_slug_id=strtolower(str_replace(' ', '-', $request->brand_name_id));
        $brand->last_updated_by=Auth::user()->id;
        $brand->brand_image=$last_img;
        $brand->save();

        $notification=array(
            'message'=>'New brand is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function updateBrand(Request $request){
        $validated = $request->validate([
            'brand_name_en' => 'required|min:2',
            'brand_name_id' => 'required|min:2',
            'brand_image'=> 'mimes:jpg,jpeg,png'
        ]);

        $old_image=$request->old_image;
        $brand_image=$request->file('brand_image');
        $last_img=$old_image;
        if($brand_image){
            $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            $last_img='upload/brand_images/'.$name_gen;
            Image::make($brand_image)->resize(300, 300)->save($last_img);
    
            unlink($old_image);    
        }

        // Brand::findOrFail($brand_id)->update([
        //     // isi nama field ya dan isiannya
        // ])

        $brand=Brand::find($request->id);
        $brand->brand_name_en=$request->brand_name_en;
        $brand->brand_name_id=$request->brand_name_id;
        $brand->brand_slug_en=strtolower(str_replace(' ', '-', $request->brand_name_en));
        $brand->brand_slug_id=strtolower(str_replace(' ', '-', $request->brand_name_id));
        $brand->last_updated_by=Auth::user()->id;
        $brand->brand_image=$last_img;
        $brand->save();

        $notification=array(
            'message'=>'The brand is updated successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('all.brands')->with($notification);
    }

    public function deleteBrand($id){
        $brand=Brand::findOrFail($id);
        $old_image=$brand->brand_image;
        unlink($old_image);

        // find($id) takes an id and returns a single model. If no matching model exist, it returns null.
        // findOrFail($id) takes an id and returns a single model. If no matching model exist, it throws an error 404. 
        
        Brand::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Brand is deleted successfully',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

}
