<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
        ];

        public function childcategory(){
            return $this->hasMany(Childcategory::class);
        }
        public function category(){
            return $this->belongsTo(Category::class,'category_id');
        }

        public function product(){
            return $this->hasMany(Product::class);
        }
}
