<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__reviews store--//
    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);
        $check = DB::table('reviews')->where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->first();
        if($check){
            $notification = array('message' => 'Already you have a review with this product', 'alert-type' =>  'error');
            return redirect()->back()->with($notification);
        }
        $review = new Review();
        $review->product_id = $request->product_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = auth()->user()->id;
        $review->review_date = date('d-m-Y');
        $review->review_month = date('F');
        $review->review_year = date('Y');
        $review->save();
        $notification = array('message' => 'Thank for your review', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__reviews store--//

    //___wishlist add---------//
    public function addWishlist($id)
    {
        $check = DB::table('wishlists')->where('user_id',auth()->user()->
        id)->where('product_id',$id)->first();
        if($check){
            $notification = array('message' => 'Already you have a wishlist with this product', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $wishlist = array();
        $wishlist['user_id'] = auth()->user()->id;
        $wishlist['product_id'] = $id;
        DB::table('wishlists')->insert($wishlist);

        $notification = array('message' => 'product added on wishlist', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //___wishlist add---------//
}
