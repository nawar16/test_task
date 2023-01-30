<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_order_with_items()
    {
        $user = User::factory()->create();

        $s = Supplier::factory()->create([
            'company_name' => 'S1', 
            'contact_name' => 'SC1', 
            'city' => 'test', 
            'country' => 'test'
        ]);
        $p1 = Product::factory()->create([
            'product_name' => 'P1', 
            'unit_price'=> 250, 
            'supplier_id' => 1
        ])->make();
        $p2 = Product::factory()->create([
            'product_name' => 'P2', 
            'unit_price'=> 500, 
            'supplier_id' => 1
        ])->make();
        $c = Customer::factory()->create([
            'first_name' => 'C1', 
            'last_name' => 'C2', 
            'city' => 'test', 
            'country' => 'test', 
            'phone'=>'1234'
        ]);

        $order_response = $this->actingAs($user)->post('/api/orders', [
            'order_date' => \Carbon\Carbon::now(),
            'customer_id' => $c->id,
            'order_number' => \Str::Random(4),
            'items' => [
                [
                    'product_id' => 1,
                    'quantity' => 2
                ],
                [
                    'product_id' => 2,
                    'quantity' => 4
                ]
            ]
        ]);
        $order_response->assertStatus(201);
        $this->assertEquals(2500, $order_response->original->total_amount, "Order's total amount is correct");
    }
    public function test_update_order_with_items()
    {
        $user = User::factory()->create();

        $s = Supplier::factory()->create([
            'company_name' => 'S1', 
            'contact_name' => 'SC1', 
            'city' => 'test', 
            'country' => 'test'
        ]);
        $p1 = Product::factory()->create([
            'product_name' => 'P1', 
            'unit_price'=> 250, 
            'supplier_id' => 1
        ])->make();
        $p2 = Product::factory()->create([
            'product_name' => 'P2', 
            'unit_price'=> 500, 
            'supplier_id' => 1
        ])->make();
        $c = Customer::factory()->create([
            'first_name' => 'C1',
            'last_name' => 'C2', 
            'city' => 'test', 
            'country' => 'test',
            'phone'=>'1234'
        ]);
        $o = Order::factory()->create([
            'order_date'=>\Carbon\Carbon::now(),
            'customer_id'=>1,
            'order_number' => \Str::Random(4),
            'total_amount' => 0
        ]);

        $order_response = $this->actingAs($user)->put('/api/orders/1', [
            'order_date'=>\Carbon\Carbon::now(),
            'customer_id'=>1,
            'items' => [
                [
                    'product_id' => 1,
                    'quantity' => 2
                ],
                [
                    'product_id' => 2,
                    'quantity' => 4
                ]
            ]
        ]);
       
        $order_response->assertStatus(200);
        $this->assertEquals(2500, $order_response->original->total_amount, "Order's total amount is correct");
    }
}
