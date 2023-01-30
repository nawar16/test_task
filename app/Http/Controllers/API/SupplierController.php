<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplier_service;
    
    public function __construct(SupplierService $supplier_service)
    {
        $this->supplier_service = $supplier_service;
    }
    public function index()
    {
        return $this->supplier_service->index();
    }

    public function store(StoreSupplierRequest $request)
    {
        return $this->supplier_service->store($request);
    }

    public function show(Supplier $supplier)
    {
        return $this->supplier_service->show($supplier);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        return $this->supplier_service->update($request, $supplier);
    }

    public function destroy(Supplier $supplier)
    {
        return $this->supplier_service->destroy($supplier);
    }
}
