<?php

namespace App\Http\Controllers;

use Request;
use DB;

class PruebaController extends Controller{
    public function index(){

		$datos= DB::connection("telemetria")
                        ->select("SELECT * FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba3')
                                                                 AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.EstadoBomba1' ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                 ORDER BY mt_name ASC, mt_time ASC");
       $j=0;
       $k=0;
       $h=0;
       for ($i=0; $i <count($datos); $i++) {

            if ($datos[$i]->mt_value!="0") {

              $BombaActiva[$k][$j]["mt_name"]=$datos[$i]->mt_name;
              $BombaActiva[$k][$j]["value"]=$datos[$i]->mt_value;
              $BombaActiva[$k][$j]["mt_time"]=$datos[$i]->mt_time;
              $Tiempo[$k][$j]=$datos[$i]->mt_time;
              $j++;
              $h++;

            }
            if ($datos[$i]->mt_value=="0") {
              $j=0;
            }
            if ($i!=0) {
              if ($datos[$i]->mt_value=="0" && $datos[$i-1]->mt_value=="1") {
                $k++;
              } 
            }   
       }

       if (isset($BombaActiva)) {
         
          for ($i=0; $i <count($BombaActiva); $i++) { 

              $BombasOperativas[$i]["FechaInicio"]=reset($Tiempo[$i]);
              $BombasOperativas[$i]["FechaFin"]=end($Tiempo[$i]);
              $BombasOperativas[$i]["MinutosOperativa"]=count($BombaActiva[$i]);
              $BombasOperativas[$i]["Bomba"]=$BombaActiva[$i][0]["mt_name"];

              $FechaInicio[$i]=reset($Tiempo[$i]);
              $MinutosOperativa[$i]=count($BombaActiva[$i]);
              $Bomba[$i]=$BombaActiva[$i][0]["mt_name"];

          }

          $valores = array_count_values($FechaInicio);

          for ($i=0; $i < count($valores); $i++) { 
            
            $Fila[$i]["FechaInicio"]=$FechaInicio[$i];
            $Fila[$i]["MinutosOperativa"]=$MinutosOperativa[$i];
            $Fila[$i]["Bombas"]=$valores[$FechaInicio[$i]];
          }

       }

        $i=0;
        foreach ($valores as $key => $value) {
           $Fecha[$i]=$key;
          $i++;
         } 


          
        $columns = array_column($Fila, 'FechaInicio');
        array_multisort($columns, SORT_DESC, $Fila);
          
        print_r($Fila);        


    }



}



         