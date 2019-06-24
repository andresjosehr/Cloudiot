<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\FinningExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FinningController extends Controller
{
    public function index()
    {


    	$Datos["Dinamometro"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
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




      $Datos["PlantaAgua"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 8) ORDER BY mt_name, mt_time");




      $Datos["Dinamometro15"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) LF WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba602'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba603'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba604'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba605'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba606'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba607'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba608'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala1'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 150) ORDER BY mt_time, mt_name");




        $Datos["PlantaAgua15"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) LF WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time, mt_name");




    	return view("modals.Finning.Finning", ["Datos" => $Datos]);
    }


     public function ExportarRango()
    {
        return Excel::download(new FinningExport, 'Finning.xlsx');
    }
}
