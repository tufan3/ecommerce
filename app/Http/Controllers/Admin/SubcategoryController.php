<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__sub category index__//
    public function index()
    {
        // $subcategory = SubCategory::all();
        // $subcategory = DB::table('subcategories')->join('categories','subcategories.category_id','categories.id')->select('subcategories.*', 'categories.category_name')->get();
        // dd($subcategory);
        $subcategory = Subcategory::all();
        $category = Category::all();
        return view('admin.category.subcategory.index', compact('subcategory','category'));
    }

     //__sub category store__//
     public function store(Request $request)
     {
         $request->validate([
             'category_id' => 'required',
             'subcategory_name' => 'required|unique:subcategories|max:200',
             ]);
             $subcategory = new Subcategory();
             $subcategory->category_id = $request->category_id;
             $subcategory->subcategory_name = $request->subcategory_name;
             $subcategory->subcategory_slug = Str::slug($request->subcategory_name, '-');
             $subcategory->save();
             $notification = array('message' => 'Sub-category Added Successfully', 'alert-type' => 'success');
             return redirect()->back()->with($notification);
         }
     //__sub category store__//

     //__sub category edit form__//
    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        $category = Category::all();
        // return response()->json($subcategory);
        return view('admin.category.subcategory.edit', compact('subcategory','category'));
    }
    //__sub category edit form__//

    //__sub category update__//
    public function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:200',
            ]);
            $subcategory = Subcategory::find($request->id);
            $subcategory->category_id = $request->category_id;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->subcategory_slug = Str::slug($request->subcategory_name, '-');
            $subcategory->save();
            $notification = array('message' => 'Sub-category Update Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
    }
    //__sub category update__//

     //__sub category delete__//
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        $notification = array('message' => 'sub-category Deleted Successfully', 'alert-type' => '
        success');
        return redirect()->back()->with($notification);
    }
    //__sub category delete__//
}
