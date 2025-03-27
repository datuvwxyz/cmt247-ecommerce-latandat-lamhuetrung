<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Mối quan hệ: Một giỏ hàng thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ: Một giỏ hàng có thể có nhiều mặt hàng
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
