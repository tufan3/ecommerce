<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use DataTables;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index
    public function index(Request $request)
    {

        //__qurild bulder with yajra data table__//
        if($request->ajax()){
            $data = DB::table('childcategories')->join('categories','childcategories.category_id','categories.id')->join('subcategories','childcategories.subcategory_id','subcategories.id')->select('childcategories.*', 'categories.category_name','subcategories.subcategory_name')->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="'.route('brand.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                return $actionbtn;

            })
            ->rawColumns(['action'])
            ->make(true);
        }
         //__qurild bulder with yajra data table__//

         //__model data with yajra data table__//
        //  if($request->ajax()){
        //     $data = ChildCategory::with('category', 'subcategory')->select(['*']);
        //     return DataTables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('category_name', function($row) {
        //         return $row->category->category_name ?? ''; // Access category name
        //     })
        //     ->addColumn('subcategory_name', function($row) {
        //         return $row->subcategory->subcategory_name ?? ''; // Access subcategory name
        //     })
        //     ->addColumn('action', function($row){
        //         $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

        //         <a href="#" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
        //         return $actionbtn;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);
        // }
         //__model data with yajra data table__//


         $category = Category::all();
        return view('admin.category.childcategory.index', compact('category'));
    }


    //__child category store__//
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'childcategory_name' => 'required|unique:childcategories|max:200',
            ]);

            $category_id = Subcategory::where('id',$request->subcategory_id)->first()->category_id;

            $childcategory = new Childcategory();
            $childcategory->category_id = $category_id;
            $childcategory->subcategory_id = $request->subcategory_id;
            $childcategory->childcategory_name = $request->childcategory_name;
            $childcategory->childcategory_slug = Str::slug($request->childcategory_name, '-');
            $childcategory->save();
            $notification = array('message' => 'child-category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);

        }
    //__child category store__//

    //__child category edit form__//
    public function edit($id)
    {
        $childcategory = Childcategory::find($id);
        $category = Category::all();
        // return response()->json($subcategory);
        return view('admin.category.childcategory.edit', compact('childcategory','category'));
    }
    //__child category edit form__//


    //__child category update__//
    public function update(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'childcategory_name' => 'required|max:200',
            ]);
            $category_id = Subcategory::where('id',$request->subcategory_id)->first()->category_id;
            $childcategory = Childcategory::find($request->id);
            $childcategory->category_id = $category_id;
            $childcategory->subcategory_id = $request->subcategory_id;
            $childcategory->childcategory_name = $request->childcategory_name;
            $childcategory->childcategory_slug = Str::slug($request->childcategory_name, '-');
            $childcategory->save();
            $notification = array('message' => 'Child-category Update Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
    }
    //__child category update__//

     //__child category delete__//
     public function destroy($id)
     {
         $subcategory = Childcategory::find($id);
         $subcategory->delete();
         $notification = array('message' => 'child-category Deleted Successfully', 'alert-type' => '
         success');
         return redirect()->back()->with($notification);
     }
     //__child category delete__//
}
