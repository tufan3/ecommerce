<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use DB;
use DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__ warehouse index__//
    public function index(Request $request)
    {

        //__qurild bulder with yajra data table__//
        if ($request->ajax()) {
            // $data = DB::table('warehouses')->get();
            $data = Warehouse::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="' . route('warehouse.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.warehouse.index');
    }
    //__ warehouse index__//

    //__ warehouse store__//
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required|unique:warehouses',
            ]);
        $warehouse = new Warehouse();
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->warehouse_phone = $request->warehouse_phone;
        $warehouse->warehouse_address = $request->warehouse_address;

        $warehouse->save();
        $notification = array('message' => 'Warehouse Added Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__ warehouse store__//

    //__ warehouse edit__//
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        return view('admin.category.warehouse.edit', compact('warehouse'));
    }
    //__ warehouse edit__//


    //__ warehouse update__//
    public function update(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required',
            ]);
        $warehouse = Warehouse::find($request->id);
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->warehouse_phone = $request->warehouse_phone;
        $warehouse->warehouse_address = $request->warehouse_address;
        $warehouse->save();
        $notification = array('message' => 'Warehouse Updated Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__ warehouse update__//

    //__brand delete__//
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        $notification = array('message' => 'Warehouse Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__brand delete__//
}
