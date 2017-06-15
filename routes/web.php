<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Clientes*/
Route::get('clientes','ClienteController@index')->name('clientes');
Route::get('clientes/all','ClienteController@clientes');
Route::post('clientes/new','ClienteController@store')->name('clientes.new');
Route::patch('api/clientes/{cliente}/update','ClienteController@update');
// Route::delete('clientes/{cliente}/delete','ClienteController@destroy')->name('clientes.delete');
Route::get('api/clientes/{id}/delete','ClienteController@delete');


/* Articulos */
Route::get('articulos','ArticuloController@index')->name('articulos');
Route::post('api/articulos','ArticuloController@store');

/* Tipos de Articulos */

Route::get('api/tipos','TipoArticuloController@tipos');
