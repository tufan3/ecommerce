<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderDeleteMail;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //---order index---//
    public function index(Request $request){
        if ($request->ajax()) {
            // $image_url = 'public/files/product';
            // $product = Product::all();

            $order = "";
            $sql = DB::table('orders')->leftJoin('users','orders.user_id','users.id')->leftJoin('shippings','orders.shipping_id','shippings.id')->orderBy('id', 'DESC');

            if($request->date){
                $order_date = date('d-m-Y', strtotime($request->date));
                $sql->where('orders.date',$order_date);
            }

            if($request->status == 'pending'){
                $sql->where('status','pending');
            }elseif($request->status == 'received'){
                $sql->where('status','received');
            }elseif($request->status == 'shipped'){
                $sql->where('status','shipped');
            }elseif($request->status == 'completed'){
                $sql->where('status','completed');
            }elseif($request->status == 'return'){
                $sql->where('status','return');
            }elseif($request->status == 'cancelled'){
                $sql->where('status','cancelled');
            }elseif($request->status == 'all'){
            }


            $order = $sql->select('orders.*','users.name','shippings.shipping_name','shippings.shipping_phone','shippings.shipping_email')->get();

            return DataTables::of($order)
                ->addIndexColumn()
                ->editColumn('total', function ($row)  {
                    if($row->after_discount == null){
                        return $row->total;
                    }else{
                        return $row->after_discount;
                    }
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'pending') {
                        return '<span class="badge badge-warning">Pending</span>';
                    } elseif ($row->status =='received') {
                        return '<span class="badge badge-info">Received</span>';
                    } elseif ($row->status =='shipped') {
                        return '<span class="badge badge-primary">Shipped</span>';
                    } elseif ($row->status =='completed') {
                        return '<span class="badge badge-success">Completed</span>';
                    } elseif ($row->status =='return') {
                        return '<span class="badge badge-danger">Return</span>';
                    } elseif ($row->status =='cancelled') {
                        return '<span class="badge badge-danger">Cancelled</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-primary btn-sm view" data-id="' . $row->id . '" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></a>

                    <a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                    <a href="' . route('admin.order.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status','total'])
                ->make(true);
        }

        return view('admin.order.index');
    }
    //---order index---//


    //---order edit---//
    public function edit($id){
        $order = DB::table('orders')->where('id', $id)->first();
        return view('admin.order.edit',compact('order'));
    }
    //---order edit---//


    //---order update---//
    public function update(Request $request){
        $request->validate([
           'status' =>'required',
        ]);

        $data = array();
        $data['status'] = $request->status;
        DB::table('orders')->where('id', $request->id)->update($data);
        return response()->json('Status updated successfully.');
    }
    //---order update---//


    //---order view---//
    public function orderShow($id){
        $order = DB::table('orders')->leftJoin('users','orders.user_id','users.id')->leftJoin('shippings','orders.shipping_id','shippings.id')->select('orders.*','shippings.*','users.name','users.phone','users.email')->where('orders.id',$id)->first();

        $order_details = DB::table('orderdetails')->leftJoin('products', 'orderdetails.product_id','products.id')->select('orderdetails.*','products.product_name','products.product_thumbnail')->where('orderdetails.order_id', $id)->get();

        return view('admin.order.show',compact('order','order_details'));
    }
    //---order view---//


    //---order Destroy---//
    public function orderDestroy($id){
        $order = DB::table('orders')->leftJoin('shippings','orders.shipping_id','shippings.id')->select('orders.order_number','shippings.shipping_name','shippings.shipping_email')->where('orders.id',$id)->first();

        Mail::to($order->shipping_email)->send(new OrderDeleteMail($order));

        DB::table('orders')->where('id', $id)->delete();

        $notification = array('message' => 'Order deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //---order Destroy---//



}
