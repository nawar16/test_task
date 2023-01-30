<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;


class ProductController extends Controller
{
    protected $product_service;
    
    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }
    public function index()
    {
        return $this->product_service->index();
    }

    public function store(StoreProductRequest $request)
    {
        return $this->product_service->store($request);
    }

    public function show(Product $product)
    {
        return $this->product_service->show($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return $this->product_service->update($request, $product);
    }

    public function destroy(Product $product)
    {
        return $this->product_service->destroy($product);
    }
}
