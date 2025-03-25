<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    protected $fillable = [
        'name',
        'sku',
        'barcode',
        'unit',
        'brand_id',
        'category_id',
        'price',
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class, 'brand_id', 'brand_id');
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_id', 'category_id');
    }
}
