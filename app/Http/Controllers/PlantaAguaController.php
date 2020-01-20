<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use View;

class PlantaAguaController extends Controller
{
    public function index()
    {

        $Datos["UltimaMedicionPlantaAgua"] = DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'PlantaAgua%' ORDER BY mt_time DESC LIMIT 1;");

        $Datos["PlantaAgua1"]=DB::connection("telemetria")->select("SELECT SUM(mt_value) as mt_value FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 10000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");

		$Datos["PlantaAgua2"]=DB::connection("telemetria")->select("SELECT SUM(mt_value) as mt_value FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 10000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");
		// $Datos["PlantaAgua"] = max($Datos["PlantaAgua2"][0]->mt_value, $Datos["PlantaAgua1"][0]->mt_value); 





		$Datos["PlantaAgua"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012') order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1002'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1011'
                                                                                     OR mt_name='PlantaAgua--Consumo.FallaBomba1012')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 4) ORDER BY mt_name, mt_time");




      $Datos["Reloj1"]=DB::connection("telemetria")->select("SELECT SUM(mt_value) as mt_value FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK100'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");

      $Datos["Reloj2"]=DB::connection("telemetria")->select("SELECT SUM(mt_value) as mt_value FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK101'
                                                                                     OR mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC");


      


           if ($Datos["Reloj1"][0]->mt_value==0) $Datos["Reloj1"][0]->mt_value=25;
           if ($Datos["Reloj1"][0]->mt_value==1) $Datos["Reloj1"][0]->mt_value=50;
           if ($Datos["Reloj1"][0]->mt_value==2) $Datos["Reloj1"][0]->mt_value=75;

           if ($Datos["Reloj2"][0]->mt_value==0) $Datos["Reloj2"][0]->mt_value=25;
           if ($Datos["Reloj2"][0]->mt_value==1) $Datos["Reloj2"][0]->mt_value=50;
           if ($Datos["Reloj2"][0]->mt_value==2) $Datos["Reloj2"][0]->mt_value=75;



        $Datos["PlantaAguaTabla"]["BajoTK100"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK100') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK100')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["BajoTK101"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK101') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelBajoTK101')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["AltoTK100"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelAltoAltoTK100')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["AltoTK101"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.NivelAltoAltoTK101')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["Bomba1001"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1001')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["Bomba1002"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1002') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1002')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["Bomba1011"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1011') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1011')
                                                                                GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PlantaAguaTabla"]["Bomba1012"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1012') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PlantaAgua--Consumo.FallaBomba1012')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

    	return view("modals.Finning.planta_agua", ["Datos" => $Datos]);
    }
}
