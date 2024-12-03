<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Websitereview;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__reviews for product--//
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
    //__reviews product--//


    //__reviews for website--//
    public function write() {
        // $reviews = Review::where('user_id', auth()->user()->id)->get();
        return view('user.review_write');
    }

    //--store website review---//
    public function storeWebsiteReview(Request $request) {
        $request->validate([
           'review' =>'required',
            'rating' =>'required',
        ]);
        $check = DB::table('websitereviews')->where('user_id',auth()->user()->id)->first();
        if($check){
            $notification = array('message' => 'Already you have a review', 'alert-type' =>  'error');
            return redirect()->back()->with($notification);
        }
            $websitereview = new Websitereview();
            $websitereview->review = $request->review;
            $websitereview->rating = $request->rating;
            $websitereview->user_id = auth()->user()->id;
            $websitereview->name = auth()->user()->name;
            $websitereview->review_date = date('d, F Y');
            $websitereview->status = 0;
            $websitereview->save();
            $notification = array('message' => 'Thank you for your review', 'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    //--store website review---//
    //__reviews for website--//

}
