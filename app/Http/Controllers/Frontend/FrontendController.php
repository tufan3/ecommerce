<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\Page;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Websitereview;
use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{

    //root page
    public function index(){
        // $category = Category::all();
        $category = DB::table('categories')->orderBy('category_name')->get();
        $banner_product = Product::where('product_slider',1)->where('status',1)->latest()->first();

        $featured = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();

        $popular_products = Product::where('status',1)->orderBy('product_view','DESC')->limit(16)->get();

        $trendy_product = Product::where('product_trendy',1)->where('status',1)->orderBy('id','DESC')->limit(10)->get();

        ///---home category
        $home_category = Category::where('home_page',1)->orderBy('category_name','ASC')->get();

        //---brand---//
        $brand = Brand::where('front_page',1)->limit(24)->get();

        //-- recent view---//
        $recent_view = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        //--today deal--//
        $today_deal = Product::where('today_deal',1)->where('status',1)->orderBy('id','desc')->limit(6)->get();

        //--website revire--//
        $website_review = Websitereview::where('status',1)->orderBy('review_date','DESC')->limit(12)->get();


        return view('frontend.index',compact('category','banner_product','featured','popular_products','trendy_product','home_category','brand','recent_view','today_deal','website_review'));
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


    ///----category wise product page---///
    public function categoryWiseProduct($slug){
        $category = Category::where('category_slug',$slug)->first();
        $subcategory = Subcategory::where('category_id',$category->id)->get();
        $product = Product::where('category_id',$category->id)->where('status',1)->paginate(60);

        $brand = Brand::all();

        //-- recent view---//
        $recent_view = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.category_products',compact('category','subcategory','product','brand','recent_view'));
    }
    ///----category wise product page---///


    //__subcategory wise product page calling-----///
    public function subcategoryWiseProduct($slug){
        $subcategory = Subcategory::where('subcategory_slug',$slug)->first();
        $childcategory = Childcategory::where('subcategory_id',$subcategory->id)->get();
        $category = Category::all();
        $product = Product::where('subcategory_id',$subcategory->id)->where('status',1)->paginate(60);

        $brand = Brand::all();

        //-- recent view---//
        $recent_view = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.subcategory_products',compact('subcategory','childcategory','product','brand','recent_view','category'));
    }
    //__subcategory wise product page calling-----///


    //__childcategory wise product page calling-----///
    public function childcategoryWiseProduct($slug){
        $childcategory = Childcategory::where('childcategory_slug',$slug)->first();
        $category = Category::all();
        $product = Product::where('childcategory_id',$childcategory->id)->where('status',1)->paginate(60);

        $brand = Brand::all();

        //-- recent view---//
        $recent_view = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.childcategory_products',compact('childcategory','product','brand','recent_view','category'));
    }
    //__childcategory wise product page calling-----///


    //---brand wise product page calling-----///
    public function brandWiseProduct($slug){
        $brand = Brand::where('brand_slug',$slug)->first();
        $category = Category::all();
        $product = Product::where('brand_id',$brand->id)->where('status',1)->paginate(60);

        $brands = Brand::all();
        //-- recent view---//
        $recent_view = Product::where('status',1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.brand_products',compact('brand','product','recent_view','category','brands'));
    }
    //---brand wise product page calling-----///

    //---footer page view-----///
    public function viewPage($slug){
        $page = Page::where('page_slug',$slug)->first();
        return view('frontend.page',compact('page'));
    }
    //---footer page view-----///

    //--news letter ---//
    public function storeNewsLetter(Request $request){
        $request->validate([
            'email' =>'required|email|unique:newsletters',
        ]);
        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();

        return response()->json(['message' => 'Subscribed successfully!'], 200);
    }
    //--news letter ---//

}
