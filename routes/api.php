<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::get('/get-allowed-ip', 'API\Uat@getAllowedIp');
    Route::post('/sign-in', 'API\AuthController@login');
    Route::post('/init-sign-up', 'API\AuthController@initRegister');
    Route::post('/verify-otp', 'API\AuthController@verifyOtp');
    Route::post('/send-otp', 'API\AuthController@sendOTP');
    Route::post('/sign-up', 'API\AuthController@register');
    
    // Route::get('/get-allowed-ip', function () {
    //     return ['hello'];
    // });
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 //Route::group(['middleware' => 'auth:api'], function() { });
