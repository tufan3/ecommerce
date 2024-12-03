<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'shipping_name', 'shipping_address', 'shipping_phone', 'shipping_email', 'shipping_country','shipping_city', 'shipping_zipcode','shipping_status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
