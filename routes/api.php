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
Route::group(['middleware' => 'auth:api'], function () {
  // Clientes
  Route::get('clientes','ClienteController@indexAPI');
  Route::post('clientes','ClienteController@storeAPI');
  Route::get('clientes/{doc}/show','ClienteController@showAPI');

  //Articulos
  Route::get('articulos','ArticuloController@articulos');
});
