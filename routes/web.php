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

Route::get('registrar-usuario', function (){
	return view("usuarios.registrar", ["Usuario" => Auth::user()]);
})->middleware("verificar_login");

Route::post('ConsultaInstalacion','InstalacionesController@ConsultaModal')->middleware("verificar_login");

// Route::get('Prueba','PruebaController@index')->name("Prueba");

Route::get('/home', function (){
	
	return redirect("/panel-de-control");

})->name("home");

Route::get('CerrarSesion', function(){
        //Desconctamos al usuario
        Auth::logout();
       return redirect("/");
})->middleware("verificar_login");





Route::get('Prueba', "PruebaController@index");

Route::get('RegistrarInstalacion', function(){
	return view("instalaciones.registrar", ["Usuario" => Auth::user()]);
})->middleware("verificar_login");


Route::post('RegistarInstalacion2', "InstalacionesController@RegistarInstalacion")->middleware("verificar_login");
Route::get('EditarInstalacion', "InstalacionesController@EditarInstalacion")->middleware("verificar_login");

Route::get('parametros', function (){
	return view("parametros", ["Usuario" =>  Auth::user()]);
})->middleware("verificar_login");

Route::post('InsertarParametroRiego', "ParametrosController@InsertarParametroRiego")->middleware("verificar_login");
Route::post('InsertarParametroReposo', "ParametrosController@InsertarParametroReposo")->middleware("verificar_login");
Route::post('InsertarParametroRangoPH', "ParametrosController@InsertarParametroRangoPH")->middleware("verificar_login");

Route::get('AlarmasInterval', "AlarmasController@Interval")->middleware("verificar_login");
Route::get('Alarmas', "AlarmasController@index")->middleware("verificar_login");
Route::post('RegistrarIntervaloAlarma', "AlarmasController@RegistrarIntervalo")->middleware("verificar_login");
Route::post('RegistrarDatoAlarma', "AlarmasController@RegistrarDatoAlarma")->middleware("verificar_login");
Route::post('EditarDatoAlarma', "AlarmasController@EditarDatoAlarma")->middleware("verificar_login");

Route::post('SicutIgnisController','SicutIgnisController@index')->middleware("verificar_login");
Route::post('VinaLuisFelipeController','VinaLuisFelipeController@index')->middleware("verificar_login");
Route::post('CalculosLuisFelipe','VinaLuisFelipeController@Calculos')->middleware("verificar_login");
Route::post('CalculosLuisFelipe2','VinaLuisFelipeController@GraficarRelojes')->middleware("verificar_login");
Route::post('CalculosLuisFelipe3','VinaLuisFelipeController@GraficarRelojesFechaPersonalizada')->middleware("verificar_login");
Route::post('CalculosLuisFelipe4','VinaLuisFelipeController@GraficarFlujoFechaPersonalizado')->middleware("verificar_login");
Route::post('CalculosLuisFelipe5','VinaLuisFelipeController@ListarBombas')->middleware("verificar_login");
Route::post('CalculosLuisFelipe6','VinaLuisFelipeController@BombasPersonalizadas')->middleware("verificar_login");
Route::post('CalculosLuisFelipe7','VinaLuisFelipeController@GraficarPHDiario')->middleware("verificar_login");



Route::post('CalculosSigutIgnis','SicutIgnisController@Calculos')->middleware("verificar_login");





Route::post('PlantaLicanController','PlantaLicanController@index')->middleware("verificar_login");


Route::get('ExcelFlujosDiarios', "ExcelController@ExcelFlujosDiarios")->middleware("verificar_login");

Route::get('Cuenta', function(){
	return view("usuarios.cuenta", ["Usuario" =>  Auth::user()]);
})->middleware("verificar_login");

Route::post('CambiarContrasena', 'UsuariosController@CambiarContrasena')->middleware("verificar_login");
