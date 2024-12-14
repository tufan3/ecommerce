<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Pickup_point;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getChildCategories($id)
    {
        $childcategory = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($childcategory);
    }

    //__product index__//
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $image_url = 'public/files/product';
            // $product = Product::all();

            $product = "";
            $sql = DB::table('products')->leftJoin('categories','products.category_id','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
            ->leftJoin('brands','products.brand_id','brands.id')
            ->leftJoin('warehouses','products.warehouse','warehouses.id');

            if($request->category_id){
                $sql->where('products.category_id',$request->category_id);
            }
            if($request->brand_id){
                $sql->where('products.brand_id',$request->brand_id);
            }
            if($request->warehouse_id){
                $sql->where('products.warehouse',$request->warehouse_id);
            }
            if ($request->sort_by_price) {
                $sortOrder = $request->sort_by_price === 'hl' ? 'desc' : 'asc';
                $sql->orderBy('products.selling_price', $sortOrder);
            }


            $product = $sql->select('products.*','categories.category_name','brands.brand_name','warehouses.warehouse_name','subcategories.subcategory_name')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                // ->editColumn('category_name', function ($row) {
                //     return $row->category->category_name;
                // })
                // ->editColumn('subcategory_name', function ($row) {
                //     return $row->subcategory->subcategory_name;
                // })
                // ->editColumn('brand_name', function ($row) {
                //     return $row->brand->brand_name;
                // })
                ->editColumn('product_thumbnail', function ($row) use ($image_url) {
                    return '<img src="' . asset($image_url . '/' . $row->product_thumbnail) . '" style="width: 50px; height: 60px">';
                })

                ->editColumn('featured', function ($row) {
                    $checked = $row->featured == 1 ? 'checked' : '';
                    return '<label class="switch">
                                <input type="checkbox" ' . $checked . ' onclick="getFeatured(' . $row->id . ')">
                                <span class="slider round"></span>
                            </label>';
                })
                ->editColumn('today_deal', function ($row) {
                    $checked = $row->today_deal == 1 ? 'checked' : '';
                    return '<label class="switch">
                                <input type="checkbox" ' . $checked . ' onclick="getTodayDeal(' . $row->id . ')">
                                <span class="slider round"></span>
                            </label>';
                })
                ->editColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<label class="switch">
                                <input type="checkbox" ' . $checked . ' onclick="getStatus(' . $row->id . ')">
                                <span class="slider round"></span>
                            </label>';
                })

                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-primary btn-sm view" ><i class="fas fa-eye"></i></a>

                    <a href="' . route('product.edit', [$row->id]) . '" class="btn btn-info btn-sm" ><i class="fas fa-edit"></i></a>

                    <a href="' . route('product.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'product_thumbnail', 'featured', 'today_deal', 'status'])
                ->make(true);
        }

        $category = Category::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();
        return view('admin.product.index',compact('category','brand','warehouse'));
    }
    //__product index__//

    //__product create page__//
    public function create()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $childcategory = DB::table('childcategories')->get();
        $brand = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_points')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.create', compact('category', 'brand', 'pickup_point', 'warehouse'));
    }
    //__product create page__//


    //__product store__//
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required|unique:products',
            'subcategory_id' => 'required',
            'product_unit' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
            'color' => 'required',
            'status' => 'required',
        ]);
        $category_id = DB::table('subcategories')->where('id', $request->subcategory_id)->first()->category_id;

        $slug = Str::slug($request->product_name, '-');

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->subcategory_id = $request->subcategory_id;
        $product->category_id = $category_id;
        $product->brand_id = $request->brand_id;
        $product->product_unit = $request->product_unit;
        $product->product_code = $request->product_code;
        $product->childcategory_id = $request->childcategory_id;
        $product->pickup_point_id = $request->pickup_point_id;
        $product->product_tags = $request->product_tags;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->warehouse = $request->warehouse;
        $product->color = $request->color;
        $product->stock_quantity = $request->stock_quantity;
        $product->size = $request->size;
        $product->description = $request->description;
        $product->cash_on_delivery = $request->cash_on_delivery;
        $product->featured = $request->featured;
        $product->today_deal = $request->today_deal;
        $product->product_video = $request->product_video;
        $product->status = $request->status;
        $product->product_slider = $request->product_slider;
        $product->product_trendy = $request->product_trendy;
        $product->user_id = auth()->user()->id;
        $product->date = date('d-m-Y');
        $product->month = date('F');
        $product->product_slug = Str::slug($request->product_name, '-');

        // $product->product_image = $request->product_image;

        $thumbnail_photo = $request->product_thumbnail;

        // single thumbnail
        if ($thumbnail_photo) {
            $thumbnail_name = $slug . '.' . $thumbnail_photo->getClientOriginalExtension();
            Image::make($thumbnail_photo)->resize(600, 600)->save('public/files/product/' . $thumbnail_name);
            $product->product_thumbnail = $thumbnail_name;
        }

        // multiple image
        $product_images = array();
        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $key => $image) {
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('public/files/product/' . $image_name);
                array_push($product_images, $image_name);
            }
            $product->product_image = json_encode($product_images);
        }

        $product->save();
        $notification = array('message' => 'Added Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
        // return redirect()->route('product.index')->with('success', 'Product created successfully');
    }
    //__product store__//


    //__product edit__//
    public function edit($id)
    {

        $product = Product::find($id);
        $category = Category::all();
        $brand = Brand::all();
        $warehouse = Warehouse::all();
        $pickup_point = Pickup_point::all();
        $childcategory = DB::table('childcategories')->where('category_id',$product->category_id)->get();
        return view('admin.product.edit', compact('product','category','brand', 'warehouse','pickup_point','childcategory'));
    }
    //__product edit__//


    //__product update__//
    public function update(Request $request){
        $request->validate([
            'product_name' =>'required',
            'product_code' =>'required|unique:products,product_code,'. $request->id,
            'subcategory_id' =>'required',
            'product_unit' =>'required',
            'selling_price' =>'required',
            'description' =>'required',
            'color' =>'required',
        ]);

        $category_id = DB::table('subcategories')->where('id', $request->subcategory_id)->first()->category_id;

        $newSlug = Str::slug($request->product_name, '-');

        $product = Product::find($request->id);

        if ($product->product_name != $request->product_name) {
            if ($product->product_thumbnail && file_exists('public/files/product/' . $product->product_thumbnail)) {
                $oldImagePath = 'public/files/product/' . $product->product_thumbnail;
                $newImagePath = ('public/files/product/' . $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION));

                rename($oldImagePath, $newImagePath);

                $product->product_thumbnail = $newSlug . '.' . pathinfo($oldImagePath, PATHINFO_EXTENSION);
            }
        }

        $product->product_name = $request->product_name;
        $product->subcategory_id = $request->subcategory_id;
        $product->category_id = $category_id;
        $product->brand_id = $request->brand_id;
        $product->product_unit = $request->product_unit;
        $product->product_code = $request->product_code;
        $product->childcategory_id = $request->childcategory_id;
        $product->pickup_point_id = $request->pickup_point_id;
        $product->product_tags = $request->product_tags;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->warehouse = $request->warehouse;
        $product->color = $request->color;
        $product->stock_quantity = $request->stock_quantity;
        $product->size = $request->size;
        $product->description = $request->description;
        $product->cash_on_delivery = $request->cash_on_delivery;
        $product->featured = $request->featured;
        $product->today_deal = $request->today_deal;
        $product->product_video = $request->product_video;
        $product->status = $request->status;
        $product->product_slider = $request->product_slider;
        $product->product_trendy = $request->product_trendy;
        $product->user_id = auth()->user()->id;
        $product->product_slug = Str::slug($request->product_name, '-');

        $thumbnail_photo = $request->file('product_thumbnail');
        if ($thumbnail_photo) {
            if ($product->product_thumbnail && file_exists('public/files/product/' . $product->product_thumbnail)) {
                unlink('public/files/product/' . $product->product_thumbnail);
            }

            $thumbnail_name = $newSlug . '.' . $thumbnail_photo->getClientOriginalExtension();
            Image::make($thumbnail_photo)->resize(600, 600)->save('public/files/product/' . $thumbnail_name);
            $product->product_thumbnail = $thumbnail_name;
        }



        $product_images = json_decode($product->product_image, true) ?? [];

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $deletedImage) {
                $path = 'public/files/product/' . $deletedImage;
                if (file_exists($path)) {
                    unlink($path);
                }
                $product_images = array_diff($product_images, [$deletedImage]);
            }
        }

        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

                Image::make($file)->resize(600, 600)->save('public/files/product/' . $filename);

                $product_images[] = $filename;
            }
        }

        $product->product_image = json_encode(array_values($product_images));
        $product->save();

        $notification = array('message' => 'Product updated successfully', 'alert-type' => 'success');
        return redirect()->route('product.index')->with($notification);
    }
    //__product update__//



    //__product delete__//
    public function destroy($id)
    {
        $product = Product::find($id);

        $thumbnail = $product->product_thumbnail;

        $product_images = json_decode($product->product_image, true);

        $thumbnail_path = 'public/files/product/' . $thumbnail;
        if ($thumbnail && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        if (is_array($product_images)) {
            foreach ($product_images as $product_image) {
                $image_path = 'public/files/product/' . $product_image;
                if ($product_image && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $product->delete();
        $notification = array('message' => 'Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    //__product delete__//


    // this part aare today, feature, status part
    public function featured(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = !$product->featured;
        $product->save();

        return response()->json(['success' => true, 'status' => 'Featured status updated successfully!']);
    }

    public function todayDeal(Request $request)
    {
        $product = Product::find($request->id);
        $product->today_deal = !$product->today_deal;
        $product->save();

        return response()->json(['success' => true, 'status' => 'Today Deal status updated successfully!']);
    }

    public function status(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = !$product->status;
        $product->save();

        return response()->json(['success' => true, 'status' => 'Status updated successfully!']);
    }
}
