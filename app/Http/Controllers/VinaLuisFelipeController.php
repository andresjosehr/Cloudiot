<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Log;

class VinaLuisFelipeController extends Controller{
    public function index(){

    	$id=$_POST['id'];
        $tabla_asociada=$_POST['tabla_asociada'];

    	$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();

      $UltimaMedicion = DB::connection("telemetria")
                              ->table($tabla_asociada)
                                ->orderBy("mt_time", "DESC")
                                  ->first();


       $datos= DB::connection("telemetria")
                        ->select("SELECT * FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba3')
                                                                 AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.EstadoBomba1' ORDER BY mt_time DESC LIMIT 1), INTERVAL 3 HOUR)
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


      $columns = array_column($Fila, 'FechaInicio');
      array_multisort($columns, SORT_DESC, $Fila);

}

    	 return view("modals.VinaLuisFelipe", ["Instalacion" => $instalaciones, "UltimaMedicion" => $UltimaMedicion, "Bombas" => $Fila]);
    }

    public static function Calculos(Request $Request){

      $instalaciones = $_POST["instalacion"];


    

              $datos = DB::connection('telemetria')
                                  ->select("SELECT * FROM (SELECT * FROM $instalaciones[tabla_asociada] ORDER BY mt_time DESC) T1
                                                                       WHERE  (mt_name='Biofiltro02--Consumo.PH_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.PH_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                                                            GROUP BY mt_name");
    

        ?><script>
          var rango_orp = [];
          rango_orp[0]="-1000";
          rango_orp[1]="-600";
          rango_orp[2]="-200";
          rango_orp[3]="200";
          rango_orp[4]="600";
          rango_orp[5]="1000";

          var rango_ph = [];
          rango_ph[0]="0";
          rango_ph[1]="2.8";
          rango_ph[2]="5.6";
          rango_ph[3]="8.4";
          rango_ph[4]="11.2";
          rango_ph[5]="14";

          var rango_conductividad = [];
          rango_conductividad[0]="0";
          rango_conductividad[1]="20";
          rango_conductividad[2]="40";
          rango_conductividad[3]="60";
          rango_conductividad[4]="80";
          rango_conductividad[5]="100";


          var PHEntrada=("<?php echo $datos[4]->mt_value ?>"*10)/14;
          PHEntrada=PHEntrada/10;

          var PHSalida=("<?php echo $datos[5]->mt_value ?>"*10)/14;
          PHSalida=PHSalida/10;

          var ORPEntrada=("<?php echo $datos[2]->mt_value+1000 ?>")/20;
          var ORPSalida=("<?php echo $datos[3]->mt_value+1000 ?>")/20;


          
          RPM("PH", PHEntrada, "gauge0", "rpm-0", rango_ph, "PH");
          RPM("PH", ORPEntrada, "gauge1", "rpm-1", rango_orp, "Normal");
          RPM("PH", "<?php echo $datos[0]->mt_value ?>", "gauge2", "rpm-2", rango_conductividad, "Normal");
          RPM("PH", PHSalida, "gauge3", "rpm-3", rango_ph, "PH");
          RPM("PH", ORPSalida, "gauge4", "rpm-4", rango_orp, "Normal");
          RPM("PH", "<?php echo $datos[1]->mt_value ?>", "gauge5", "rpm-5", rango_conductividad, "Normal");
        </script><?php




        $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
         var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         Graficos("chart-lfe1","myChart1", mt_value, mt_time);
       </script><?php




       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.ORP_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         Graficos("chart-lfe2","myChart2", mt_value, mt_time);
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.Conductividad_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         Graficos("chart-lfe3","myChart3", mt_value, mt_value);
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.PH_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);

         Graficos("chart-lfe4","myChart4", mt_value, mt_time);
       </script><?php




       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.ORP_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);

         Graficos("chart-lfe5","myChart5", mt_value, mt_time);
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.Conductividad_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_value; 
            $newDate = date ( 'j H:i:s' , $date); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         Graficos("chart-lfe6","myChart6", mt_value, mt_time);
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("SELECT * FROM (SELECT * FROM log_biofil02 ORDER BY mt_time DESC) T1
                                                                       WHERE  (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                            OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                            OR mt_name='Biofiltro02--Consumo.EstadoBomba3'
                                                                            OR mt_name='Biofiltro02--Consumo.EstadoBomba4'
                                                                            OR mt_name='Biofiltro02--Consumo.EstadoBomba5'
                                                                            OR mt_name='Biofiltro02--Consumo.ErrorBomba1'
                                                                            OR mt_name='Biofiltro02--Consumo.ErrorBomba2'
                                                                            OR mt_name='Biofiltro02--Consumo.ErrorBomba3'
                                                                            OR mt_name='Biofiltro02--Consumo.ErrorBomba4'
                                                                            OR mt_name='Biofiltro02--Consumo.ErrorBomba5')
                                                                            GROUP BY mt_name");

        for ($i=0; $i <count($datos)/2 ; $i++) { 

          if ($datos[$i]->mt_value==0) {
            $Opertiva[$i]="No Opertiva";
          } else{
            $Opertiva[$i]="Opertiva";
          }
        }

        for ($i=5; $i <count($datos)/2 ; $i++) { 

          if ($datos[$i]->mt_value==0) {
            $ErrorBomba[$i]="No hay Error";
          } else{
            $ErrorBomba[$i]="Error";
          }
        }

        ?><script>
          Bombas("<?php $Operativa ?>","<?php $ErrorBomba ?>")
        </script><?php

       
    
   }


   public function GraficarRelojes(){


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
       $mt_name='Biofiltro02--Consumo.ORP_Salida';
       $titulo="ORP Salida";
     }
     if ($dato==5) {
       $mt_name='Biofiltro02--Consumo.Conductividad_Salida';
       $titulo="PH Salida";
     }

     $fecha = DB::connection('telemetria')
                                  ->select("SELECT mt_time FROM log_biofil02 WHERE mt_name='$mt_name' ORDER BY mt_time DESC LIMIT 1");

       $date= $fecha[0]->mt_time; 
       $newDate = strtotime ( '-24 hours' , strtotime ($date) ) ; 
       $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

        $Datos = DB::connection('telemetria')
                                   ->select("(SELECT * FROM log_biofil02 WHERE mt_name='$mt_name' AND mt_time >= '$newDate' ORDER BY mt_time DESC) ORDER BY mt_time ASC");


       $j=0;
       for ($i=0; $i <count($Datos) ; $i++) { 
         if ($Datos[$i]->mt_value!=0) {
           $mt_value[$j]=$Datos[$i]->mt_value;
           $mt_time[$j]=$Datos[$i]->mt_time;
           $j++;
         }
       }

       return view("modals.VinaLuisFelipe.SubModal", ["mt_time" => $mt_time, "mt_value" => $mt_value, "Titulo" => $titulo, "mt_name" => $mt_name]);
   }


   public function GraficarRelojesFechaPersonalizada(Request $Request){
     
     $FechaInicio=$_POST["FechaInicio"];
     $FechaFin=$_POST["FechaFin"];
     $mt_name=$_POST["mt_name"];

     $Datos = DB::connection('telemetria')
                                   ->select("SELECT * FROM log_biofil02 WHERE mt_name='$mt_name' AND mt_time >= '$FechaInicio' AND mt_time<='$FechaFin' ORDER BY mt_time DESC");


      for ($i=0; $i <count($Datos) ; $i++) { 
         $mt_value[$i]=$Datos[$i]->mt_value;
         $mt_time[$i]=$Datos[$i]->mt_time;
       }

     ?><script>
       ChartSubModal("<?php $mt_time ?>", "<?php $mt_value ?>");
     </script><?php
   }

}
