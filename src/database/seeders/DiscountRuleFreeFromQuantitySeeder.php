<?php

namespace Database\Seeders;

use App\Models\DiscountRuleFreeFromQuantity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountRuleFreeFromQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new DiscountRuleFreeFromQuantity())->getTable())->truncate();

        DiscountRuleFreeFromQuantity::make([
            'name' => 'Switches discount',
            'from_quantity' => 5,
            'free_quantity' => 1
        ]);
    }
}
