<?php

namespace App\Models\ActionElements\DiscountRules;

use Illuminate\Foundation\Bus\Dispatchable;

class SetFreeProduct
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
     * handleSetFreeProduct will iterate over the quantities for every product
     * and add a discount for every iteration of free quantities
     *
     * @return array
     */
    public function handle(): array {
        foreach($this->products as $key => $product){
            $qty = (float)$product['quantity'];
            $freeProducts = 0;

            /** Set discount to 0.00 if the quantity is equal to the from quantity */
            if($qty === $this->fromQty){
                $products[$key]['discount'] = [
                    'amount' => 0.00,
                    'free_quantity' => 0,
                    'reason' => 'Receive a free product from the ' . round($this->fromQty, 2) . 'th product. The next product will be free'
                ];

                continue;
            }

            /** Add a free product for every iteration of free quantities in the purchased quantity */
            while($qty > $this->fromQty){
                $freeProducts += $this->freeQty;
                $qty -= $this->fromQty;
            }

            /** Calculate discount and set product's discount data */
            $totalDiscount = $freeProducts * $product['unit_price'];
            $products[$key]['total_price_with_discount'] = $this->products[$key]['total_price'] - $totalDiscount;
            $products[$key]['discount'] = [
                'amount' => $totalDiscount,
                'free_quantity' => $freeProducts,
                'reason' => 'Set every ' . round($this->fromQty, 2) . 'th paid product free for this category'
            ];
        }

        return $products;
    }
}
