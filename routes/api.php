<?php

use App\Http\Middleware\checkToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;


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
//default
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('loginToken', 'Auth\LoginController@login');
Route::post('registerToken', 'Auth\RegisterController@register');
Route::post('user/detail', 'Auth\LoginController@show');


Route::middleware(['checkToken'])->group(function(){
    Route::post('user/detailv2', 'Auth\LoginController@show');
});


Route::middleware(['auth:api'])->group(function(){
    
    Route::post('detailv3', 'Auth\LoginController@showV2');
    Route::post('refreshToken', 'Auth\LoginController@refreshToken');

    // Route::post('user/detailv3', 'Auth\LoginController@show');
});





// Route::get('user/detailv3/{token}', 'Auth\LoginController@show');

// Route::middleware(checkToken::class)->post('/user', function (Request $request) {
//     // Route::post('detailv2', 'Auth\LoginController@show');

//     return $request->user();
// });
