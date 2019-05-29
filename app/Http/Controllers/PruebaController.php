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

      // $Datos["Dinamometro"] = DB::connection("telemetria")->select("(SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba602'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba603'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba604'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba605'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba606'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba607'
      //                                                                                OR mt_name='Dinamometro--Consumo.ErrorBomba608'
      //                                                                                OR mt_name='Dinamometro--Consumo.InundacionSala1'
      //                                                                                OR mt_name='Dinamometro--Consumo.InundacionSala2')
      //                                                                               GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 150) ORDER BY mt_name, mt_time");




      $Datos["PlantaAgua"] = DB::connection("telemetria")->select("(SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time, mt_name");


       return count($Datos["PlantaAgua"]);
    }

    public function headings(): array
    {
        return [
            'mt_value',
            'mt_time',
        ];
    }

}