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





Route::get("xml-subterraneo", "InstalacionesController@PozoSubterraneo");

Route::get('/', 'HomeController@index');

Route::get('testear-instalaciones', 'TestingController@index');

Auth::routes();

Route::get('panel-de-control','InstalacionesController@index')->middleware("verificar_login");

Route::get('registrar-usuario', 'UsuariosController@index')->middleware("verificar_login");

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
Route::post('PausarReanudarParametros', "ParametrosController@PausarReanudarParametros")->middleware("verificar_login");

Route::get('AlarmasInterval', "AlarmasController@Interval")->middleware("verificar_login");
Route::get('Alarmas', "AlarmasController@index")->middleware("verificar_login");
Route::post('RegistrarIntervaloAlarma', "AlarmasController@RegistrarIntervalo")->middleware("verificar_login");
Route::post('RegistrarDatoAlarma', "AlarmasController@RegistrarDatoAlarma")->middleware("verificar_login");
Route::post('EditarDatoAlarma', "AlarmasController@EditarDatoAlarma")->middleware("verificar_login");

Route::post('SicutIgnisController2','SicutIgnisController2@index')->middleware("verificar_login");

Route::post('SicutIgnisController','SicutIgnisController@index')->middleware("verificar_login");
Route::post('VinaLuisFelipeController','VinaLuisFelipeController@index')->middleware("verificar_login");
Route::post('CalculosLuisFelipe','VinaLuisFelipeController@Calculos')->middleware("verificar_login");
Route::post('CalculosLuisFelipe2','VinaLuisFelipeController@GraficarRelojes')->middleware("verificar_login");
Route::post('CalculosLuisFelipe3','VinaLuisFelipeController@ExportarVinaExcel')->middleware("verificar_login");
Route::post('CalculosLuisFelipe4','VinaLuisFelipeController@GraficarFlujoFechaPersonalizado')->middleware("verificar_login");
Route::post('CalculosLuisFelipe5','VinaLuisFelipeController@ListarBombas')->middleware("verificar_login");
Route::post('CalculosLuisFelipe6','VinaLuisFelipeController@BombasPersonalizadas')->middleware("verificar_login");
Route::post('CalculosLuisFelipe7','VinaLuisFelipeController@GraficarPHDiario')->middleware("verificar_login");
Route::post('CalculosLuisFelipe8','VinaLuisFelipeController@GraficarPHFechaPersonalizado')->middleware("verificar_login");
Route::post('CalculosLuisFelipe9','VinaLuisFelipeController@GraficarORPDiario')->middleware("verificar_login");
Route::post('CalculosLuisFelipe10','VinaLuisFelipeController@GraficarORPPersonalizado')->middleware("verificar_login");
Route::post('CalculosLuisFelipe11','VinaLuisFelipeController@GraficarConductividadDiario')->middleware("verificar_login");
Route::post('CalculosLuisFelipe12','VinaLuisFelipeController@GraficarConductividadPersonalizado')->middleware("verificar_login");
Route::post('CalculosLuisFelipe13','VinaLuisFelipeController@GraficarFlujo')->middleware("verificar_login");

Route::post('CalculosLuisFelipe14','VinaLuisFelipeController@ConsultarParametros')->middleware("verificar_login");

Route::post('CalculosLuisFelipe15','VinaLuisFelipeController@MostrarBombas')->middleware("verificar_login");

Route::post('CalculosLuisFelipe16','VinaLuisFelipeController@MostrarRelojes')->middleware("verificar_login");

Route::post('CalculosLuisFelipe17','VinaLuisFelipeController@Entrada1')->middleware("verificar_login");
Route::post('CalculosLuisFelipe18','VinaLuisFelipeController@Entrada2')->middleware("verificar_login");
Route::post('CalculosLuisFelipe19','VinaLuisFelipeController@Entrada3')->middleware("verificar_login");
Route::post('CalculosLuisFelipe20','VinaLuisFelipeController@Salida1')->middleware("verificar_login");
Route::post('CalculosLuisFelipe21','VinaLuisFelipeController@Salida2')->middleware("verificar_login");
Route::post('CalculosLuisFelipe22','VinaLuisFelipeController@Salida3')->middleware("verificar_login");
Route::get('exportar-xml-luis-felipe','VinaLuisFelipeController@ExportarXML');


Route::post('GraficoSigutIgnis1-2','SicutIgnisController2@Grafico1')->middleware("verificar_login");
Route::post('GraficoSigutIgnis2-2','SicutIgnisController2@Grafico2')->middleware("verificar_login");
Route::post('GraficoSigutIgnis3-2','SicutIgnisController2@Grafico3')->middleware("verificar_login");
Route::post('GraficoSigutIgnis4-2','SicutIgnisController2@Grafico4')->middleware("verificar_login");
Route::post('GraficoSigutIgnis5-2','SicutIgnisController2@Grafico5')->middleware("verificar_login");
Route::post('GraficoSigutIgnis6-2','SicutIgnisController2@Grafico6')->middleware("verificar_login");
Route::post('GraficoSigutIgnis7-2','SicutIgnisController2@Grafico7')->middleware("verificar_login");

Route::post('GraficoSigutIgnis1','SicutIgnisController@Grafico1')->middleware("verificar_login");
Route::post('GraficoSigutIgnis2','SicutIgnisController@Grafico2')->middleware("verificar_login");
Route::post('GraficoSigutIgnis3','SicutIgnisController@Grafico3')->middleware("verificar_login");
Route::post('GraficoSigutIgnis4','SicutIgnisController@Grafico4')->middleware("verificar_login");
Route::post('GraficoSigutIgnis5','SicutIgnisController@Grafico5')->middleware("verificar_login");
Route::post('GraficoSigutIgnis6','SicutIgnisController@Grafico6')->middleware("verificar_login");
Route::post('GraficoSigutIgnis7','SicutIgnisController@Grafico7')->middleware("verificar_login");
Route::get('ExportarAasa','SicutIgnisController@ExportarAasa')->middleware("verificar_login");
Route::get('ExportarAasaSubModal/{Grafico}','SicutIgnisController@ExportarAasa2')->middleware("verificar_login");



Route::post('PreRegistro','UsuariosController@PreRegistro')->middleware("verificar_login");
Route::post('BorrarPreRegistro','UsuariosController@BorrarPreRegistro')->middleware("verificar_login");





Route::post('PlantaLicanController','PlantaLicanController@index')->middleware("verificar_login");


Route::get('ExcelFlujosDiarios', "ExcelController@ExcelFlujosDiarios")->middleware("verificar_login");


Route::post('ExportarSicutExcel', "SicutIgnisController@ExportarSicutExcel")->middleware("verificar_login");


Route::get('Cuenta', 'UsuariosController@DisplayInfoAccount')->middleware("verificar_login");

Route::post('CambiarContrasena', 'UsuariosController@CambiarContrasena')->middleware("verificar_login");




Route::post('MaitenalController','MaitenalController@index')->middleware("verificar_login");

Route::get('MaitenalBombas','MaitenalController@MostrarBombas')->middleware("verificar_login");
Route::get('MaitenalGrafico','MaitenalController@MaitenalGrafico')->middleware("verificar_login");
Route::get('MaitenalParametros','MaitenalController@MaitenalParametros')->middleware("verificar_login");
Route::get('MaitenalFlujoDiario','MaitenalController@MaitenalFlujoDiario')->middleware("verificar_login");
Route::post('GraficarFlujoPersonalizadoMaitenal','MaitenalController@GraficarFlujoPersonalizadoMaitenal')->middleware("verificar_login");
Route::get('DescargarExcelFlujoMaitenal','MaitenalController@DescargarExcelFlujoMaitenal')->middleware("verificar_login");



Route::post('FinningController','FinningController@index')->middleware("verificar_login");
Route::get('ExportarFinning','FinningController@ExportarRango')->middleware("verificar_login");
Route::post('FinningEstadoBombasMarcador','FinningController@FinningEstadoBombasMarcador')->middleware("verificar_login");

Route::post('FinningPozoNave4','FinningController@FinningPozoNave4')->middleware("verificar_login");
Route::post('FinningPlantaAgua','FinningController@FinningPlantaAgua')->middleware("verificar_login");
Route::post('FinningDinamometro','FinningController@FinningDinamometro')->middleware("verificar_login");

Route::post('SanJavierController','SanJavierController@index')->middleware("verificar_login");
Route::get('JavierBombas','SanJavierController@MostrarBombas')->middleware("verificar_login");
Route::get('JavierGrafico','SanJavierController@JavierGrafico')->middleware("verificar_login");
Route::get('JavierParametros','SanJavierController@JavierParametros')->middleware("verificar_login");
Route::get('JavierFlujoDiario','SanJavierController@JavierFlujoDiario')->middleware("verificar_login");

Route::post('GraficarFlujoPersonalizadoJavier','SanJavierController@GraficarFlujoPersonalizadoJavier')->middleware("verificar_login");
Route::get('DescargarExcelFlujoJavier','SanJavierController@DescargarExcelFlujoJavier')->middleware("verificar_login");


Route::post('EnViniloController', function(){ return view("modals.EnVinilo.EnVinilo"); })->middleware("verificar_login");



Route::post('WelkoController','WelkoController@index')->middleware("verificar_login");
Route::post('WelkoGraficarNivel','WelkoController@WelkoGraficarNivel')->middleware("verificar_login");



Route::get('sincronizar-instalaciones','TareasProgramadas\SincronizacionBDController@index');






