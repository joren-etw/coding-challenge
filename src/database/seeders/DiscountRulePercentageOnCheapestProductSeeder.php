<?php

namespace Database\Seeders;

use App\Models\DiscountRulePercentageOnCheapestProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountRulePercentageOnCheapestProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new DiscountRulePercentageOnCheapestProduct())->getTable())->truncate();

        DiscountRulePercentageOnCheapestProduct::make([
            'name' => 'Tools discount',
            'percentage' => 20
        ]);
    }
}
