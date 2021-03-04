<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Foundation\Bus\Dispatchable;

class CalculateCustomerDiscount
{
    use Dispatchable;

    private $discountFromAmount;
    private $discountPercentage;
    private $customer;
    private $total;

    /**
     * @param Customer $customer
     * @param float $total
     */
    public function __construct(Customer $customer, float $total)
    {
        $this->discountFromAmount = 1000;
        $this->discountPercentage = 10;
        $this->customer = $customer;
        $this->total = $total;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        /** Return discount 0.00 when revenue is not high enough */
        if($this->customer->revenue < $this->discountFromAmount){
            return [
                'amount' => 0.00,
                'reason' => 'Current revenue not higher than ' . $this->discountFromAmount
            ];
        }

        /** Revenue is high enough, calculate discount and return data */
        return [
            'amount' => round($this->total * ($this->discountPercentage / 100), 2),
            'reason' => 'Current revenue higher than ' . $this->discountFromAmount . ' (' . $this->customer->revenue . ')'
        ];
    }
}
