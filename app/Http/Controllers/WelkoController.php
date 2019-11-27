<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class WelkoController extends Controller
{
    public function index()
    {
    	$Datos["UltimaMedicion"]= DB::connection("telemetria")->select("SELECT * FROM telemetria.log_welko012 ORDER BY mt_time DESC LIMIT 1");
    	return view("modals.welko.welko", ["Datos" => $Datos]);
    }

    public function WelkoGraficarNivel()
    {
    	$Datos= DB::connection("telemetria")->select("(SELECT mt_name, mt_time, mt_value FROM telemetria.log_welko012 WHERE mt_name LIKE '%Nivel' AND mt_value>=400 AND mt_value<=20000 ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_name, mt_time;");

    	$Nivel = json_decode(json_encode($Datos), true);
    	$Nivel = json_encode($Nivel);
    	return "WelkoGraficarNivel('".$Nivel."')";
    }
}
