<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\OrderItem;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'unit_price',
        'supplier_id',
        'created_at',
        'updated_at'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class , "supplier_id");
    }
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
