<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DiscountRuleFreeFromQuantity;
use App\Models\DiscountRulePercentageOnCheapestProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Category())->getTable())->truncate();

        Category::create([
            'id' => 1,
            'name' => 'Tools',
            'discount_type_type' => DiscountRulePercentageOnCheapestProduct::class,
            'discount_type_id' => DiscountRulePercentageOnCheapestProduct::firstOrCreate([
                'name' => 'Tools discount',
                'discount_from' => 2,
                'percentage' => 20
            ])->id
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Switches',
            'discount_type_type' => DiscountRuleFreeFromQuantity::class,
            'discount_type_id' => DiscountRuleFreeFromQuantity::firstOrCreate([
                'name' => 'Switches discount',
                'from_quantity' => 5,
                'free_quantity' => 1
            ])->id
        ]);
    }
}
