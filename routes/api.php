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
  // 'middleware' => ['jwt', 'jwt.auth'],
    'prefix' => 'auth'

], function ($router) {

   Route::post('login', 'JWTAuthController@login');
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('me', 'JWTAuthController@me');
    Route::get('example', function() {
        return ['name' => Auth::User()->name,
    'id' => Auth::User()->id];
    } );
    

});


Route::group([

    // 'middleware' => 'api',
    'middleware' => ['jwt', 'jwt.auth'],
     'prefix' => 'v1'
 
 ], function ($router) {
 
   
     Route::get('estates', 'EstateController@index');
     Route::get('estates/{estate}', 'EstateController@getById');

     Route::get('water-source-types', 'WaterSourceController@getTypes');

     Route::post('water-sources', 'WaterSourceController@store');
     Route::get('water-sources', 'WaterSourceController@index');
     Route::get('water-sources/{waterSource}', 'WaterSourceController@getById');
     Route::delete('water-sources/{waterSource}', 'WaterSourceController@destroy');

     Route::get('example', function() {
         return ['name' => Auth::User()->name,
     'id' => Auth::User()->id];
     } );
     
 
 });

//  Route::group(['prefix' => 'Auth'], function () {

//      Route::post('login', 'JWTAuthController@login');

// });



Route::group([

    'middleware' => 'api',
    'prefix' => 'auditoria'

], function ($router) {

    Route::post('list', 'auditoriaController@list');
    Route::get('show/{id}', 'auditoriaController@show');
    
});


