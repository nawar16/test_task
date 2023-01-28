<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            [
                'first_name' => 'Mohamad',
                'last_name' => 'zid',
                'city' => 'Beirut',
                'country' => 'Lebanon',
                'phone' => '02015485546'
            ],
            [
                'first_name' => 'Samer',
                'last_name' => 'Salam',
                'city' => 'Damascus',
                'country' => 'Syria',
                'phone' => '555456687'
            ]
        ]);
    }
}
