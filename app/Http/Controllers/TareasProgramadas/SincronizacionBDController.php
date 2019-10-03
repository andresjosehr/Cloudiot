<?php

namespace App\Http\Controllers\TareasProgramadas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class SincronizacionBDController extends Controller
{
    public function log_aasa()
    {
      $Fechas = DB::connection("telemetria")->select("SELECT DISTINCT mt_time FROM log_aasa ORDER BY mt_time DESC LIMIT 3");

      $InsertarDatos0=DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time='".$Fechas[0]->mt_time."'");
      $InsertarDatos1=DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time='".$Fechas[1]->mt_time."'");
      $InsertarDatos2=DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time='".$Fechas[2]->mt_time."'");

      DB::connection("telemetria_local")->select("DELETE FROM log_aasa");


      $InsertarDatos0=json_decode(json_encode($InsertarDatos0), true);
      $InsertarDatos1=json_decode(json_encode($InsertarDatos1), true);
      $InsertarDatos2=json_decode(json_encode($InsertarDatos2), true);


    DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos0);
    DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos1);
    DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos2);

    return self::log_biofil02();
    
    }



    public function log_biofil02()
    {

      $Fechas = DB::connection("telemetria")->select("SELECT DISTINCT mt_time FROM log_biofil02 ORDER BY mt_time DESC LIMIT 3");

      $InsertarDatos0=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[0]->mt_time."'");
      $InsertarDatos1=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[1]->mt_time."'");
      $InsertarDatos2=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[2]->mt_time."'");

      DB::connection("telemetria_local")->select("DELETE FROM log_biofil02");


      $InsertarDatos0=json_decode(json_encode($InsertarDatos0), true);
      $InsertarDatos1=json_decode(json_encode($InsertarDatos1), true);
      $InsertarDatos2=json_decode(json_encode($InsertarDatos2), true);


      DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos0);
      DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos1);
      DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos2);

      return "Exito";
    
    }
}
