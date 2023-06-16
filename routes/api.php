<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Api\YearController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group([    
//     'middleware' => ['api'],
//     'prefix' => 'auth'], 
//     function(){

//     Route::post('register', [UserController::class, 'register']);
//     Route::post('login', [UserController::class, 'authenticate']);
// });


Route::group([
    
    //'middleware' => ['api','jwt.verify'],
    'prefix' => 'auth'
    
], function ($router) {
    Route::post('logout', [UserController::class, 'logout']);
    // Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('user', [UserController::class, 'getAuthenticatedUser']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'authenticate']);
    Route::get('user', [UserController::class, 'index']);

    Route::put('user/{user}', [UserController::class, 'update']);
});

Route::resource('year', YearController::class)->names('api.year');
});
