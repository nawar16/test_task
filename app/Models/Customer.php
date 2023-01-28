<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'country',
        'phone',
        'created_at',
        'updated_at'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
