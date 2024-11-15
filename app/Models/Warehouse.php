<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'pickup_point_name', 'pickup_point_address', 'pickup_point_phone','pickup_point_phone_two',
    ];


    public function product(){
        return $this->hasMany(Product::class);
    }
}
