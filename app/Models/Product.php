<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'sku', 'barcode', 'unit', 'brand_id', 'category_id', 'price', 'quantity', 'image', 'short_description', 'detailed_description'];

    // Mối quan hệ: Một sản phẩm thuộc về một thương hiệu
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Mối quan hệ: Một sản phẩm thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Mối quan hệ: Một sản phẩm có thể có nhiều đánh giá
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Mối quan hệ: Một sản phẩm có thể có nhiều mặt hàng trong giỏ hàng
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Mối quan hệ: Một sản phẩm có thể có nhiều mặt hàng trong đơn hàng
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

