<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_slug',
        'icon',
        'home_page',
        ];

        public function subcategory(){
            return $this->hasMany(Subcategory::class);
        }

        public function childcategory(){
            return $this->hasMany(Childcategory::class);
        }

        public function product(){
            return $this->hasMany(Product::class);
        }
}
