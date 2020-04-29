<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([

   // 'middleware' => 'api',
   'middleware' => ['jwt', 'jwt.auth'],
    'prefix' => 'auth'

], function ($router) {

    
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::post('me', 'JWTAuthController@me');

});

Route::group(['prefix' => 'Auth'], function () {

    Route::post('login', 'JWTAuthController@login');

});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auditoria'

], function ($router) {

    Route::post('list', 'auditoriaController@list');
    Route::get('show/{id}', 'auditoriaController@show');
    
});


