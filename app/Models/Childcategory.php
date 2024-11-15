<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class Childcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_name',
        'childcategory_slug',
        ];
        public function category(){
            return $this->belongsTo(Category::class);
        }
        public function subcategory(){
            return $this->belongsTo(Subcategory::class);
        }

        public function product(){
            return $this->hasMany(Product::class);
        }
}
