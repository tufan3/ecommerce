<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Product;
use Cart;
use Session;

class CheckoutController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //---checkout page---//
    public function checkout(){
        if(!Auth::check()){
            $notification = array('message' => 'At first Login your account!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
        $cart_content = Cart::content();
        return view('frontend.cart.checkout',compact('cart_content'));
    }
    //---checkout page---//

    //---apply coupon---//
    public function applyCoupon(Request $request){
        $coupon_code = $request->coupon;
        $check = DB::table('coupons')->where('coupon_code', $coupon_code)->first();
        if($check){
            if(date('Y-m-d',strtotime(date('Y-m-d'))) <= date('Y-m-d',strtotime($check->valid_date))){
                $discount = $check->coupon_amount;
                $subtotal = (float) str_replace(',', '', Cart::subtotal());
                $total = $subtotal - $discount;
                Session::put('coupon',[
                    'name' => $check->coupon_code,
                    'discount' => $discount,
                    'after_discount' => $total
                ]);

                $notification = array('message' => 'Coupon applied successfully!', 'alert-type' =>'success');
                return redirect()->back()->with($notification);
            }else{
                $notification = array('message' => 'Coupon is expired or not active!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array('message' => 'Invalid coupon code! try again', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

    }
    //---apply coupon---//


    //---remove coupon---//
    public function removeCoupon(){
        Session::forget('coupon');
        $notification = array('message' => 'Coupon removed successfully!', 'alert-type' =>'success');
        return redirect()->back()->with($notification);
    }
    //---remove coupon---//

}
