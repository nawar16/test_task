<?php

namespace App\Services;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomerService
{
    protected $customer;
    
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
}
