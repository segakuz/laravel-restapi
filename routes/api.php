<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GameController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::apiResource('/games', 'GameController');
Route::middleware('auth:api')->group(function(){
    Route::apiResource('/games', 'GameController');
    Route::get('/register', 'Api\AuthController@register')->name('register');
    Route::get('/login', 'Api\AuthController@login')->name('login');
    Route::get('/logout', 'Api\AuthController@logout')->name('logout');
});
