<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //--user role index--//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch users with admin roles
            $data = DB::table('users')->where('is_admin', 1)->where('role_admin', 1)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_role', function ($row) {
                    $roles = [];
                    if ($row->category == 1) $roles[] = '<span class="badge badge-success">Category</span>';
                    if ($row->product == 1) $roles[] = '<span class="badge badge-success">Product</span>';
                    if ($row->blog == 1) $roles[] = '<span class="badge badge-success">Blog</span>';
                    if ($row->offer == 1) $roles[] = '<span class="badge badge-success">Offer</span>';
                    if ($row->order == 1) $roles[] = '<span class="badge badge-success">Order</span>';
                    if ($row->report == 1) $roles[] = '<span class="badge badge-success">Report</span>';
                    if ($row->ticket == 1) $roles[] = '<span class="badge badge-success">Ticket</span>';
                    if ($row->userrole == 1) $roles[] = '<span class="badge badge-success">User Role</span>';
                    if ($row->setting == 1) $roles[] = '<span class="badge badge-success">Setting</span>';
                    if ($row->pickup == 1) $roles[] = '<span class="badge badge-success">Pickup Point</span>';
                    if ($row->contact == 1) $roles[] = '<span class="badge badge-success">Contact</span>';

                    return !empty($roles) ? implode(', ', $roles) : 'No Role Assigned';
                })
                ->addColumn('action', function ($row) {
                    // Action buttons
                    $actionbtn = '<a href="' . route('role.edit', [$row->id]) . '" class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a>

                    <a href="' . route('role.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'user_role'])
                ->make(true);
        }

        return view('admin.user_role.index');
    }

    //--user role index--//


    //--user role store--//
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->category = $request->category;
        $user->product = $request->product;
        $user->offer = $request->offer;
        $user->order = $request->order;
        $user->blog = $request->blog;
        $user->pickup = $request->pickup;
        $user->ticket = $request->ticket;
        $user->contact = $request->contact;
        $user->report = $request->report;
        $user->setting = $request->setting;
        $user->userrole = $request->userrole;
        $user->is_admin = 1;
        $user->role_admin = 1;
        // dd($user);
        // return $user;
        $user->save();
        return response()->json('User Role Added Successfully');
    }
    //--user role store--//


    //--user role edit--//
    public function edit($id){
        $role = User::find($id);
        return view('admin.user_role.edit',compact('role'));
    }
    //--user role edit--//


    //--user role update--//
    public function update(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users,email,'.$request->id,
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->category = $request->category;
        $user->product = $request->product;
        $user->offer = $request->offer;
        $user->order = $request->order;
        $user->blog = $request->blog;
        $user->pickup = $request->pickup;
        $user->ticket = $request->ticket;
        $user->contact = $request->contact;
        $user->report = $request->report;
        $user->setting = $request->setting;
        $user->userrole = $request->userrole;
        $user->save();
        // return response()->json('User Role Updated Successfully');
        $notification = array('message' => 'User Role Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('role.index')->with($notification);
    }
    //--user role update--//


    //--user role destroy--//
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        // return response()->json('User Role Deleted Successfully');
        $notification = array('message' => 'User Role Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //--user role destroy--//

}
