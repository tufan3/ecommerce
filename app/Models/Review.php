<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'review', 'rating', 'review_date', 'review_month', 'review_year',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    // public function childcategory(){
    //     return $this->belongsTo(Childcategory::class,'childcategory_id');
    // }

    // public function brand(){
    //     return $this->belongsTo(Brand::class,'brand_id');
    // }

    // public function pickup_point(){
    //     return $this->belongsTo(Pickup_point::class,'pickup_point_id');
    // }

    // public function warehouse(){
    //     return $this->belongsTo(Warehouse::class,'warehouse');
    // }
}
