<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class AlarmasController extends Controller{

    public function index(){

        $usuario =  Auth::user();
        $DatosInstalacion = DB::table("instalaciones")
                            ->get();

        $DatosAlarmas = DB::table("alarmas")
                                    ->get();


        return view("instalaciones.alarmas", ["DatosInstalacion" => $DatosInstalacion, "DatosAlarmas" => $DatosAlarmas, "Usuario" => $usuario]);
        
    }

    public function RegistrarIntervalo(Request $Request){
        $Intervalo  =   $_POST["Intervalo"];
        $id         =   $_POST["IdInstalacion"];

        DB::table('alarmas')->where("id", $id)
        ->update(
            ['valor' => $Intervalo]
        );

        return redirect("Alarmas");
    }

    public function EditarDatoAlarma(){
        $id_alarma      =       $_POST['id_alarma'];
        $id_instalacion =       $_POST['id_instalacion'];
        $mt_name        =       $_POST['mt_name'];
        $operador       =       $_POST['operador'];
        $valor          =       $_POST['valor'];


        DB::table('alarmas')->where("id", $id_alarma)
        ->update(
            ['id_instalacion' => $id_instalacion,
             'mt_name'        => $mt_name,
             'operador'       => $operador,
             'valor'         => $valor
            ]
        );

        return redirect("Alarmas");

    }


    public function Interval(){

            $Instalaciones = DB::table("instalaciones")
                            ->get();

            // for ($i=0; $i <count($Instalaciones); $i++) { 

            //     $Datos[$i] = DB::connection("telemetria")
            //                 ->table($Instalaciones[$i]->tabla_asociada)
            //                 ->orderBy("mt_time", "DESC")
            //                 ->first();

            //         $FechaActual        = new \DateTime();
            //         $FechaInstalacion   = new \DateTime($Datos[$i]->mt_time);

            //         $intervalo = $FechaActual->diff($FechaInstalacion);
            //         $DiferenciaDeTiempo=$intervalo->format('%Y-%m-%d %H:%i:%s');

            //         if ($DiferenciaDeTiempo>'00-0-0 00:15:00') {

            //            echo "Instalacion ".$Instalaciones[$i]->nombre." con alarma";
            //            echo "<br>";

            //         } else{

            //         }
            // }

            $Alarmas = DB::table("alarmas")
                                ->where("tipo", "2")
                                ->orderBy("id_instalacion", "ASC")
                                ->get();           

            $Instalaciones = DB::table("instalaciones")
                                    ->get(); 

            for ($i=0; $i <count($Instalaciones) ; $i++) { 
                 $tabla_asociada[$Instalaciones[$i]->id]=$Instalaciones[$i]->tabla_asociada;
                 $nombre_instalacion[$Instalaciones[$i]->id]=$Instalaciones[$i]->nombre;
             } 

            for ($i=0; $i <count($Alarmas) ; $i++) {

                $Alarma=DB::connection("telemetria")
                                ->table($tabla_asociada[$Alarmas[$i]->id_instalacion])
                                ->where("mt_name", $Alarmas[$i]->mt_name)
                                ->orderBy("mt_time", "DESC")
                                ->first();

                if ($Alarmas[$i]->operador=="<") {
                  if ($Alarma->mt_value<$Alarmas[$i]->valor) {
                    $this->ActivarAlarma($nombre_instalacion[$Alarmas[$i]->id_instalacion], $Alarma->mt_value);
                  }
                }

                if ($Alarmas[$i]->operador=="<=") {
                  if ($Alarma->mt_value<=$Alarmas[$i]->valor) {
                    $this->ActivarAlarma();
                  }
                }

                if ($Alarmas[$i]->operador=="==") {
                  if ($Alarma->mt_value==$Alarmas[$i]->valor) {
                    $this->ActivarAlarma();
                  }
                }
                if ($Alarmas[$i]->operador=="!=") {
                  if ($Alarma->mt_value!=$Alarmas[$i]->valor) {
                    $this->ActivarAlarma();
                  }
                }
                if ($Alarmas[$i]->operador==">") {
                  if ($Alarma->mt_value>$Alarmas[$i]->valor) {
                    $this->ActivarAlarma();
                  }
                }
                if ($Alarmas[$i]->operador==">=") {
                  if ($Alarma->mt_value>=$Alarmas[$i]->valor) {
                    $this->ActivarAlarma();
                  }
                }

            }
    }

    public function ActivarAlarma($nombre_instalacion, $dato){
      // mail(to, subject, message)
    }


    public function RegistrarDatoAlarma(Request $Request){

        $IdInstalacion  =   $_POST['IdInstalacion'];
        $mt_name        =   $_POST['mt_name'];
        $operador       =   $_POST['operador'];
        $valor          =   $_POST['valor'];


        DB::table('alarmas')
                ->insert(
                    ['id_instalacion'   => $IdInstalacion,
                     'tipo'             => "2",
                     'mt_name'          => $mt_name,
                     'operador'         => $operador,
                     'valor'            => $valor,
                    ]
                );

        return redirect("Alarmas");
        
    }
}
