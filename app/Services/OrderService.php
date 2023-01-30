<?php

namespace App\Services;



use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;


class OrderService
{
    protected $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        return OrderResource::collection($this->order->with(['customer'])->get());
    }

    public function store(StoreOrderRequest $request)
    {
        $product_prices = collect($request->items)->map(function ($single_item) {
            $product = Product::find($single_item['product_id']);
            return ['price'=>$product->unit_price*$single_item['quantity']];
        });
        $order = $this->order->create([
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

    public function show($id)
    {
        $order = $this->order->with(['order_items'])->where('id', $id)->first();
        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $new_item_prices_total_amount = 0;
        if($request->items)
        {
            $new_item_prices = collect($request->items)->map(function ($single_item) {
                $product = Product::find($single_item['product_id']);
                return ['price'=>$product->unit_price*$single_item['quantity']];
            });
            $new_item_prices_total_amount = $new_item_prices->sum('price');
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
        }
        $old_item_prices_total_amount = 0;
        if($request->order_items)
        {
            $old_item_prices = collect($request->order_items)->map(function ($single_item) {
                $product = Product::find($single_item['product_id']);
                return ['price'=>$product->unit_price*$single_item['quantity']];
            });
            $old_item_prices_total_amount = $old_item_prices->sum('price');
            foreach($request->order_items as $order_item)
            {
                $item = OrderItem::where('id', $order_item['id'])->first();
                $item->update([
                    'product_id' => $order_item['product_id'],
                    'quantity' => $order_item['quantity'],
                ]);
            }
        }
        $order->update([
            'order_date' => $request->order_date,
            'customer_id' => $request->customer_id,
            'total_amount' => $new_item_prices_total_amount + $old_item_prices_total_amount
        ]);

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}
