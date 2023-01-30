<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    protected $order_service;
    
    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }
    public function index()
    {
        return $this->order_service->index();
    }

    public function store(StoreOrderRequest $request)
    {
        return $this->order_service->store($request);
    }

    public function show($id)
    {
        return $this->order_service->show($id);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        return $this->order_service->update($request, $order);
    }

    public function destroy(Order $order)
    {
        return $this->order_service->destroy($order);
    }
}
