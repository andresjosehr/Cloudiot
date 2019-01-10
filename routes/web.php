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

// Route::get('Prueba','PruebaController@index')->name("Prueba");

Route::get('/home', function (){
	
	return redirect("/panel-de-control");

})->name("home");




Route::get('Prueba', ['middleware' => 'verificar_login', function () {

	return view("loader.index");
    
}]);