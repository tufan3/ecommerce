<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use DB;
use DataTables;

use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__brand index
    public function index(Request $request)
    {

        //__qurild bulder with yajra data table__//
        if ($request->ajax()) {
            $data = DB::table('brands')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

                <a href="' . route('brand.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //__qurild bulder with yajra data table__//

        //__model data with yajra data table__//
        //  if($request->ajax()){
        //     $data = brand::with('category', 'subcategory')->select(['*']);
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


        return view('admin.category.brand.index');
    }
    //__brand index

    //__brand store__//
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:200',
        ]);

        $slug = Str::slug($request->brand_name, '-');

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $slug;
        $photo = $request->brand_logo;

        if ($photo) {
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            // $photo->move('public/files/brand/', $photoname); //without image intervention
            Image::make($photo)->resize(600, 400)->save('public/files/brand/' . $photoname);
            $brand->brand_logo = 'public/files/brand/' . $photoname;

            $brand->save();
        }

        $brand->save();
        $notification = array('message' => 'Brand Added Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__brand store__//


    //__brand edit form__//
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.category.brand.edit', compact('brand'));
    }
    //__brand edit form__//

    //__brand update__//
    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:200',
        ]);

        $brand = Brand::find($request->id);


        $newSlug = Str::slug($request->brand_name, '-');

        if ($brand->brand_name != $request->brand_name) {
            if ($brand->brand_logo && file_exists($brand->brand_logo)) {
                $oldImagePath = $brand->brand_logo;
                $newImagePath = ('public/files/brand/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION));

                rename($oldImagePath, $newImagePath);

                $brand->brand_logo = 'public/files/brand/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION);
            }
        }
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $newSlug;

        $photo = $request->file('brand_logo');
        if ($photo) {
            if ($brand->brand_logo && file_exists($brand->brand_logo)) {
                unlink($brand->brand_logo);
            }
            $photoname = $newSlug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 400)->save('public/files/brand/' . $photoname);
            $brand->brand_logo = 'public/files/brand/' . $photoname;
        }
        $brand->save();
        $notification = array('message' => 'brand updated successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__brand update__//

    //__brand delete__//
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $image = $brand->brand_logo;
        if ($image && file_exists($image)) {
            unlink($image);
        }
        $brand->delete();
        $notification = array('message' => 'Brand Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__brand delete__//

}
