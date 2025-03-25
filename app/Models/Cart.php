<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    public $incrementing = true;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
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
