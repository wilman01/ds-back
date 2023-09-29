<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DetailController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehimodelController;
use App\Http\Controllers\Api\VehiversionController;
use App\Http\Controllers\Api\YearController;
use Illuminate\Support\Facades\Route;

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

Route::resource('provider', ProviderController::class)->names('api.provider');

Route::resource('policy',PolicyController::class)->names('api.policy');

Route::resource('type', TypeController::class)->names('api.type');

Route::get('type-policy/{policy}', [TypeController::class, 'withPolicies'])->name('api.type.withPolices');

Route::resource('detail', DetailController::class)->names('api.detail');

Route::resource('health', HealthController::class)->names('api.health');

