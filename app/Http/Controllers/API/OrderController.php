<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function store(StoreOrderRequest $request)
    {
        $product_prices = collect($request->items)->map(function ($single_item) {
            $product = Product::find($single_item['product_id']);
            return ['price'=>$product->unit_price*$single_item['quantity']];
        });
        $order = Order::create([
            'order_date' => $request->order_date,
            'customer_id' => $request->customer_id,
            'order_number' => \Str::random(10),
            'total_amount' => $product_prices->sum('price')
        ]);
        $items = collect($request->items)->map(function ($item) use($order){
            $product = Product::find($item['product_id']);
            return [
                'order_id'=> $order->id,
                'product_id'=> $product->id,
                'quantity'=> $item['quantity'],
                'unit_price'=> $product->unit_price
            ];
        });
        $order->order_items()->insert($items->toArray());

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}
