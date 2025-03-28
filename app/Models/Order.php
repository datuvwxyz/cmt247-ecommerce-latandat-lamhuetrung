<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'total_price', 'status', 'address', 'phone_number'];

    // Mối quan hệ: Một đơn hàng thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ: Một đơn hàng có thể có nhiều mặt hàng
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

