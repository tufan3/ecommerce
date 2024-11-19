<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use App\Models\Pickup_point;
use App\Models\Warehouse;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'subcategory_id', 'childcategory_id', 'pickup_point_id', 'brand_id', 'product_name', 'product_code', 'product_unit', 'product_tags', 'color', 'size', 'product_video', 'product_image', 'product_thumbnail', 'description', 'purchase_price', 'selling_price', 'discount_price', 'stock_quantity', 'warehouse', 'featured', 'today_deal', 'status', 'admin_id','product_slider',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function childcategory(){
        return $this->belongsTo(Childcategory::class,'childcategory_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function pickup_point(){
        return $this->belongsTo(Pickup_point::class,'pickup_point_id');
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse');
    }

}
