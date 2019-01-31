<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PlantaLicanController extends Controller{
    public function index(){

    	$id=$_POST['id'];
        $tabla_asociada=$_POST['tabla_asociada'];
    	$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();

		$UltimaFecha=DB::connection("telemetria")
							->table("log_biofil01")
							->where("mt_name", "Biofiltro01--Consumo.Flujo")
							->orderBy("mt_time", "desc")
							->first();

	   $date= $UltimaFecha->mt_time; 
       $newDate = strtotime ( '-2 hours' , strtotime ($date) ) ; 
       $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

      $Datos= DB::connection("telemetria")
      							->table("log_biofil01")
      							->Where(function ($query) {
											    $query->where('mt_name', "Biofiltro01--Consumo.PH")
											          ->orwhere('mt_name', 'Biofiltro01--Consumo.Flujo');
											})
      							->where("mt_time",">", $newDate)
      							->orderBy("mt_time", "ASC")
      							->get();

      							$j=0;
      							$k=0;
      							for ($i=0; $i <count($Datos) ; $i++) { 
      								if ($Datos[$i]->mt_name=="Biofiltro01--Consumo.PH") {
      									$InfoGrafico["PH"]["mt_value"][$j]=$Datos[$i]->mt_value/100;
      									$InfoGrafico["PH"]["mt_time"][$j]=$Datos[$i]->mt_time;
      									$j++;
      								}
      								if ($Datos[$i]->mt_name=="Biofiltro01--Consumo.Flujo") {
      									$InfoGrafico["Flujo"]["mt_value"][$k]=$Datos[$i]->mt_value;
      									$InfoGrafico["Flujo"]["mt_time"][$k]=$Datos[$i]->mt_time;
      									$k++;
      								}
      							}



    	 return view("modals.PlantaLican", ["Instalacion" => $instalaciones, "Datos" => $InfoGrafico]);
    }
}
