<?php

namespace App\Repositories;

use App\Interfaces\DiscountInterface;
use App\Models\Customer;
use App\Services\CalculateCustomerDiscount;
use App\Services\CalculateProductsDiscounts;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;

class DiscountRepository implements DiscountInterface
{
    use ResponseAPI;

    public function getDiscounts(array $order): JsonResponse
    {
        try {
            $result['total-discount'] = CalculateCustomerDiscount::dispatchNow(Customer::findOrFail($order['customer-id']), $order['total']);
            $result['products'] = CalculateProductsDiscounts::dispatchNow($order['items']);
            return $this->success("Your order", $result);
        } catch(\Throwable $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
