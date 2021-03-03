<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Customer())->getTable())->truncate();

        foreach(json_decode(file_get_contents('./database/seeders/data/customers.json'), true) as $customer){
            Customer::create($customer);
        };
    }
}
