<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class AlarmasController extends Controller{

    public function index(){

        $usuario =  Auth::user();
        $Datos = DB::table("instalaciones")
                            ->get();

        return view("instalaciones.alarmas", ["Datos" => $Datos, "Usuario" => $usuario]);
        
    }

    public function RegistrarIntervalo(Request $Request){
        $Intervalo  =   $_POST["Intervalo"];
        $id         =   $_POST["IdInstalacion"];

        DB::table('instalaciones')->where("id", $id)
        ->update(
            ['alarma_intervalo' => $Intervalo]
        );

        return redirect("Alarmas");
    }


    public function Interval(){

            $Instalaciones = DB::table("instalaciones")
                            ->get();

            for ($i=0; $i <count($Instalaciones); $i++) { 

                $Datos[$i] = DB::connection("telemetria")
                            ->table($Instalaciones[$i]->tabla_asociada)
                            ->orderBy("mt_time", "DESC")
                            ->first();

                    $FechaActual        = new \DateTime();
                    $FechaInstalacion   = new \DateTime($Datos[$i]->mt_time);

                    $intervalo = $FechaActual->diff($FechaInstalacion);
                    $DiferenciaDeTiempo=$intervalo->format('%Y-%m-%d %H:%i:%s');

                    if ($DiferenciaDeTiempo>'00-0-0 00:15:00') {

                       echo "Instalacion ".$Instalaciones[$i]->nombre." con alarma";
                       echo "<br>";

                    } else{

                    }
            }           



    }
}
