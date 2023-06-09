<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','user_id','cart_id'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
