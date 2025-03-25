<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }
}
