<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImgProduct;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        $rand_skip=rand(0, count($categories) - 1);
    	$skip_category = Category::skip($rand_skip)->first();
    	$skip_product = Product::where('status',1)->where('category_id',$skip_category->id)->orderBy('id','DESC')->limit(6)->get();

        $rand_skip_brand=rand(0, DB::table('brands')->count() - 1);
        $skip_brand = Brand::skip($rand_skip_brand)->first();
    	$skip_brand_product = Product::where('status',1)->where('brand_id',$skip_brand->id)->orderBy('id','DESC')->limit(6)->get();

        return view('frontend.index',compact('sliders','categories','products','featured','special_offer','special_deals','skip_category','skip_product','skip_brand','skip_brand_product'));
    }

    public function ProductDetails($id,$slug){
		$product = Product::findOrFail($id);
        $multiImag = MultiImgProduct::where('product_id',$id)->get();

        $color_en = $product->product_color_en;
		$product_color_en = explode(',', $color_en);

		$color_hin = $product->product_color_hin;
		$product_color_hin = explode(',', $color_hin);

		$size_en = $product->product_size_en;
		$product_size_en = explode(',', $size_en);

		$size_hin = $product->product_size_hin;
		$product_size_hin = explode(',', $size_hin);

		$cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

	 	return view('frontend.product.product_details',compact('product','multiImag','product_color_en','product_color_hin','product_size_en','product_size_hin','relatedProduct'));
	}

    public function TagWiseProduct($tag){
        $products = Product::where('status',1)->where(function($query) use ($tag){
			$query->where('product_tags_en','LIKE',"%{$tag}%")
						->orWhere('product_tags_ind','LIKE',"%{$tag}%");
        })->paginate(3);;
        $categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tags.tags_view',compact('products','categories'));
	}

    // Subcategory wise data
	public function SubCatWiseProduct($subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.subcategory_view',compact('products','categories'));
	}

    // Sub-Subcategory wise data
	public function SubSubCatWiseProduct($subsubcat_id,$slug){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.product.sub_subcategory_view',compact('products','categories'));
	}

	/// Product View With Ajax
	public function ProductViewAjax($id){
		$product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 

}
