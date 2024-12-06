<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Mail;
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
                $subtotal = Cart::subtotal();
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

    ///--order place--//
    public function orderPlace(Request $request){
        $shipping_details = DB::table('shippings')->where('id',$request->shipping_id)->first();
        $order_number = rand(10000,9000000);
        // $cart_content = Cart::content();
        // $subtotal = (float) str_replace(',', '', Cart::subtotal());
        // $total = (float) str_replace(',', '', Cart::total());
        // $coupon = Session::get('coupon');
        $user = Auth::user();
        $order = array();
        $order['user_id'] = $user->id;
        $order['shipping_id'] = $request->shipping_id;
        if(Session::has('coupon')){
            $order['sub_total'] = Cart::subtotal();
            $order['total'] = Cart::total();
            $order['coupon_code'] = Session::get('coupon')['name'];
            $order['coupon_discount'] = Session::get('coupon')['discount'];
            $order['after_discount'] = Session::get('coupon')['after_discount'];
        }else{
            $order['sub_total'] = Cart::subtotal();
            $order['total'] = Cart::total();
        }
        $order['payment_type'] = $request->payment_type;
        $order['tax'] = 0;
        $order['shipping_cost'] = 0;
        $order['order_number'] = $order_number;
        $order['status'] = 'Pending';
        $order['date'] = date('d-m-Y');
        $order['month'] = date('F');
        $order['year'] = date('Y');
        // dd($order);
        // $order = Order::create($order);

        $order_id = DB::table('orders')->insertGetId($order);

        // Mail::to($shipping_details->shipping_email)->send(new InvoiceMail($order));


        $cart_details = Cart::content();
        $order_details = [];

        foreach ($cart_details as $row) {
            $order_detail = [
                'order_id' => $order_id,
                'product_id' => $row->id,
                'product_name' => $row->name,
                'color' => $row->options->color,
                'size' => $row->options->size,
                'quantity' => $row->qty,
                'single_price' => $row->price,
                'subtotal_price' => $row->price * $row->qty,
            ];

            DB::table('orderdetails')->insert($order_detail); // Insert into database
            $order_details[] = $order_detail; // Store in the array for email
        }

        Mail::to($shipping_details->shipping_email)->send(new InvoiceMail($order, $order_details));
        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification = array('message' => 'Order Place successfully!', 'alert-type' =>'success');
        return redirect()->to('/')->with($notification);

    }
    ///--order place--//


}
