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

          $k=0;
          for ($i=0; $i < count($valores); $i++) { 
            
            $Fila[$i]["FechaInicio"]=$FechaInicio[$i];
            $Fila[$i]["MinutosOperativa"]=$MinutosOperativa[$i];
            $Fila[$i]["Bombas"]=$valores[$FechaInicio[$i]];

            $Fila[$i]["NumeroDeBomba"][1]=0;
            $Fila[$i]["NumeroDeBomba"][2]=0;
            $Fila[$i]["NumeroDeBomba"][3]=0;

            if ($Fila[$i]["Bombas"]==1) {

              $Fila[$i]["NumeroDeBomba"][$Bomba[$i][32]]=1;

            }  
            if ($Fila[$i]["Bombas"]==2 || $Fila[$i]["Bombas"]==3){

              $MasDeUnaBomba[$k]=$i;
              $k++;

            }

          }

       }


        // $i=0;
        // foreach ($valores as $key => $value) {
        //    $Fecha[$i]=$key;
        //   $i++;
        //  } 


         // for ($i=0; $i <count($Fecha) ; $i++) { 
         //  if ($Fecha[]) {
         //    # code...
         //  }
         //   $FechaDeConsulta[$i]
         // }


          
        

        // print_r($Fila);

        for ($i=0; $i <count($MasDeUnaBomba) ; $i++) { 
          foreach ($BombasOperativas as $key => $val) {
                if ($val['FechaInicio'] === $BombasOperativas[$MasDeUnaBomba[$i]]["FechaInicio"]) {
                      if ($val["Bomba"][32]==1) {
                         $Fila[$MasDeUnaBomba[$i]]["NumeroDeBomba"][1]=1;
                      }
                      if ($val["Bomba"][32]==2) {
                         $Fila[$MasDeUnaBomba[$i]]["NumeroDeBomba"][2]=1;
                      }
                      if ($val["Bomba"][32]==3) {
                         $Fila[$MasDeUnaBomba[$i]]["NumeroDeBomba"][3]=1;
                      }
               }
           }
        }

        $columns = array_column($Fila, 'FechaInicio');
        array_multisort($columns, SORT_DESC, $Fila);

        return $Fila;


    }



}



         