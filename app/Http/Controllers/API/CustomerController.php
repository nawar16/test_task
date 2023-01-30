<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customer_service;
    
    public function __construct(CustomerService $customer_service)
    {
        $this->customer_service = $customer_service;
    }
    public function index()
    {
        return $this->customer_service->index();
    }

    public function show(Customer $customer)
    {
        return $this->customer_service->show($customer);
    }
}
