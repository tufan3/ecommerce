<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Models\Childcategory;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_slug',
        ];

        public function subcategory(){
            return $this->hasMany(Subcategory::class);
        }

        public function childcategory(){
            return $this->hasMany(Childcategory::class);
        }
}
