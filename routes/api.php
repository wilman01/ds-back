<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\QuotationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehimodelController;
use App\Http\Controllers\Api\YearController;
use App\Http\Controllers\Api\VehiversionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    
    'prefix' => 'auth'
    
], function ($router) {
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('user', [UserController::class, 'getAuthenticatedUser']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'authenticate']);
    Route::get('user', [UserController::class, 'index']);

    Route::put('user/{user}', [UserController::class, 'update']);
});

Route::resource('year', YearController::class)->names('api.year');

Route::resource('brand', BrandController::class)->names('api.brand');

Route::resource('vehimodel', VehimodelController::class)->names('api.vehimodel');

Route::resource('vehiversion', VehiversionController::class)->names('api.vehiversion');

Route::resource('customer', CustomerController::class)->names('api.customer'); 

Route::resource('quotation', QuotationController::class)->names('api.cotizacion');