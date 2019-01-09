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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('panel-de-control','InstalacionesController@index')->middleware("verificar_login");

Route::post('ConsultaInstalacion','InstalacionesController@ConsultaModal');

Route::get('Prueba','PruebaController@index')->name("Prueba");




Route::get('panel', ['middleware' => 'verificar_login', function () {

	return "Hola como estas";
    
}]);