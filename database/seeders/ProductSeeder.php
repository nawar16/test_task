<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'product_name' => 'Chai',
                'unit_price' => 150,
                'supplier_id' => 1
            ],
            [
                'product_name' => 'Rice',
                'unit_price' => 300,
                'supplier_id' => 1
            ],
            [
                'product_name' => 'Sugar',
                'unit_price' => 250,
                'supplier_id' => 2
            ],
            [
                'product_name' => 'Biscuit',
                'unit_price' => 500,
                'supplier_id' => 3
            ],
        ]);
    }
}
