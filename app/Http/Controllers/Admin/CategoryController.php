<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\Facades\Image;

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

            $slug = Str::slug($request->category_name, '-');

            $category = new Category();
            $category->category_name = $request->category_name;
            $category->home_page = $request->home_page;
            $category->category_slug = Str::slug($request->category_name, '-');

            $photo = $request->icon;

            if ($photo) {
                $photoname = $slug . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(32, 32)->save('public/files/icon/' . $photoname);
                $category->icon = 'public/files/icon/' . $photoname;

                $category->save();
            }

            $category->save();
            $notification = array('message' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    //__category store__//

    //__category edit form__//
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.category.edit', compact('category'));
        // return response()->json($category);
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
                'category_name' => 'required|unique:categories,category_name,'.$request->id,
            ]);

            $category = Category::find($request->id);

            $newSlug = Str::slug($request->category_name, '-');

            if ($category->category_name != $request->category_name) {
                if ($category->icon && file_exists($category->icon)) {
                    $oldImagePath = $category->icon;
                    $newImagePath = ('public/files/icon/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION));

                    rename($oldImagePath, $newImagePath);

                    $category->icon = 'public/files/icon/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION);
                }
            }

            $category->category_name = $request->category_name;
            $category->home_page = $request->home_page;
            $category->category_slug = Str::slug($request->category_name, '-');

            $photo = $request->file('icon');
            if ($photo) {
                    if ($category->icon && file_exists($category->icon)) {
                        unlink($category->icon);
                    }
                    $photoname = $newSlug . '.' . $photo->getClientOriginalExtension();
                    Image::make($photo)->resize(32, 32)->save('public/files/icon/' . $photoname);
                    $category->icon = 'public/files/icon/' . $photoname;
            }


            $category->save();
            $notification = array('message' => 'Category Updated Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
    }
    //__update data__//

    //__category delete__//
    public function destroy($id)
    {
        $category = Category::find($id);
        $image = $category->icon;
        if ($image && file_exists($image)) {
            unlink($image);
        }
        $category->delete();
        $notification = array('message' => 'Category Deleted Successfully', 'alert-type' => '
        success');
        return redirect()->back()->with($notification);
    }
    //__category delete__//
}
