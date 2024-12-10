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
        $user = Auth::user();
        if($request->payment_type == 'Cash On Delivery'){
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
            $order['status'] = 'pending';
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

    //--aamarpay payment gateway--//
        }elseif($request->payment_type == 'Aamarpay'){

            $aamarpay = DB::table('payment_gateway_bd')->first();
            if($aamarpay->store_id == null){
                $notification = array('message' => 'Please setting your payment gateway!', 'alert-type' =>'error');
            return redirect()->back()->with($notification);

            }else{
                if($aamarpay->status == 1){
                    $url = "https://secure.aamarpay.com/jsonpost.php";
                }else{
                    $url = "https://​sandbox​.aamarpay.com/jsonpost.php";
                }


                if(Session::has('coupon')){
                    // $amount = Cart::total();
                    $amount = Session::get('coupon')['after_discount'];
                }else{
                    $amount = Cart::total();
                }

                $tran_id = "test".rand(1111111,9999999);

                $currency= "BDT";



                //For live Store Id & Signature Key please mail to support@aamarpay.com
                $store_id = $aamarpay->store_id;
                // $store_id = "aamarpaytest";

                $signature_key = $aamarpay->signature_key;
                // $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";


                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.$amount.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$signature_key.'",
                    "desc": "Merchant Product Payment",
                    "cus_name": "'.$shipping_details->shipping_name.'",
                    "cus_email": "'.$shipping_details->shipping_email.'",
                    "cus_add1": "'.$shipping_details->shipping_address.'",
                    "cus_add2": "Mohakhali DOHS",
                    "cus_city": "'.$shipping_details->shipping_city.'",
                    "cus_state": "'.$shipping_details->shipping_city.'",
                    "cus_postcode": "'.$shipping_details->shipping_zipcode.'",
                    "cus_country": "'.$shipping_details->shipping_country.'",
                    "cus_phone": "'.$shipping_details->shipping_phone.'",
                    "opt_a": "'.$request->shipping_id.'",
                    "opt_b": "'.$shipping_details->shipping_zipcode.'",
                    "opt_c": "'.$request->payment_type.'",
                    "opt_d": "Not-Available",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // dd($response);

                $responseObj = json_decode($response);

                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);

                }else{
                    echo $response;
                }
            }

        }


    }
    ///--order place--//



    //--payment gateway--//

    public function success(Request $request){
        $aamarpay = DB::table('payment_gateway_bd')->first();

        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=$aamarpay->store_id&signature_key=$aamarpay->signature_key&type=json";

        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        // echo $response;

        $data = json_decode($response, true);
        // $opt_b = $data['opt_c'];
        // echo "The value of opt_b is: " . $opt_b;

        $order_number = rand(10000,9000000);
        $user = Auth::user();

        $order = array();
            $order['user_id'] = $user->id;
            $order['shipping_id'] = $data['opt_a'];
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
            $order['payment_type'] = $data['opt_c'];
            $order['tax'] = 0;
            $order['shipping_cost'] = 0;
            $order['order_number'] = $order_number;
            $order['status'] = 'received';
            $order['date'] = date('d-m-Y');
            $order['month'] = date('F');
            $order['year'] = date('Y');

            $order_id = DB::table('orders')->insertGetId($order);


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

                DB::table('orderdetails')->insert($order_detail);
                $order_details[] = $order_detail;
            }

            Mail::to($data['cus_email'])->send(new InvoiceMail($order, $order_details));

            Mail::to($data['cus_email'])->cc($user->email)->send(new InvoiceMail($order, $order_details));



            Cart::destroy();
            if(Session::has('coupon')){
                Session::forget('coupon');
            }

            return view('frontend.cart.success', [
                'amount' => $data['amount'], // Payment amount
                'transaction_id' => $data['mer_txnid'], // Transaction ID
            ]);
            // $notification = array('message' => 'Order place successfully!', 'alert-type' =>'success');
            // return redirect()->route('home')->with($notification);
    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }
    //--payment gateway--//

}
