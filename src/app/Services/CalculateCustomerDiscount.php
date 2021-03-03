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

    public function __construct(Customer $customer, float $total)
    {
        $this->discountFromAmount = 1000;
        $this->discountPercentage = 10;
        $this->customer = $customer;
        $this->total = $total;
    }

    public function handle()
    {
        if($this->customer->revenue < $this->discountFromAmount){
            return [
                'amount' => 0.00,
                'reason' => 'Current revenue not higher than ' . $this->discountFromAmount
            ];
        }

        return [
            'amount' => round($this->total * ($this->discountPercentage / 100), 2),
            'reason' => 'Current revenue higher than ' . $this->discountFromAmount . ' (' . $this->customer->revenue . ')'
        ];
    }
}
