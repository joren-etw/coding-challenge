<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface DiscountInterface
{
    /**
     * Get discounts by order data
     *
     * @param   \App\Http\Request       $request
     *
     * @method  GET    api/calculate-discounts
     * @access  public
     */
    public function getDiscounts(array $order);
}
