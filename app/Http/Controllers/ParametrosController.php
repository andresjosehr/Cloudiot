<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ParametrosController extends Controller
{
    public function InsertarParametroRiego(Request $Request){
    	$MinutosRiego=$_POST["Riego"];

    	DB::table('cloudiot_mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.TiempoRiego', 
			     'mt_value' => $MinutosRiego
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton1").css("display", "block");
        	$(".loadingg1").css("display", "none");
    	</script><?php
    }


    public function InsertarParametroReposo(Request $Request){
    	$MinutosReposo=$_POST["Reposo"];

    	DB::table('cloudiot_mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.TiempoReposo', 
			     'mt_value' => $MinutosReposo
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton2").css("display", "block");
        	$(".loadingg2").css("display", "none");
    	</script><?php
    }



    public function InsertarParametroRangoPH(Request $Request){
    	$RangoPH_Inicio=$_POST["RangoPH_Ini"];
    	$RangoPH_Fini=$_POST["RangoPH_Fini"];

    	DB::table('cloudiot_mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.LimitePH_Bajo', 
			     'mt_value' => $RangoPH_Inicio
				]
			]);

    	DB::table('cloudiot_mt_write')->insert([
			    ['mt_name' => 'Biofiltro02--Consumo.LimitePH_Alto', 
			     'mt_value' => $RangoPH_Fini
				]
			]);

    	?><script>
    		swal("Listo", "Registro guardado exitosamente", "success");
    		$(".boton3").css("display", "block");
        	$(".loadingg3").css("display", "none");
    	</script><?php
    }
}
