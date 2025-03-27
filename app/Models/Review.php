<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    // Mối quan hệ: Một đánh giá thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ: Một đánh giá thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
