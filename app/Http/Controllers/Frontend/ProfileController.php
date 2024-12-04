<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shipping;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__user profile
    public function customerSetting() {
        $shipping = Shipping::where('user_id', Auth::user()->id)->first();
        return view('user.setting', compact('shipping'));
    }


    //__ change password--//
    public function customerPasswordChange(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
            $user = User::findOrFail(Auth::id());
            $old_password = $request->old_password;
            $new_password = $request->password;
            if (Hash::check($old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                $notification = array('message' => 'Password updated successfully', 'alert-type' => 'success');
                return redirect()->to('/')->with($notification);
            } else {
                $notification = array('message' => 'Old password not match', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
    }
    //--change password--//


    //--- shipping information in customer---//
    public function customerShippingDetails(Request $request) {
        // $request->validate([
        //     'shipping_name' => 'string|max:255',
        //     'shipping_email' => 'email|max:255',
        //     'shipping_phone' => 'string|max:20',
        //     'shipping_address' => 'string',
        //     'shipping_country' => 'string|max:100',
        //     'shipping_city' => 'string|max:100',
        //     'shipping_zipcode' => 'string|max:20',
        // ]);

        $check = Shipping::where('user_id', Auth::user()->id)->first();
        if ($check) {
            $shipping = Shipping::where('user_id', Auth::user()->id)->update
            (array('shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'shipping_city' => $request->shipping_city,
            'shipping_zipcode' => $request->shipping_zipcode));

            return response()->json('Shipping information saved successfully!');
        } else{
            $shipping = new Shipping();
            $shipping->user_id = Auth::user()->id;
            $shipping->shipping_name = $request->shipping_name;
            $shipping->shipping_email = $request->shipping_email;
            $shipping->shipping_phone = $request->shipping_phone;
            $shipping->shipping_address = $request->shipping_address;
            $shipping->shipping_country = $request->shipping_country;
            $shipping->shipping_city = $request->shipping_city;
            $shipping->shipping_zipcode = $request->shipping_zipcode;
            $shipping->save();

            return response()->json('Shipping information saved successfully!');
        }
    }
    //--- shipping information in customer---//
}
