<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            [
                'order_date' => \Carbon\Carbon::parse('2020-07-05'),
                'order_number' => '5',
                'customer_id' => 1,
                'total_amount' => 1000
            ],
            [
                'order_date' => \Carbon\Carbon::parse('2020-08-14'),
                'order_number' => '8',
                'customer_id' => 2,
                'total_amount' => 600
            ]
        ]);
    }
}
