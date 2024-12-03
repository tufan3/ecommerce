<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__ admin after login__//
    public function admin()
    {
        return view('admin.home');
    }

    //__admin custom logout__/
    public function logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are log out', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }

    //__password change__//
    public function password_change()
    {
        return view('admin.profile.password_change');
    }
    //__password change__//

    //__update password__//
    public function password_update(Request $request)
    {
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
                return redirect()->route('admin.login')->with($notification);
            } else {
                    $notification = array('message' => 'Old password not match', 'alert-type' => 'error');
                    return redirect()->back()->with($notification);
            }
    }

    //__update password__//

}
