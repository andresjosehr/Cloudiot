<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Request;
use DB;
use Auth;

class PruebaController extends Controller{


    public function index(){

    return $PrimerosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil04 
                                                WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                      AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE mt_name='Biofiltro04--Consumo.Flujo' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil04 
                                                  WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE mt_name='Biofiltro04--Consumo.Flujo' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras) ; $i++) { 
          $GraficoBarras[$i]["mt_time"]=$SegundosDatosBarras[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j')) {
            $GraficoBarras[$i]["mt_value"]=0;
          } else{
            $GraficoBarras[$i]["mt_value"]=$SegundosDatosBarras[$i]->mt_value-$PrimerosDatosBarras[$k]->mt_value;
            $k++;
          }
        }


        return $GraficoBarras;
    }

    public function headings(): array
    {
        return [
            'mt_value',
            'mt_time',
        ];
    }

}