<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__user profile
    public function customerSetting(){
        // $user = Auth::user();
        return view('user.setting');
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
}
