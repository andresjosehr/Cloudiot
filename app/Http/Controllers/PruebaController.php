<?php

namespace App\Http\Controllers;

use Request;
use DB;

class PruebaController extends Controller{
    public function index(){

		$datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_biofil02 WHERE  (mt_name='Biofiltro02--Consumo.PH_Entrada'
                                                                              OR mt_name='Biofiltro02--Consumo.ORP_Entrada'
                                                                              OR mt_name='Biofiltro02--Consumo.Conductividad_Entrada'
                                                                              OR mt_name='Biofiltro02--Consumo.PH_Salida'
                                                                              OR mt_name='Biofiltro02--Consumo.ORP_Salida'
                                                                              OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                                                              ORDER BY mt_time DESC
                                                                              LIMIT 120");


        return $datos;
               


    }
}
