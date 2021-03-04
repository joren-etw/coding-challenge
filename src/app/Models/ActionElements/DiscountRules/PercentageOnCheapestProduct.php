<?php

namespace App\Models\ActionElements\DiscountRules;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class PercentageOnCheapestProduct
{
    use Dispatchable;

    private $products;
    private $fromQty;
    private $percentage;

    /**
     * @param Collection $products
     * @param float $fromQty
     * @param float $percentage
     */
    public function __construct(Collection $products, float $fromQty, float $percentage)
    {
        $this->products = $products;
        $this->fromQty = $fromQty;
        $this->percentage = $percentage;
    }

    /**
     * Adds set discount to the cheapest product
     * if the combined quantity of all products from category are bigger than the defined quantity
     *
     * @return array
     */
    public function handle(): array {
        $qty = $this->products->sum('quantity');
        $discountFrom = $this->fromQty;
        $discountPercentage = $this->percentage;

        /** If the quantity is less than the set discount_from amount, return 0.00 discount result */
        if($qty < $discountFrom){
            return $this->products->map(static function ($product) use ($discountFrom) {
                $product['discount'] = [
                    'amount' => 0.00,
                    'reason' => 'Total quantity for this category is not bigger than ' . $discountFrom
                ];
                return $product;
            })->toArray();
        }

        /** Get the cheapest product from the collection and calculate it's discount */
        $cheapest = $this->products->sortBy('unit_price')->first();
        $discount = $cheapest['total_price'] * ($discountPercentage / 100);

        /** Return all products with 0.00 discount result, except for the found cheapest product */
        return $this->products->map(static function ($product) use ($cheapest, $discountFrom, $discount, $discountPercentage) {
            if($product['product_id'] === $cheapest['product_id']){
                $product['discount'] = [
                    'amount' => round($discount, 2),
                    'reason' => $discountPercentage . '% discount because the total quantity for this category is bigger or equal to ' . $discountFrom . ' and this is the cheapest product of this category'
                ];
                return $product;
            }


            $product['discount'] = [
                'amount' => 0.00,
                'reason' => 'Discount for this category has been applied on product ' . $cheapest['product_id']
            ];
            return $product;
        })->toArray();
    }
}
