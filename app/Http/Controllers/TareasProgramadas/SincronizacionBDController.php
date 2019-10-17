<?php

namespace App\Http\Controllers\TareasProgramadas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class SincronizacionBDController extends Controller
{

    public function index()
    { 
        self::log_aasa();
        self::log_biofil02();

        // self::log_finning01();

        return "Exito";
    }

    public function log_aasa()
    {

      $Fechas = DB::connection("telemetria")->select("SELECT DISTINCT mt_time FROM log_aasa ORDER BY mt_time DESC LIMIT 3");
      $FechaPowerbi = DB::connection("powerbi_local")->select("SELECT DISTINCT mt_time FROM pbi_aasa ORDER BY mt_time DESC LIMIT 1");

      $InsertarDatos0=DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time='".$Fechas[0]->mt_time."'");
      $InsertarDatos1=DB::connection("telemetria")->select("SELECT * FROM log_aasa WHERE mt_time='".$Fechas[1]->mt_time."'");

      $carbon1 = new \Carbon\Carbon($Fechas[0]->mt_time);
      $carbon2 = new \Carbon\Carbon($Fechas[1]->mt_time);
      $minutesDiff=$carbon1->diffInMinutes($carbon2);

    
        if ($minutesDiff==15 && (!empty($Fechas[0]->mt_time) != !empty($FechaPowerbi[0]->mt_time))) {

          DB::connection("telemetria_local")->select("DELETE FROM log_aasa");


          $InsertarDatos0=json_decode(json_encode($InsertarDatos0), true);
          $InsertarDatos1=json_decode(json_encode($InsertarDatos1), true);


          DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos0);
          DB::connection("telemetria_local")->table("log_aasa")->insert($InsertarDatos1);

          DB::connection("powerbi_local")->select('call pb_aasa()');

        }
    
    }



    public function log_biofil02()
    {

      $Fechas = DB::connection("telemetria")->select("SELECT DISTINCT mt_time FROM log_biofil02 ORDER BY mt_time DESC LIMIT 5");
      $FechaPowerbi = DB::connection("powerbi_local")->select("SELECT DISTINCT mt_time FROM pbi_biofiltro02 ORDER BY mt_time DESC LIMIT 1");

      $InsertarDatos0=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[0]->mt_time."'");
      $InsertarDatos1=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[1]->mt_time."'");
      $InsertarDatos2=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[2]->mt_time."'");
      $InsertarDatos3=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[3]->mt_time."'");
      $InsertarDatos4=DB::connection("telemetria")->select("SELECT * FROM log_biofil02 WHERE mt_time='".$Fechas[4]->mt_time."'");


      if ((!empty($Fechas[0]->mt_time) != !empty($FechaPowerbi[0]->mt_time))) {

          DB::connection("telemetria_local")->select("DELETE FROM log_biofil02");


          $InsertarDatos0=json_decode(json_encode($InsertarDatos0), true);
          $InsertarDatos1=json_decode(json_encode($InsertarDatos1), true);
          $InsertarDatos2=json_decode(json_encode($InsertarDatos2), true);
          $InsertarDatos3=json_decode(json_encode($InsertarDatos3), true);
          $InsertarDatos4=json_decode(json_encode($InsertarDatos4), true);


          DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos0);
          DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos1);
          DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos2);
          DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos3);
          DB::connection("telemetria_local")->table("log_biofil02")->insert($InsertarDatos4);

          DB::connection("powerbi_local")->select('call pb_bio02()');

        }

    
    }


    //  public function log_finning01()
    // {

    //   $Fechas = DB::connection("telemetria")->select("SELECT DISTINCT mt_time FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' ORDER BY mt_time DESC LIMIT 5");
    //   $FechaPowerbi_ = DB::connection("powerbi_local")->select("SELECT * FROM (SELECT * FROM (SELECT * FROM pbi_finn_dina WHERE fecha=(SELECT fecha FROM pbi_finn_dina ORDER BY fecha DESC LIMIT 1) ORDER BY fecha DESC) f ORDER BY hora DESC) H ORDER BY minuto DESC LIMIT 1;");

    //   if (isset($FechaPowerbi_[0]->fecha)) $FechaPowerbi=$FechaPowerbi_[0]->fecha." ".$FechaPowerbi_[0]->hora.":".$FechaPowerbi_[0]->minuto;
    //   if (!isset($FechaPowerbi_[0]->fecha)) $FechaPowerbi="";

    //     echo $TimeTransformed=date('Y-m-d g:i', strtotime($Fechas[0]->mt_time));
    //     echo "<br>";
    //     echo $FechaPowerbi;


    //   $InsertarDatos0=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' AND mt_time='".$Fechas[0]->mt_time."'");
    //   $InsertarDatos1=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' AND mt_time='".$Fechas[1]->mt_time."'");
    //   $InsertarDatos2=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' AND mt_time='".$Fechas[2]->mt_time."'");
    //   $InsertarDatos3=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' AND mt_time='".$Fechas[3]->mt_time."'");
    //   $InsertarDatos4=DB::connection("telemetria")->select("SELECT * FROM log_finning01 WHERE mt_name LIKE 'Dinamometro%' AND mt_time='".$Fechas[4]->mt_time."'");


    //   if ((!empty($TimeTransformed) != !empty($FechaPowerbi))) {

    //       DB::connection("telemetria_local")->select("DELETE FROM log_finning01");


    //       $InsertarDatos0=json_decode(json_encode($InsertarDatos0), true);
    //       $InsertarDatos1=json_decode(json_encode($InsertarDatos1), true);
    //       $InsertarDatos2=json_decode(json_encode($InsertarDatos2), true);
    //       $InsertarDatos3=json_decode(json_encode($InsertarDatos3), true);
    //       $InsertarDatos4=json_decode(json_encode($InsertarDatos4), true);


    //       DB::connection("telemetria_local")->table("log_finning01")->insert($InsertarDatos0);
    //       DB::connection("telemetria_local")->table("log_finning01")->insert($InsertarDatos1);
    //       DB::connection("telemetria_local")->table("log_finning01")->insert($InsertarDatos2);
    //       DB::connection("telemetria_local")->table("log_finning01")->insert($InsertarDatos3);
    //       DB::connection("telemetria_local")->table("log_finning01")->insert($InsertarDatos4);

    //       DB::connection("powerbi_local")->select('call pb_finning()');

    //     }

    
    // }
}
