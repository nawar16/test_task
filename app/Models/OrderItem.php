<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'unit_price',
        'quantity',
        'created_at',
        'updated_at'
    ];
    
    public function order(){
        return $this->belongsTo(Order::class , "order_id");
    }

    public function product(){
        return $this->belongsTo(Product::class , "product_id");
    }
}
