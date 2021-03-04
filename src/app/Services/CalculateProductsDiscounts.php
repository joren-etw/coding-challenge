<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Bus\Dispatchable;

class CalculateProductsDiscounts
{
    use Dispatchable;

    private $products;

    /**
     * @param array $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        /** Pluck product ids from products */
        $productIds = collect($this->products)->pluck('product-id')->all();

        /** Get products with categories and their discounts */
        $products = Product::whereIn('product_id', $productIds)
        ->with('category', static function ($q) {
            $q->with('discount');
        })->get();

        $relevantCategories = $products->pluck('category')->unique();

        /** Iterate over relevant categories and execute their linked discount */
        foreach($relevantCategories as $relevantCategory){
            $relevantProducts = $products->filter(
                static fn ($p) => $p->category_id === $relevantCategory->id
            )->toArray();

            /** Add sales data to products array */
            foreach($relevantProducts as $key => $relevantProduct){
                $productSaleData = collect($this->products)->filter(
                    static fn($q) => $q['product-id'] === $relevantProduct['product_id']
                )->first();

                $relevantProducts[$key]['quantity'] = $productSaleData['quantity'];
                $relevantProducts[$key]['unit_price'] = $productSaleData['unit-price'];
                $relevantProducts[$key]['total_price'] = $productSaleData['total'];
                unset($relevantProducts[$key]['category']);
            }

            /** Handle discount logics */
            $results[] = $relevantCategory->discount->handle(collect($relevantProducts));
        }


        return $results;
    }
}
