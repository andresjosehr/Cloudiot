<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use View;

class PozoNave4Controller extends Controller
{
    public function index()
    {
    	$Datos["UltimaMedicionPozoNave4"] = DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'PozoNave%' ORDER BY mt_time DESC LIMIT 1;");

    	 $Datos["PozoNave4Tabla1"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelBajoE1') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelBajoE1')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 1) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla2"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelBajoE2') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelBajoE2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 1) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla3"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelAltoE1') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelAltoE1')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 1) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla4"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelAltoE2') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelAltoE2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 1) lf GROUP BY mt_time;");

        $Datos["PozoNave4"] = $Datos["PozoNave4Tabla1"][0]->mt_value+$Datos["PozoNave4Tabla2"][0]->mt_value+$Datos["PozoNave4Tabla3"][0]->mt_value+$Datos["PozoNave4Tabla4"][0]->mt_value; 

        $Datos["PozoNave4Tabla"]["NivelBajoE1"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelBajoE1') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelBajoE1')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla"]["NivelAltoE1"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelBajoE2') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelBajoE2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla"]["NivelBajoE2"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelAltoE1') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelAltoE1')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        $Datos["PozoNave4Tabla"]["NivelAltoE2"]=DB::connection("telemetria")->select("SELECT mt_name, SUM(mt_value) as mt_value, mt_time FROM (SELECT * FROM (SELECT * FROM log_finning01 WHERE (mt_name='PozoNave4--Consumo.NivelAltoE2') order by mt_time desc LIMIT 2000) lf WHERE (mt_name='PozoNave4--Consumo.NivelAltoE2')
                                                                                    GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 60) lf GROUP BY mt_time;");

        return view("modals.Finning.pozo_nave_4", ["Datos" => $Datos]);
    }
}
