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

    //__register page--------------------------//
    // public function registerUser()
    // {
    //     return view('frontend.register_user');
    // }
    // //__register page--------------------------//

    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required', 'string', 'max:255',
    //         'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
    //         'password' => 'required', 'string', 'min:6', 'confirmed',
    //         ]);
    //         $user = new User();
    //         $user->name = $request->input('name');
    //         $user->email = $request->input('email');
    //         $user->password = bcrypt($request->input('password'));
    //         $user->save();
    //         $notification = array('message' => 'Your are successfully login!', 'alert-type' => 'success');
    //         // return redirect()->route('/')->with($notification);
    //         return redirect('/')->with($notification);

    // }


    //root page
    public function index(){
        // $category = Category::all();
        $category = DB::table('categories')->get();
        $banner_product = Product::where('product_slider',1)->latest()->first();

        return view('frontend.index',compact('category','banner_product'));
    }

    //__single product page calling-----///
    public function productDetails($slug){
        // $product = Product::find($slug);
        $product = Product::where('product_slug',$slug)->first();
        $related_products = DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','desc')->limit(10)->get();

        $average_rating = DB::table('reviews')->where('product_id',$product->id)->avg('rating');
        $average_rating = round($average_rating, 1);

        // $product_review = DB::table('reviews')->where('product_id', $product->id)->orderBy('rating', 'desc')->get();

        $rating_count = DB::table('reviews')->select('rating', DB::raw('count(*) as total'))->where('product_id', $product->id)->groupBy('rating')->orderBy('rating', 'desc')->pluck('total', 'rating');

        $review_all = Review::where('product_id',$product->id)->limit(6)->latest()->get();

        $brands = Brand::limit(10)->get();

        return view('frontend.product_details',compact('product','related_products','average_rating','review_all','rating_count','brands'));
    }
    //__single product page calling-----///
}
