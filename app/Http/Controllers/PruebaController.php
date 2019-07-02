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

        $Datos["Reloj1"]=DB::connection("telemetria")->select("SELECT * FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");

        return $Datos["Reloj2"]=DB::connection("telemetria")->select("SELECT * FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");



}

}


// (SELECT * FROM log_finning01 WHERE 
//     (mt_name='Dinamometro--Consumo.ErrorBomba601'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba602'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba603'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba604'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba605'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba606'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba607'
//     OR mt_name='Dinamometro--Consumo.ErrorBomba608'
//     OR mt_name='Dinamometro--Consumo.InundacionSala1'
//     OR mt_name='Dinamometro--Consumo.InundacionSala2') 
//     AND mt_time BETWEEN "2019-06-18" AND "2019-06-19"
//     GROUP BY mt_time, mt_name ORDER BY mt_time DESC) 
//     ORDER BY mt_time, mt_name;
                                                                                    
                                                                                    
// (SELECT * FROM log_finning01 WHERE 
//     (mt_name='PlantaAgua--Consumo.FallaBomba1001'
//     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
//     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
//     OR mt_name='PlantaAgua--Consumo.FallaBomba1012'
//     OR mt_name='PlantaAgua--Consumo.NivelBajoTK100'
//     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100'
//     OR mt_name='PlantaAgua--Consumo.NivelBajoTK101')
//     AND mt_time BETWEEN "2019-06-18" AND "2019-06-19"
//     GROUP BY mt_time, mt_name ORDER BY mt_time DESC)
//     ORDER BY mt_time, mt_name;
    
