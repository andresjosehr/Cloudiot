<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FinningController extends Controller
{
    public function index()
    {
    	$Datos = DB::connection("telemetria")->select("(SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba602'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba603'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba604'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba605'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba606'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba607'
						                                                                         OR mt_name='Dinamometro--Consumo.ErrorBomba608'
																								 OR mt_name='Dinamometro--Consumo.InundacionSala1'
																								 OR mt_name='Dinamometro--Consumo.InundacionSala2')
                                                                         GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 10) ORDER BY mt_name, mt_time");
    	return view("modals.Finning.Finning", ["Datos" => $Datos]);
    }
}
