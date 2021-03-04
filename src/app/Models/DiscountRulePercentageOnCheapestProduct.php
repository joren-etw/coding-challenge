<?php

namespace App\Models;

use App\Models\ActionElements\DiscountRules\PercentageOnCheapestProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DiscountRulePercentageOnCheapestProduct extends Model
{
    use HasFactory;

    public function handle(Collection $products): array {
        return PercentageOnCheapestProduct::dispatchNow($products, (float)$this->discount_from, (float)$this->percentage);
    }
}

