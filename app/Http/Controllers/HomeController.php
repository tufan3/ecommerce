<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::user()->is_admin == 1){
            $order = DB::table('orders')->where('user_id', Auth::user()->id)->orderBy('date', 'DESC')->get();

            //--total order--//
            $total_order = DB::table('orders')->where('user_id',Auth::user()->id)->count();
            //--total order--//

            //--complete order--//
            $complete_order = DB::table('orders')->where('user_id',Auth::user()->id)->where('status','completed')->count();
            //--complete order--//

            //--pending order--//
            // $pending_order = DB::table('orders')->where('user_id',Auth::user()->id)->where('status','pending')->count();
            //--pending order--//

            //--cancelled order--//
            $cancelled_order = DB::table('orders')->where('user_id',Auth::user()->id)->where('status','cancelled')->count();
            //--cancelled order--//

            //--return order--//
            $return_order = DB::table('orders')->where('user_id',Auth::user()->id)->where('status','return')->count();
            //--return order--//

            return view('home',compact('order','total_order','complete_order','cancelled_order','return_order'));

            // return redirect()->to('/');
        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }

}
