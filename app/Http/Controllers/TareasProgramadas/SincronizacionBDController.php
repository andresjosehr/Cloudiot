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

    	DB::connection("telemetria_local")->select("DELETE FROM log_aasa");

		$InsertarDatos = DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time>='".$UltimaFecha[0]->mt_time."' ORDER BY mt_time DESC ");

		$InsertarDatos=json_decode(json_encode($InsertarDatos), true);

		DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos);


		return "Exito";
		
    }
}
