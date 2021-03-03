<?php

use App\Http\Controllers\API\CalculateDiscountsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/api/calculate-discounts', [CalculateDiscountsController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
