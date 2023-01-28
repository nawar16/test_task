<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'order_number',
        'customer_id',
        'total_amount',
        'created_at',
        'updated_at'
    ];

    public static function boot() {
        parent::boot();
        static::deleting(function($order) { 
             $order->order_items()->delete();
        });
    }
    public function customer(){
        return $this->belongsTo(Customer::class , "customer_id");
    }
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
