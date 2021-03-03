<?php

namespace App\Models\ActionElements\DiscountRules;

use Illuminate\Foundation\Bus\Dispatchable;

class AddFreeProduct
{
    use Dispatchable;

    private $products;
    private $fromQty;
    private $freeQty;

    /**
     * @param array $products
     * @param float $fromQty
     * @param float $freeQty
     */
    public function __construct(array $products, float $fromQty, float $freeQty)
    {
        $this->products = $products;
        $this->fromQty = $fromQty;
        $this->freeQty = $freeQty;
    }

    /**
     * AddFreeProduct will add a free product for every iteration of free quantity amounts
     *
     * @return array
     */
    public function handle(): array {
        foreach($this->products as $key => $product){
            if($product['quantity'] >= $this->fromQty){
                /** Determine amount of free products and total discount */
                $freeProducts = floor($product['quantity'] / $this->fromQty) * $this->freeQty;
                $totalDiscount = $freeProducts * $product['unit_price'];

                /** Set new quantity, total with discount and discount data */
                $this->products[$key]['quantity'] += $freeProducts;
                $this->products[$key]['total_price_with_discount'] = $this->products[$key]['total_price'] - $totalDiscount;
                $this->products[$key]['discount'] = [
                    'amount' => round($totalDiscount, 2),
                    'free_quantity' => $freeProducts,
                    'reason' => 'Got a free product for every ' . round($this->fromQty, 2) . 'th product'
                ];
            }
        }

        return $this->products;
    }
}
