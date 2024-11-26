<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{

    //root page
    public function index(){
        // $category = Category::all();
        $category = DB::table('categories')->get();
        $banner_product = Product::where('product_slider',1)->where('status',1)->latest()->first();

        $featured = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();

        $popular_products = Product::where('status',1)->orderBy('product_view','DESC')->limit(16)->get();

        $trendy_product = Product::where('product_trendy',1)->where('status',1)->orderBy('id','DESC')->limit(10)->get();

        ///---home category
        $home_category = Category::where('home_page',1)->orderBy('category_name','ASC')->get();

        return view('frontend.index',compact('category','banner_product','featured','popular_products','trendy_product','home_category'));
    }

    //__single product page calling-----///
    public function productDetails($slug){
        // $product = Product::find($slug);
        $product = Product::where('product_slug',$slug)->first();

        //--auto increment view---//
        Product::where('product_slug',$slug)->increment('product_view');

        $related_products = DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->limit(10)->get();

        $average_rating = DB::table('reviews')->where('product_id',$product->id)->avg('rating');
        $average_rating = round($average_rating, 1);

        // $product_review = DB::table('reviews')->where('product_id', $product->id)->orderBy('rating', 'desc')->get();

        $rating_count = DB::table('reviews')->select('rating', DB::raw('count(*) as total'))->where('product_id', $product->id)->groupBy('rating')->orderBy('rating', 'desc')->pluck('total', 'rating');

        $review_all = Review::where('product_id',$product->id)->limit(6)->latest()->get();

        $brands = Brand::limit(10)->get();

        return view('frontend.product.product_details',compact('product','related_products','average_rating','review_all','rating_count','brands'));
    }
    //__single product page calling-----///

    ///----product quick view---///
    public function productQuickView($id){
        $product = Product::find($id);
        return view('frontend.product.quick_view',compact('product'));
    }
    ///----product quick view---///
}
