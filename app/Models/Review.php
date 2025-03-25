<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    public $incrementing = true;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'product_id');
    }
}
