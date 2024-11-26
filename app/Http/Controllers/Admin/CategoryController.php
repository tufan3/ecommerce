<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__category index__//
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category.index', compact('categories'));
    }

    //__category store__//
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:100',
            ]);
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->home_page = $request->home_page;
            $category->category_slug = Str::slug($request->category_name, '-');
            $category->save();
            $notification = array('message' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    //__category store__//

    //__category edit form__//
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    //__category edit form__//

    //__update data__//
    public function update(Request $request)
    {
        // /query builder update
        // $category = array();
        // $category['category_name'] = $request->category_name;
        // $category['category_slug'] = Str::slug($request->category_name, '-');
        // DB::table('categories')->wheres('id', $request->id)->update($category);

          //__ multi codition in query builder
        // $updated = DB::table('categories')
        //     ->where('id', $request->id)
        //     ->where('category_name', $request->category_name)
        //     ->update($categoryData);

           //__ multi condition use in eloquent orm
        // $category = Category::where('id', $request->id)
        //     ->where('category_name', $request->category_name)
        //     ->first();


            $request->validate([
            'category_name' => 'required|max:100',
            ]);
            $category = Category::find($request->id);
            $category->category_name = $request->category_name;
            $category->home_page = $request->home_page;
            $category->category_slug = Str::slug($request->category_name, '-');
            $category->save();
            $notification = array('message' => 'Category Updated Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
    }
    //__update data__//

    //__category delete__//
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        $notification = array('message' => 'Category Deleted Successfully', 'alert-type' => '
        success');
        return redirect()->back()->with($notification);
    }
    //__category delete__//
}
