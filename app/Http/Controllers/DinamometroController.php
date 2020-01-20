<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use View;

class DinamometroController extends Controller
{
    public function index()
    {


    	$Datos["UltimaMedicionDinamometro"] = DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' ORDER BY mt_time DESC LIMIT 1;");

    	$Datos["Dinamometro"] = DB::connection("telemetria")->select("SELECT SUM(mt_value) as mt_value FROM ((SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) lf WHERE (mt_name='Dinamometro--Consumo.InundacionSala1'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 2)) ta ORDER BY mt_time DESC;");

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


    	$Datos["DinamometroTabla"]["ErrorBomba601"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba602"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba602') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba602')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba603"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba603') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba603')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba604"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba604') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba604')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba605"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba605') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba605')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba606"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba606') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba606')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba607"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba607') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba607')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["ErrorBomba608"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.ErrorBomba608') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.ErrorBomba608')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["InundacionSala1"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.InundacionSala1') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.InundacionSala1')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

            $Datos["DinamometroTabla"]["InundacionSala2"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='Dinamometro--Consumo.InundacionSala2') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='Dinamometro--Consumo.InundacionSala2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");







      $Datos["Dinamometro"] = DB::connection("telemetria")->select("(SELECT * FROM (SELECT * FROM log_finning01 order by mt_time desc limit 400) LF WHERE (mt_name='Dinamometro--Consumo.ErrorBomba601'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba602'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba603'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba604'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba605'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba606'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba607'
                                                                                     OR mt_name='Dinamometro--Consumo.ErrorBomba608'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala1'
                                                                                     OR mt_name='Dinamometro--Consumo.InundacionSala2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 10) ORDER BY mt_time DESC, mt_name");

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

      return view("modals.Finning.dinamometro", ["Datos" => $Datos]);
    }
}
