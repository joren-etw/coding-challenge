<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Product())->getTable())->truncate();

        foreach(json_decode(file_get_contents('./database/seeders/data/products.json'), true) as $product){
            Product::create([
                'product_id' => $product['id'],
                'description' => $product['description'],
                'price' => $product['price'],
                'category_id' => $product['category'],
            ]);
        };
    }
}
