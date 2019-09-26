<?php

namespace App\Http\Controllers\TareasProgramadas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class SincronizacionBDController extends Controller
{
    public function log_aasa()
    {
    	$UltimaFecha = DB::connection("telemetria_local")->select("SELECT * FROM log_aasa ORDER BY mt_time DESC LIMIT 1");


		$InsertarDatos = DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time>='".$UltimaFecha[0]->mt_time."' ORDER BY mt_time DESC ");

		$InsertarDatos=json_decode(json_encode($InsertarDatos), true);

		DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos);

		
		$UltimaFechaEliminar = DB::connection("telemetria_local")->select("SELECT * FROM log_aasa ORDER BY mt_time ASC LIMIT 1");
		
		DB::connection("telemetria_local")->select("DELETE FROM log_aasa WHERE mt_time='".$UltimaFechaEliminar[0]->mt_time."' ");

		return "Exito";
		
    }
}
