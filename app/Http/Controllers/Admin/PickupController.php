<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pickup_point;
use Illuminate\Http\Request;
use DB;
use DataTables;
class PickupController extends Controller
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
            $pickup_point = Pickup_point::latest()->get();

            return DataTables::of($pickup_point)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="' . route('pickuppoint.delete', [$row->id]) . '" id="delete_row_data" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pickup_point.index');
    }
    //__ coupon index__//

    //__ pickup point store__//
    public function store(Request $request)
    {
        $request->validate([
            'pickup_point_name' => 'required|unique:pickup_points',
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required',
        // ], [
        //     'coupon_code.unique' => 'This coupon code already exists.', // Custom message for unique rule
        ]);
            $pickup_point = new Pickup_point();
            $pickup_point->pickup_point_name = $request->pickup_point_name;
            $pickup_point->pickup_point_address = $request->pickup_point_address;
            $pickup_point->pickup_point_phone = $request->pickup_point_phone;
            $pickup_point->pickup_point_phone_two = $request->pickup_point_phone_two;

            $pickup_point->save();
            return response()->json('created successfully.');
        }
    //__ pickup point store__//


    //__ pickup point edit__//
    public function edit($id)
    {
        $pickup_point = Pickup_point::find($id);
        return view('admin.pickup_point.edit', compact('pickup_point'));
    }
    //__ pickup point edit__//


    //__ pickup point update__//
    public function update(Request $request)
    {
        $request->validate([
            'pickup_point_name' => 'required|unique:pickup_points,pickup_point_name,'.$request->id,
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required',
            // ], [
            //     'coupon_code.unique' => 'This coupon code already exists.', // Custom message for
            ]);
            $pickup_point = Pickup_point::find($request->id);
            $pickup_point->pickup_point_name = $request->pickup_point_name;
            $pickup_point->pickup_point_address = $request->pickup_point_address;
            $pickup_point->pickup_point_phone = $request->pickup_point_phone;
            $pickup_point->pickup_point_phone_two = $request->pickup_point_phone_two;
            $pickup_point->save();
            return response()->json('updated successfully.');
        }
    //__ pickup point update__//

    //__coupon delete__//
    public function destroy($id)
    {
        $coupon = Pickup_point::find($id);
        $coupon->delete();
        return response()->json('Deleted Successfully!');
        // $notification = array('message' => 'Coupon Deleted Successfully', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);
    }
    //__coupon delete__//
}
