<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Finning;

use Request;
use DB;
use Auth;

class PruebaController extends Controller{


    public function index(){



return $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value,
                                  mt_time
                                   FROM log_biofil02 
                                   FORCE INDEX (index_biofil02)
                                     WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' 
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY DAY(mt_time) 
                                               ORDER BY mt_time ASC");
				}

}


