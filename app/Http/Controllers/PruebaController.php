<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Finning;

use Request;
use DB;
use Auth;

class PruebaController extends Controller{


    public function index(){



       $datos = DB::connection('telemetria')
                                  ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02
                                                                       WHERE mt_name IN ('Biofiltro02--Consumo.EstadoBomba1',
                                                                               'Biofiltro02--Consumo.EstadoBomba2',
                                                                               'Biofiltro02--Consumo.EstadoBomba3',
                                                                               'Biofiltro02--Consumo.EstadoBomba4',
                                                                               'Biofiltro02--Consumo.EstadoBomba5',
                                                                               'Biofiltro02--Consumo.ErrorBomba1',
                                                                               'Biofiltro02--Consumo.ErrorBomba2',
                                                                               'Biofiltro02--Consumo.ErrorBomba3',
                                                                               'Biofiltro02--Consumo.ErrorBomba4',
                                                                               'Biofiltro02--Consumo.ErrorBomba5')
                                                                            GROUP BY mt_name LIMIT 10");




        for ($i=0; $i <count($datos)/2 ; $i++) { 

          if ($datos[$i]->mt_value==0) {
            $Opertiva[$i]="No Opertiva";
          } else{
            $Opertiva[$i]="Opertiva";
          }
        }

        $t=5;
        for ($i=0; $i <count($datos)/2 ; $i++) { 

          if ($datos[$t]->mt_value==0) {
            $ErrorBomba[$t]="No hay Error";
          } else{
            $ErrorBomba[$t]="Error";
          }
          $t++;
        }

        ?><script>

           var Operativa = '<?php echo json_encode($Opertiva); ?>';
           Operativa=JSON.parse(Operativa);

          var ErrorBomba = '<?php echo json_encode($ErrorBomba); ?>';
          ErrorBomba=JSON.parse(ErrorBomba);
          VinaBombas(Operativa, ErrorBomba)
        </script><?php
    
   }


   public function GraficarRelojes(Request $Request){


     $dato = $_POST["dato"];

     if ($dato==0) {
       $mt_name='Biofiltro02--Consumo.PH_Entrada';
       $titulo="PH Entrada";
     }
     if ($dato==1) {
       $mt_name='Biofiltro02--Consumo.ORP_Entrada';
       $titulo="ORP Entrada";
     }
     if ($dato==2) {
       $mt_name='Biofiltro02--Consumo.Conductividad_Entrada';
       $titulo="Conductividad Entrada";
     }
     if ($dato==3) {
       $mt_name='Biofiltro02--Consumo.PH_Salida';
       $titulo="PH Salida";
     }
     if ($dato==4) {
       $mt_name ='Biofiltro02--Consumo.ORP_Salida';
       $titulo  ="ORP Salida";
     }
     if ($dato==5) {
       $mt_name='Biofiltro02--Consumo.Conductividad_Salida';
       $titulo="PH Salida";
     }
     ?><script>var titulo='<?php echo $titulo; ?>'</script><?php

     if (isset($_POST["FechaInicio"])) {
       $newDate=$_POST["FechaInicio"];
       $FechaFin="AND mt_time <= '$_POST[FechaFin]' ";
     } else{

      $fecha = DB::connection('telemetria')
                                  ->select("SELECT mt_time FROM log_biofil02 WHERE mt_name='$mt_name' ORDER BY mt_time DESC LIMIT 1");
       $date= $fecha[0]->mt_time; 
       $newDate = strtotime ( '-24 hours' , strtotime ($date) ) ; 
       $newDate = date ( 'Y-m-j H:i:s' , $newDate); 
       $FechaFin="";
     }

     $Datos = DB::connection('telemetria')
                                   ->select("(SELECT * FROM log_biofil02 WHERE mt_name='$mt_name' AND mt_time >= '$newDate' $FechaFin ORDER BY mt_time DESC) ORDER BY mt_time ASC");


       $j=0;
       for ($i=0; $i <count($Datos) ; $i++) { 
         if ($Datos[$i]->mt_value!=0) {
           $mt_value[$j] =$Datos[$i]->mt_value/100;
           $mt_time[$j]  =$Datos[$i]->mt_time;
           $j++;
         }
       }



return array('nombre Instalacion' => "modals.VinaLuisFelipe.SubModal",
             "mt_time"                         => $mt_time,
             "mt_value"                        => $mt_value,
             "Titulo"                          => $titulo,
             "mt_name"                         => $mt_name,
             "Dato"                            => $dato
            );


				}

}


