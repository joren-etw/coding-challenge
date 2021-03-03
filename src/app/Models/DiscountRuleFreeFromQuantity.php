<?php

namespace App\Models;

use App\Models\ActionElements\DiscountRules\AddFreeProduct;
use App\Models\ActionElements\DiscountRules\SetFreeProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DiscountRuleFreeFromQuantity extends Model
{
    use HasFactory;

    private $discountMethodSet = false;

    /**
     * @param Collection $products
     *
     * Toggle discountMethodSet to switch between calculation methods
     *
     * @return array
     */
    public function handle(Collection $products): array {
        $products = $products->toArray();

        if($this->discountMethodSet){
            return SetFreeProduct::dispatchNow($products, (float)$this->from_quantity, (float)$this->free_quantity);
        }

        return AddFreeProduct::dispatchNow($products, (float)$this->from_quantity, (float)$this->free_quantity);
    }
}
