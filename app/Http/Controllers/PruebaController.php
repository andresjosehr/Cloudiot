<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Request;
use DB;

class PruebaController extends Controller{


    public function index(){

      $datos= DB::connection("telemetria")
                        ->select("SELECT mt_time, mt_name, mt_value FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba3'
                                                                 OR mt_name='Biofiltro02--Consumo.FlujoMedidor1')
                                                                 AND mt_time > DATE_SUB('2019-02-07 09:00:00', INTERVAL 12 HOUR)
                                                                 ORDER BY mt_name ASC, mt_time ASC");
       $j=0;
       $k=0;
       $h=0;
       $g=0;
       for ($i=0; $i <count($datos); $i++) {

        if ($datos[$i]->mt_name=="Biofiltro02--Consumo.EstadoBomba1" || $datos[$i]->mt_name=="Biofiltro02--Consumo.EstadoBomba2" || $datos[$i]->mt_name=="Biofiltro02--Consumo.EstadoBomba3") {

            if ($datos[$i]->mt_value!="0") {

              $BombaActiva[$k][$j]["mt_name"] =   $datos[$i]->mt_name;
              $BombaActiva[$k][$j]["value"]   =   $datos[$i]->mt_value;
              $BombaActiva[$k][$j]["mt_time"] =   $datos[$i]->mt_time;
              $Tiempo[$k][$j]                 =   $datos[$i]->mt_time;
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
       }else{
        $Flujo[$g]["mt_name"]=$datos[$i]->mt_name;
        $Flujo[$g]["mt_time"]=$datos[$i]->mt_time;
        $Flujo[$g]["mt_value"]=$datos[$i]->mt_value;

        $FlujoEpa[$datos[$i]->mt_time]=$datos[$i]->mt_value;
        $g++;
      }
    
    } 



       if (isset($BombaActiva)) {
         
          for ($i=0; $i <count($BombaActiva); $i++) { 
              $FechaInicio[$i]                          =  reset($Tiempo[$i]);
              $BombasOperativas[$i]["FechaInicio"]      =  reset($Tiempo[$i]);
              $BombasOperativas[$i]["FechaFin"]         =  array_pop($Tiempo[$i]);
              $BombasOperativas[$i]["FechaPenultima"]   =  end($Tiempo[$i]);
              $BombasOperativas[$i]["MinutosOperativa"] =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $BombasOperativas[$i]["Bomba"]            =  $BombaActiva[$i][0]["mt_name"];
              $MinutosOperativa[$i]                     =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $Bomba[$i]                                =  $BombaActiva[$i][0]["mt_name"];

              if ($BombasOperativas[$i]["FechaPenultima"]==null) {
                $BombasOperativas[$i]["Flujo"]            = $FlujoEpa[$BombasOperativas[$i]["FechaFin"]]-$FlujoEpa[date ( 'Y-m-d H:i:s' , strtotime ( '-1 minute' , strtotime ($BombasOperativas[$i]["FechaFin"]) ))];
              } else{
                $BombasOperativas[$i]["Flujo"]            = $FlujoEpa[$BombasOperativas[$i]["FechaFin"]]-$FlujoEpa[$BombasOperativas[$i]["FechaPenultima"]];
              }

          }

          $valores = array_count_values($FechaInicio);

          $FechaInicio_=array_unique($FechaInicio);


          $k=0;
          for ($i=0; $i < count($FechaInicio); $i++) { 

            if (array_key_exists($i, $FechaInicio_)) {

              $Fecha_Inicio[$k]=$FechaInicio_[$i];
              $Minutos_Operativa[$k]=$MinutosOperativa[$i];
              $k++;
            }
          }

          $k=0;
          for ($i=0; $i < count($valores); $i++) { 
            
            $Fila[$i]["FechaInicio"]      =$Fecha_Inicio[$i];
            $Fila[$i]["MinutosOperativa"] =$Minutos_Operativa[$i];
            $Fila[$i]["Bombas"]           =$valores[$FechaInicio[$i]];
            $Fila[$i]["Flujo"]      =$BombasOperativas[$i]["Flujo"];
            
            $Fila[$i]["NumeroDeBomba"][1] =0;
            $Fila[$i]["NumeroDeBomba"][2] =0;
            $Fila[$i]["NumeroDeBomba"][3] =0;

            if ($Fila[$i]["Bombas"]==1) {

              $Fila[$i]["NumeroDeBomba"][$Bomba[$i][32]]=1;

            }  
            if ($Fila[$i]["Bombas"]==2 || $Fila[$i]["Bombas"]==3){

              $MasDeUnaBomba[$k]=$i;
              $k++;

            }

          }

       }

       if (isset($MasDeUnaBomba)) {
        for ($i=0; $i <count($MasDeUnaBomba) ; $i++) { 
          foreach ($BombasOperativas as $key => $val) {
                if ($val['FechaInicio'] === $Fila[$MasDeUnaBomba[$i]]["FechaInicio"]) {
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

        }
        if (isset($MasDeUnaBomba)) {

          $columns = array_column($Fila, 'FechaInicio');
          array_multisort($columns, SORT_DESC, $Fila);

        } else{
          $Fila=null;
        }

        return $Fila;
     
   }

}


class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

       $mt_time = explode(",", $_GET["mt_time"]);
       $mt_value = explode(",", $_GET["mt_value"]);


       for ($i=0; $i <count($mt_time) ; $i++) { 
         for ($k=0; $k < 2 ; $k++) { 
           $Datos[$i]["mt_time"]=$mt_time[$i];
           $Datos[$i]["mt_value"]=$mt_value[$i];
         }
       }

       return collect($Datos);



        // return collect([
        //     [
        //         'name' => $_GET["Valriable"],
        //         'surname' => 'Korop',
        //         'email' => 'povilas@laraveldaily.com',
        //         'twitter' => '@povilaskorop'
        //     ],
        //     [
        //         'name' => 'Taylor',
        //         'surname' => 'Otwell',
        //         'email' => 'taylor@laravel.com',
        //         'twitter' => '@taylorotwell'
        //     ]
        // ]);
    }

    public function headings(): array
    {
        return [
            'mt_value',
            'mt_time',
        ];
    }

}