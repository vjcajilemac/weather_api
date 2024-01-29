<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'v1' ], function () {
    
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group([ 'prefix' => 'places' ], function () {
            Route::get('/search', [PlaceController::class, 'searchPlaces']);
            
        });
        Route::group([ 'prefix' => 'weather' ], function () {
            Route::post('/find_by_place', [WeatherController::class, 'findByPlace']);
            Route::post('/comment/{id}', [WeatherController::class, 'comment']);
            Route::get('/index', [WeatherController::class, 'index']);
            Route::get('/get_comments/{id}', [WeatherController::class, 'getComments']);
            Route::delete('/delete/{id}', [WeatherController::class, 'delete']);
            
            
        });
    });
    
    Route::group([ 'prefix' => 'user' ], function () {
        Route::post('/create', [UserController::class, 'create']);
        Route::post('/login', [UserController::class, 'login']);
        
    });    

});