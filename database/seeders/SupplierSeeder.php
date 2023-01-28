<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            [
                'company_name' => 'SwafTech',
                'contact_name' => 'Ahmad',
                'city' => 'Damascus',
                'country' => 'Syria',
                'phone' => '33324587',
                'fax' => '33324588'
            ],
            [
                'company_name' => 'Durra',
                'contact_name' => 'سعيد',
                'city' => 'دمشق',
                'country' => 'سوريا',
                'phone' => '0113855454',
                'fax' => NULL
            ],
            [
                'company_name' => 'كهربائيات المصري',
                'contact_name' => 'محمود',
                'city' => 'حلب',
                'country' => 'سوريا',
                'phone' => NULL,
                'fax' => NULL
            ],
        ]);
    }
}
