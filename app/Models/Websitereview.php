<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websitereview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'review', 'rating', 'review_date', 'name', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
