<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__ coupon index__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('warehouses')->get();
            $coupon = Coupon::latest()->get();

            return DataTables::of($coupon)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="' . route('coupon.delete', [$row->id]) . '" id="delete_coupon" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.offer.coupon.index');
    }
    //__ coupon index__//
    //__ coupon store//
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons',
            'coupon_amount' => 'required',
            'type' => 'required',
            'valid_date' => 'required',
            'status' => 'required',
        // ], [
        //     'coupon_code.unique' => 'This coupon code already exists.', // Custom message for unique rule
        ]);
            $coupon = new Coupon();
            $coupon->coupon_code = $request->coupon_code;
            $coupon->coupon_amount = $request->coupon_amount;
            $coupon->type = $request->type;
            $coupon->valid_date = $request->valid_date;
            $coupon->status = $request->status;

            $coupon->save();
            return response()->json('Coupon created successfully.');
        }
    //__ coupon store//
    //__ coupon edit//
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.offer.coupon.edit',compact('coupon'));
    }
    //__ coupon edit//


    //__ coupon update//
    public function update(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons,coupon_code,' . $request->id,
        ], [
            'coupon_code.unique' => 'This coupon code already exists.',
        ]);

            $coupon = Coupon::find($request->id);
            $coupon->coupon_code = $request->coupon_code;
            $coupon->coupon_amount = $request->coupon_amount;
            $coupon->type = $request->type;
            $coupon->valid_date = $request->valid_date;
            $coupon->status = $request->status;
            $coupon->save();
            return response()->json('Coupon updated successfully.');
        }
    //__ coupon update//


    //__coupon delete__//
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json('Coupon deleted!');
        // $notification = array('message' => 'Coupon Deleted Successfully', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
    }
    //__coupon delete__//
}
