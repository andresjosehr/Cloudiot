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

    $Datos["Dinamometro15"] = DB::connection("telemetria")->select("(SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba602'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba603'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba604'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba605'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba606'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba607'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba608'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala1'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala2') AND mt_time BETWEEN '".$_GET['FechaInicio']."' AND '".$_GET['FechaFin']."'
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC) ORDER BY mt_time, mt_name");




    $Datos["PlantaAgua15"] = DB::connection("telemetria")->select("(SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101') AND mt_time BETWEEN '".$_GET['FechaInicio']."' AND '".$_GET['FechaFin']."'
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC) ORDER BY mt_time, mt_name");











        return view('exports.Finning.FinningExport', [
            'Datos' => $Datos
        ]);



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
    
