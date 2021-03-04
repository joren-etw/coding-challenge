<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculateDiscountsController extends Controller
{
    private $discountInterface;

    /**
     * @param DiscountInterface $discountInterface
     */
    public function __construct(DiscountInterface $discountInterface)
    {
        $this->discountInterface = $discountInterface;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->discountInterface->getDiscounts($request->all());
    }
}
