<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItem::insert([
            [
                'order_id' => 1,
                'product_id' => 4,
                'unit_price' => 500,
                'quantity' => 2
            ],
            [
                'order_id' => 2,
                'product_id' => 3,
                'unit_price' => 300,
                'quantity' => 1
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'unit_price' => 300,
                'quantity' => 1
            ],
        ]);
    }
}
