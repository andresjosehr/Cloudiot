<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ParametrosController extends Controller
{
    public function InsertarParametroRiego(Request $Request){
    	$MinutosRiego=$_POST["Riego"];

    	DB::connection("telemetria")->table('mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.TiempoRiego', 
			     'mt_value' => $MinutosRiego
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton1").css("display", "block");
        	$(".vina-loadingg1").css("display", "none");
    	</script><?php
    }


    public function InsertarParametroReposo(Request $Request){
    	$MinutosReposo=$_POST["Reposo"];

    	DB::connection("telemetria")->table('mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.TiempoReposo', 
			     'mt_value' => $MinutosReposo
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton2").css("display", "block");
        	$(".vina-loadingg2").css("display", "none");
    	</script><?php
    }



    public function InsertarParametroRangoPH(Request $Request){
    	$RangoPH_Inicio=$_POST["RangoPH_Ini"];
    	$RangoPH_Fini=$_POST["RangoPH_Fini"];

    	DB::connection("telemetria")->table('mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.LimitePH_Bajo', 
			     'mt_value' => $RangoPH_Inicio
				]
			]);

    	DB::connection("telemetria")->table('mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.LimitePH_Alto', 
			     'mt_value' => $RangoPH_Fini
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton3").css("display", "block");
        	$(".vina-loadingg3").css("display", "none");
    	</script><?php

    }

    public function PausarReanudarParametros(Request $Request)
    {   
        if ($Request->proceso=="pausar") {

            $Datos = DB::table("cloudiot_mt_write")->where("mt_name", $Request->mt_name)->get();

            DB::table("parametros")->insert([
                                               "parametro" => $Datos[count($Datos)-1]->mt_name,
                                               "valor" => $Datos[count($Datos)-1]->mt_value
                                           ]);

            DB::table('cloudiot_mt_write')->insert([
                     'mt_name' => $Datos[count($Datos)-1]->mt_name, 
                     'mt_value' => 0
                    ]);

            return "swal('Listo', 'El proceso se ha realizado existosamente', 'success')";

        }

        if ($Request->proceso=="reanudar") {

            $Datos = DB::table("parametros")->where("parametro", $Request->mt_name)->get();

            DB::table("parametros")->where("parametro", $Request->mt_name)->delete();

            DB::table('cloudiot_mt_write')->insert([
                     'mt_name' => $Datos[0]->parametro, 
                     'mt_value' => $Datos[0]->valor
                    ]);

            return "swal('Listo', 'El proceso se ha realizado existosamente', 'success')";

        } 
    }
}
