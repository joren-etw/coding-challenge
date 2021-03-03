<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface DiscountInterface
{
    /**
     * Post order to get discounts as result
     *
     * @param   \App\Http\Request       $request
     *
     * @method  POST    api/calculate-discounts
     * @access  public
     */
    public function getDiscounts(array $order);
}
