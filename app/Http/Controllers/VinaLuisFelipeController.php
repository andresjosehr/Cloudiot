<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Log;
use View;
use Storage;
use Illuminate\Http\Response;


use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VinaLuisFelipeController extends Controller{

  public function ExportarXML()
    {


      date_default_timezone_set('Australia/Melbourne');
      $date = date('m_d_Y_h_i_s_a', time());


        
        $output = View::make('welcome')->render();

        $myfile = fopen($_SERVER["DOCUMENT_ROOT"]."/".$_SERVER["REQUEST_URI"]."/../xml/Vina/".$date.".xml", "w") or die("Unable to open file!");

        $txt = $output;

        fwrite($myfile, $txt);

        fclose($myfile);
    }



    public function index(){

      $id=$_POST['id'];
      $tabla_asociada=$_POST['tabla_asociada'];

      $instalaciones = DB::table('instalaciones')
                        ->where("id", $id)
                          ->first();

       $UltimaMedicion = DB::connection("telemetria")
                               ->select("SELECT * FROM log_biofil02 ORDER BY mt_time DESC LIMIT 1");


           

        return view("modals.VinaLuisFelipe", ["Instalacion" => $instalaciones, "UltimaMedicion" => $UltimaMedicion, "Usuario" => Auth::user(), "Rol" => $_POST['rol']]);
    }

    public function MostrarBombas(){
      $datos= DB::connection("telemetria")
                        ->select("(SELECT mt_name, mt_value, mt_time FROM log_biofil02 WHERE mt_name IN ('Biofiltro02--Consumo.EstadoBomba1',
                                                                        'Biofiltro02--Consumo.EstadoBomba2',
                                                                        'Biofiltro02--Consumo.EstadoBomba3',
                                                                       'Biofiltro02--Consumo.FlujoMedidor1')
                                                                         AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_value<>0 AND mt_name IN ('Biofiltro02--Consumo.EstadoBomba1', 'Biofiltro02--Consumo.EstadoBomba2', 'Biofiltro02--Consumo.EstadoBomba3') ORDER BY mt_time DESC LIMIT 1), INTERVAL 3 HOUR))
                                                                         ORDER BY mt_name ASC, mt_time ASC;");
          $Determinante="No hay nada papa";

          


                        
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
       }  else{
        $Flujo[$g]["mt_name"]=$datos[$i]->mt_name;
        $Flujo[$g]["mt_time"]=$datos[$i]->mt_time;
        $Flujo[$g]["mt_value"]=$datos[$i]->mt_value;

        $FlujoEpa[$datos[$i]->mt_time]=$datos[$i]->mt_value;
        $g++;
      }
    
    } 

    
    if ($h!=0) {
      


       if (isset($BombaActiva)) {
         
                for ($i=0; $i <count($BombaActiva); $i++) { 
                    $FechaInicio[$i]                          =  reset($Tiempo[$i]);
                    $FechaFin[$i]["date"]  =  end($Tiempo[$i]);
                    $BombasOperativas[$i]["FechaInicio"]      =  reset($Tiempo[$i]);
                    $BombasOperativas[$i]["FechaFin"]         =  end($Tiempo[$i]);
                    $BombasOperativas[$i]["MinutosOperativa"] =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
                    $BombasOperativas[$i]["Bomba"]            =  $BombaActiva[$i][0]["mt_name"];
                    $MinutosOperativa[$i]                     =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
                    $Bomba[$i]                                =  $BombaActiva[$i][0]["mt_name"];  
                }



                $i=0;
                foreach ($FechaFin as $key => $part) {
                     $sort[$i] = strtotime($part["date"]);
                     $i++;
                }
                array_multisort($sort, SORT_DESC, $FechaFin);
                for ($i=0; $i <count($FechaFin); $i++) { 
                  $FechaFin_[$i]=$FechaFin[$i]["date"];
                }
                unset($FechaFin);
                $FechaFin_=array_count_values($FechaFin_);

                $i=0;
                foreach ($FechaFin_ as $key => $value) {
                 $FechaFin[$i]=$key;
                 $i++;
                }


                for ($i=0; $i <count($FechaFin) ; $i++) { 
                  if ($i < count($FechaFin)-1) {
                      $BombasOperativas[$i]["Flujo"]=$FlujoEpa[$FechaFin[$i]]-$FlujoEpa[$FechaFin[$i+1]];
                    }
                }
                $BombasOperativas[count($FechaFin)-1]["Flujo"]=0;
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
                  // $Fila[$i]["Flujo"]      =$BombasOperativas[$i]["Flujo"];
                  
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

              for ($i=0; $i < count($valores); $i++) { 
                $Fila[$i]["Flujo"]=$BombasOperativas[$i]["Flujo"];
              }
              unset($Fila[count($Fila)-1]);
              $ImprimirBombas=true;
          } else{
            $ImprimirBombas=false;
            $Fila=null;
          }

          return view("modals.VinaLuisFelipe.BombasDefault", ["Bombas" => $Fila, "ImprimirBombas" => $ImprimirBombas,]);
    }

    public function ConsultarParametros()
    {
      $Parametros= DB::connection("telemetria")
                                    ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02
                                                                       WHERE mt_name IN ('Biofiltro02--Consumo.TiempoRiego',
                                                                            'Biofiltro02--Consumo.TiempoReposo',
                                                                            'Biofiltro02--Consumo.LimitePH_Bajo',
                                                                            'Biofiltro02--Consumo.LimitePH_Alto')
                                                                            GROUP BY mt_name;");

      $ParametrosPausados = DB::table("parametros")->get();

    return view("modals.VinaLuisFelipe.parametros", ["ParametrosPausados" => $ParametrosPausados, "Parametros" => $Parametros, "Rolito" => DB::table("instalaciones_asignadas")->select("rol")->where("id_usuario", Auth::user()->id)->where("id_instalacion", "2")->first()]);
    }


    public static function MostrarRelojes(Request $Request){

      $instalaciones = $_POST["instalacion"];

    

        $datos = DB::connection('telemetria')
                                  ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02
                                                                       WHERE  (mt_name='Biofiltro02--Consumo.PH_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.PH_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                                                            GROUP BY mt_name");
    

        ?><script>
          var rango_orp = [];
          rango_orp[0]  ="-1000";
          rango_orp[1]  ="-600";
          rango_orp[2]  ="-200";
          rango_orp[3]  ="200";
          rango_orp[4]  ="600";
          rango_orp[5]  ="1000";

          var rango_ph = [];
          rango_ph[0]  ="0";
          rango_ph[1]  ="2.8";
          rango_ph[2]  ="5.6";
          rango_ph[3]  ="8.4";
          rango_ph[4]  ="11.2";
          rango_ph[5]  ="14";

          var rango_conductividad = [];
          rango_conductividad[0]  ="0";
          rango_conductividad[1]  ="20";
          rango_conductividad[2]  ="40";
          rango_conductividad[3]  ="60";
          rango_conductividad[4]  ="80";
          rango_conductividad[5]  ="100";


          var PHEntrada  =("<?php echo $datos[4]->mt_value ?>"*10)/14;
          PHEntrada      =PHEntrada/10;
          
          var PHSalida   =("<?php echo $datos[5]->mt_value ?>"*10)/14;
          PHSalida       =PHSalida/10;

          var ValorReal_PHEntrada   ="<?php echo $datos[4]->mt_value/100 ?>";
          var ValorReal_PHSalida   ="<?php echo $datos[5]->mt_value/100 ?>";

          var ValorReal_ORPEntrada ="<?php echo $datos[2]->mt_value ?>";
          var ValorReal_ORPSalida  ="<?php echo $datos[3]->mt_value ?>";
          
          var ORPEntrada =("<?php echo $datos[2]->mt_value+1000 ?>")/20;
          var ORPSalida  =("<?php echo $datos[3]->mt_value+1000 ?>")/20;

          var ConductividadEntrada="<?php echo $datos[0]->mt_value/100; ?>";
          var ConductividadSalida="<?php echo $datos[1]->mt_value/100; ?>";


          
          VinaRPM("PH", PHEntrada, "gauge0", "rpm-0", rango_ph, "PH", ValorReal_PHEntrada);
          VinaRPM("ORP", ORPEntrada, "gauge1", "rpm-1", rango_orp, "Normal", ValorReal_ORPEntrada);
          VinaRPM("Conductividad", ConductividadEntrada, "gauge2", "rpm-2", rango_conductividad, "Normal", "<?php echo $datos[0]->mt_value/100 ?>");
          VinaRPM("PH", PHSalida, "gauge3", "rpm-3", rango_ph, "PH", ValorReal_PHSalida);
          VinaRPM("ORP", ORPSalida, "gauge4", "rpm-4", rango_orp, "Normal", ValorReal_ORPSalida);
          VinaRPM("Conductividad", ConductividadSalida, "gauge5", "rpm-5", rango_conductividad, "Normal", "<?php echo $datos[1]->mt_value/100 ?>");


        </script><?php
    }


    public function Entrada1(Request $Request)
    {
      $instalaciones = $_POST["instalacion"];

       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
         var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);

         VinaGraficos("chart-lfe1","myChart1", mt_value, mt_time);
       </script><?php
    }

    public function Entrada2(Request $Request)
    {
      $instalaciones = $_POST["instalacion"];
       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.ORP_Entrada' ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         VinaGraficos("chart-lfe2","myChart2", mt_value, mt_time);
       </script><?php

    }

    public function Entrada3(Request $Request)
    {
      $instalaciones = $_POST["instalacion"];

       $datos = DB::connection('telemetria')

                                  ->select("(SELECT * FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.Conductividad_Entrada' ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");
        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         VinaGraficos("chart-lfe3","myChart3", mt_value, mt_value);
       </script><?php

    }

    public function Salida1(Request $Request)
    {
      $instalaciones = $_POST["instalacion"];

         $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.PH_Salida' 
                                                 ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);

         VinaGraficos("chart-lfe4","myChart4", mt_value, mt_time);
       </script><?php



    }

    public function Salida2(Request $Request)
    {
            $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.ORP_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);

         VinaGraficos("chart-lfe5","myChart5", mt_value, mt_time);
       </script><?php
    }

    public function Salida3(Request $Request)
    {
      $instalaciones = $_POST["instalacion"];


      $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.Conductividad_Salida' 
                                                   ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value/100;

            $date=  $datos[$i]->mt_time; 
            $newDate = date_format(date_create($date), 'j H:i:s'); 

            $mt_time[$i] =  $newDate;
        }

       ?><script>
        var mt_value = '<?php echo json_encode($mt_value); ?>';
         mt_value=JSON.parse(mt_value);

         var mt_time = '<?php echo json_encode($mt_time); ?>';
         mt_time=JSON.parse(mt_time);
         VinaGraficos("chart-lfe6","myChart6", mt_value, mt_time);
       </script><?php


    }

    public function Calculos(Request $Request){

      $instalaciones = $_POST["instalacion"];
  

  

       $datos = DB::connection('telemetria')
                                  ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02
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

       return view("modals.VinaLuisFelipe.SubModal", ["mt_time" => $mt_time, "mt_value" => $mt_value, "Titulo" => $titulo, "mt_name" => $mt_name, "Dato" => $dato]);
   }


   public function GraficarRelojesFechaPersonalizada(Request $Request){
     
     $FechaInicio =$_POST["FechaInicio"];
     $FechaFin    =$_POST["FechaFin"];
     $mt_name     =$_POST["mt_name"];

     $Datos = DB::connection('telemetria')
                                   ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02 WHERE mt_name='$mt_name' AND mt_time >= '$FechaInicio' AND mt_time<='$FechaFin' ORDER BY mt_time DESC");


      for ($i=0; $i <count($Datos) ; $i++) { 
         $mt_value[$i] =$Datos[$i]->mt_value;
         $mt_time[$i]  =$Datos[$i]->mt_time;
       }

     ?><script>
       ChartSubModal("<?php $mt_time ?>", "<?php $mt_value ?>");
     </script><?php
   }

   public function GraficarPHFechaPersonalizado(Request $Request){
     $FechaInicio = $_POST["FechaInicio"];
     $FechaFin    = $_POST["FechaFin"];

     $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value,
                                  mt_time
                                   FROM log_biofil02 
                                     WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' 
                                           AND DATE(mt_time)>='$FechaInicio' AND DATE(mt_time)<='$FechaFin'
                                             GROUP BY DAY(mt_time) 
                                               ORDER BY mt_time ASC");

        $NumeroRegistros = DB::connection("telemetria")
                            ->select("SELECT mt_time ,COUNT(*) Registros
                                        FROM log_biofil02 WHERE 
                                        DATE(mt_time)>='$FechaInicio' AND DATE(mt_time)<='$FechaFin' 
                                        AND mt_name='Biofiltro02--Consumo.PH_Entrada'
                                        GROUP BY day(mt_time)
                                        ORDER BY mt_time ASC");


        $DatosDiariosSalida = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value,
                                  mt_time
                                   FROM log_biofil02 
                                     WHERE mt_name='Biofiltro02--Consumo.PH_Salida' 
                                           AND DATE(mt_time)>='$FechaInicio' AND DATE(mt_time)<='$FechaFin'
                                             GROUP BY DAY(mt_time) 
                                               ORDER BY mt_time ASC");

        $NumeroRegistrosSalida = DB::connection("telemetria")
                            ->select("SELECT mt_time ,COUNT(*) Registros
                                        FROM log_biofil02 WHERE 
                                        DATE(mt_time)>='$FechaInicio' AND DATE(mt_time)<='$FechaFin' 
                                        AND mt_name='Biofiltro02--Consumo.PH_Salida'
                                        GROUP BY day(mt_time)
                                        ORDER BY mt_time ASC");


        for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            $mt_time[$i]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
            $mt_value[$i]=number_format(($DatosDiarios[$i]->mt_value/$NumeroRegistros[$i]->Registros)/100, 2);

            $mt_value_salida[$i]=number_format(($DatosDiariosSalida[$i]->mt_value/$NumeroRegistrosSalida[$i]->Registros)/100, 2);
          }


            ?><script>
                var mt_value = '<?php echo json_encode($mt_value); ?>';
                mt_value=JSON.parse(mt_value);
                mt_value_ph=mt_value;

                var mt_time = '<?php echo json_encode($mt_time); ?>';
                mt_time=JSON.parse(mt_time);
                mt_time_ph=mt_time;

                var mt_value_salida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_salida=JSON.parse(mt_value_salida);
                mt_value_salida_ph = mt_value_salida

                function DescargarExcelPH() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_ph+'&mt_value='+mt_value_ph+'&mt_value_salida='+mt_value_salida_ph+"&n1=PH Entrada&n2=PH Salida", '_blank' )
                 }
          $(".loader-insta").css("display", "none");
          $("#ph-bar-chart").remove();
          $("#ph-bar-chart-div").html('<canvas id="ph-bar-chart" width="400" height="70"></canvas>');
          GraficarPHDiarioJS(mt_time, mt_value, mt_value_salida);
          </script><?php
   }

   public function GraficarPHDiario(){


     $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value,
                                  mt_time
                                   FROM log_biofil02 
                                  
                                     WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' 
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY DAY(mt_time) 
                                               ORDER BY mt_time ASC");

        $NumeroRegistros = DB::connection("telemetria")
                            ->select("SELECT mt_time ,COUNT(*) Registros
                                        FROM log_biofil02 
                                       
                                         WHERE mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY) AND mt_name='Biofiltro02--Consumo.PH_Entrada'
                                        GROUP BY day(mt_time)
                                        ORDER BY mt_time ASC");

        $DatosDiariosSalida = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value,
                                  mt_time
                                   FROM log_biofil02 
                                  
                                     WHERE mt_name='Biofiltro02--Consumo.PH_Salida' 
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Salida' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY DAY(mt_time) 
                                               ORDER BY mt_time ASC");

        $NumeroRegistrosSalida = DB::connection("telemetria")
                            ->select("SELECT mt_time ,COUNT(*) Registros
                                        FROM log_biofil02 
                                       
                                         WHERE mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.PH_Salida' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY) AND mt_name='Biofiltro02--Consumo.PH_Salida'
                                        GROUP BY day(mt_time)
                                        ORDER BY mt_time ASC");

          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            $mt_time[$i]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
            $mt_value[$i]=number_format(($DatosDiarios[$i]->mt_value/$NumeroRegistros[$i]->Registros)/100, 2);

            $mt_time_salida[$i]=date_format(date_create($DatosDiariosSalida[$i]->mt_time), 'm-d');
            $mt_value_salida[$i]=number_format(($DatosDiariosSalida[$i]->mt_value/$NumeroRegistrosSalida[$i]->Registros)/100, 2);
          }


            ?><script>
                var mt_value = '<?php echo json_encode($mt_value); ?>';
                mt_value=JSON.parse(mt_value);
                mt_value_ph=mt_value;

                var mt_time = '<?php echo json_encode($mt_time); ?>';
                mt_time=JSON.parse(mt_time);
                mt_time_ph=mt_time;

                var mt_value_salida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_salida=JSON.parse(mt_value_salida);
                mt_value_salida_ph = mt_value_salida

                var mt_time_salida = '<?php echo json_encode($mt_time_salida); ?>';
                mt_time_salida=JSON.parse(mt_time_salida);

                function DescargarExcelPH() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_ph+'&mt_value='+mt_value_ph+'&mt_value_salida='+mt_value_salida_ph+"&n1=PH Entrada&n2=PH Salida", '_blank' )
                 }

          GraficarPHDiarioJS(mt_time, mt_value, mt_value_salida);
          </script><?php
   }

   public function GraficarFlujo(Request $Request){


    $PrimerosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil02 
                                                WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' 
                                                      AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil02 
                                                  WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' 
                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras) ; $i++) { 
          $GraficoBarras[$i]["mt_time"]=$SegundosDatosBarras[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j')) {
            $GraficoBarras[$i]["mt_value"]=0;
          } else{
            $GraficoBarras[$i]["mt_value"]=$SegundosDatosBarras[$i]->mt_value-$PrimerosDatosBarras[$k]->mt_value;
            $k++;
          }
        }


        ?><script>
          var i=0;
           var mt_time = [];
           var mt_value = [];

           var mt_time_flujos = [];
           var mt_value_flujos = [];
          <?php for($i=0; $i<count($GraficoBarras); $i++){ ?>

             mt_time[i]='<?php echo date_format(date_create($GraficoBarras[$i]['mt_time']), 'm-j') ?>';
             mt_value[i]='<?php echo $GraficoBarras[$i]['mt_value'] ?>';

             mt_time_flujos[i] = "<?php echo $GraficoBarras[$i]['mt_time'] ?>";
             mt_value_flujos = mt_value;
             i++;


          <?php } ?>


          GraficarFlujo(mt_time, mt_value, "flujo-bar-chart", "Flujo de Riego", "1");

          function DescargarExcelFlujos() {
             window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_flujos+'&mt_value='+mt_value_flujos+"&n1=Flujo&n2=.", '_blank' )
         }
        </script><?php

        $PrimerosDatosBarras2 = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil02 
                                                WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' 
                                                      AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras2 = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil02 
                                                  WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' 
                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras2) ; $i++) { 

          $GraficoBarras2[$i]["mt_time"]=$SegundosDatosBarras2[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras2[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras2[$i]->mt_time), 'm-j')) {
            $GraficoBarras2[$i]["mt_value"]=0;
          } else{
            $GraficoBarras2[$i]["mt_value"]=$SegundosDatosBarras2[$i]->mt_value-$PrimerosDatosBarras2[$k]->mt_value;
            $k++;
          }

          // if ($GraficoBarras2[$i]["mt_value"]<0) {
          //   $GraficoBarras2[$i]["mt_value"]=0;
          // }
        }


        ?><script>
          var i=0;
           var mt_time2 = [];
           var mt_value2 = [];

           var mt_time_flujos2 = [];
           var mt_value_flujos2 = [];
          <?php for($i=0; $i<count($GraficoBarras2); $i++){ ?>

             mt_time2[i]='<?php echo date_format(date_create($GraficoBarras2[$i]['mt_time']), 'm-j') ?>';
             mt_value2[i]='<?php echo $GraficoBarras2[$i]['mt_value'] ?>';

             mt_time_flujos2[i] = "<?php echo $GraficoBarras2[$i]['mt_time'] ?>";
             mt_value_flujos2 = mt_value2;
             i++;


          <?php } ?>


          GraficarFlujo(mt_time2, mt_value2, "flujo-bar-chart2", "Flujo de Rebalse", "2");

        </script><?php

   }

   public function GraficarFlujoFechaPersonalizado(Request $Request){

    $FechaInicio = $_POST["FechaInicio"];
    $FechaFin    = $_POST["FechaFin"];

    $date= $FechaFin; 
       $newDate = strtotime ( '+1 day' , strtotime ($date) ) ; 
       $newDate = date ( 'Y-m-j' , $newDate); 

     $PrimerosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil02 
                                                WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' 
                                                      AND mt_time>=date('$FechaInicio') AND mt_time <= date('$newDate')
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil02 
                                                  WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor1' 
                                                        AND mt_time>=date('$FechaInicio') AND mt_time <= date('$newDate')
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        $j=0;
        for ($i=0; $i <count($SegundosDatosBarras) ; $i++) { 
          $mt_time[$i]=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j');

          if (date_format(date_create($PrimerosDatosBarras[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j')) {
            $mt_value[$j]=0;
            $j++;
          } else{
            $mt_value[$j]=$SegundosDatosBarras[$i]->mt_value-$PrimerosDatosBarras[$k]->mt_value;
            $j++;
            $k++;
          }
        }

        ?><script>var i=0;</script><?php
          ?><script>
            var mt_value_ = '<?php echo json_encode($mt_value); ?>';
            mt_value_=JSON.parse(mt_value_);

            var mt_time_ = '<?php echo json_encode($mt_time); ?>';
            mt_time_=JSON.parse(mt_time_);
          </script><?php
        ?><script>
          $(".loader-insta").css("display", "none");
          $("#flujo-bar-chart").remove();
          $("#flujo-bar-chart-div").html('<canvas id="flujo-bar-chart" width="400" height="70"></canvas>');

          GraficarFlujo(mt_time_, mt_value_, "flujo-bar-chart2", "Flujo de Rebalse", "1");

          function DescargarExcelFlujos() {
               window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_+'&mt_value='+mt_value_+"&n1=Flujo&n2=.", '_blank' )
           }
           
          </script><?php

           $PrimerosDatosBarras2 = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil02 
                                                WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' 
                                                      AND mt_time>=date('$FechaInicio') AND mt_time <= date('$newDate')
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras2 = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil02 
                                                  WHERE mt_name='Biofiltro02--Consumo.FlujoMedidor2' 
                                                        AND mt_time>=date('$FechaInicio') AND mt_time <= date('$newDate')
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras2) ; $i++) { 

          $GraficoBarras2[$i]["mt_time"]=$SegundosDatosBarras2[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras2[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras2[$i]->mt_time), 'm-j')) {
            $GraficoBarras2[$i]["mt_value"]=0;
          } else{
            $GraficoBarras2[$i]["mt_value"]=$SegundosDatosBarras2[$i]->mt_value-$PrimerosDatosBarras2[$k]->mt_value;
            $k++;
          }

          // if ($GraficoBarras2[$i]["mt_value"]<0) {
          //   $GraficoBarras2[$i]["mt_value"]=0;
          // }
        }


        ?><script>
          var i=0;
           var mt_time2 = [];
           var mt_value2 = [];

           var mt_time_flujos2 = [];
           var mt_value_flujos2 = [];
          <?php for($i=0; $i<count($GraficoBarras2); $i++){ ?>

             mt_time2[i]='<?php echo date_format(date_create($GraficoBarras2[$i]['mt_time']), 'm-j') ?>';
             mt_value2[i]='<?php echo $GraficoBarras2[$i]['mt_value'] ?>';

             mt_time_flujos2[i] = "<?php echo $GraficoBarras2[$i]['mt_time'] ?>";
             mt_value_flujos2 = mt_value2;
             i++;


          <?php } ?>


          GraficarFlujo(mt_time2, mt_value2, "flujo-bar-chart2", "Flujo de Rebalse", "2");

        </script><?php
   }

   public function ListarBombas(){

    $datos= DB::connection("telemetria")
                        ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba3'
                                                                 OR mt_name='Biofiltro02--Consumo.FlujoMedidor1')
                                                                 AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1' OR mt_name='Biofiltro02--Consumo.EstadoBomba2' OR mt_name='Biofiltro02--Consumo.EstadoBomba3') AND mt_value<>0 ORDER BY mt_time DESC LIMIT 1), INTERVAL 12 HOUR)
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
       }  else{
        $Flujo[$g]["mt_name"]=$datos[$i]->mt_name;
        $Flujo[$g]["mt_time"]=$datos[$i]->mt_time;
        $Flujo[$g]["mt_value"]=$datos[$i]->mt_value;

        $FlujoEpa[$datos[$i]->mt_time]=$datos[$i]->mt_value;
        $g++;
      }
    
    } 



if ($h!=0) {

       if (isset($BombaActiva)) {
         
          for ($i=0; $i <count($BombaActiva); $i++) { 
              $FechaInicio[$i]                          =  reset($Tiempo[$i]);
              $FechaFin[$i]["date"]  =  end($Tiempo[$i]);
              $BombasOperativas[$i]["FechaInicio"]      =  reset($Tiempo[$i]);
              $BombasOperativas[$i]["FechaFin"]         =  end($Tiempo[$i]);
              $BombasOperativas[$i]["MinutosOperativa"] =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $BombasOperativas[$i]["Bomba"]            =  $BombaActiva[$i][0]["mt_name"];
              $MinutosOperativa[$i]                     =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $Bomba[$i]                                =  $BombaActiva[$i][0]["mt_name"];  
          }



          $i=0;
          foreach ($FechaFin as $key => $part) {
               $sort[$i] = strtotime($part["date"]);
               $i++;
          }
          array_multisort($sort, SORT_DESC, $FechaFin);
          for ($i=0; $i <count($FechaFin); $i++) { 
            $FechaFin_[$i]=$FechaFin[$i]["date"];
          }
          unset($FechaFin);
          $FechaFin_=array_count_values($FechaFin_);

          $i=0;
          foreach ($FechaFin_ as $key => $value) {
           $FechaFin[$i]=$key;
           $i++;
          }


          for ($i=0; $i <count($FechaFin) ; $i++) { 
            if ($i < count($FechaFin)-1) {
                $BombasOperativas[$i]["Flujo"]=$FlujoEpa[$FechaFin[$i]]-$FlujoEpa[$FechaFin[$i+1]];
              }
          }
          $BombasOperativas[count($FechaFin)-1]["Flujo"]=0;
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
            // $Fila[$i]["Flujo"]      =$BombasOperativas[$i]["Flujo"];
            
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

        for ($i=0; $i < count($valores); $i++) { 
          $Fila[$i]["Flujo"]=$BombasOperativas[$i]["Flujo"];
        }

        unset($Fila[count($Fila)-1]);

        $ImprimirBombas=true;
    } else{
      $ImprimirBombas=false;
      $Fila=null;
    }

        return view("modals.VinaLuisFelipe.Bombas", ["Bombas" => $Fila, "ImprimirBombas" => $ImprimirBombas, "Horas12" => true]);
     
   }

   public function BombasPersonalizadas(){


    
    $FechaInicio______=$_POST["FechaInicio"];
    $FechaFin______=$_POST["FechaFin"];


    $datos= DB::connection("telemetria")
                        ->select("SELECT mt_name, mt_value, mt_time FROM log_biofil02 WHERE (mt_name='Biofiltro02--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro02--Consumo.EstadoBomba3'
                                                                 OR mt_name='Biofiltro02--Consumo.FlujoMedidor1')
                                                                 AND mt_time BETWEEN '$FechaInicio______' AND '$FechaFin______'
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
       }  else{
        $Flujo[$g]["mt_name"]=$datos[$i]->mt_name;
        $Flujo[$g]["mt_time"]=$datos[$i]->mt_time;
        $Flujo[$g]["mt_value"]=$datos[$i]->mt_value;

        $FlujoEpa[$datos[$i]->mt_time]=$datos[$i]->mt_value;
        $g++;
      }
    
    } 



if ($h!=0) {

       if (isset($BombaActiva)) {
         
          for ($i=0; $i <count($BombaActiva); $i++) { 
              $FechaInicio[$i]                          =  reset($Tiempo[$i]);
              $FechaFin[$i]["date"]  =  end($Tiempo[$i]);
              $BombasOperativas[$i]["FechaInicio"]      =  reset($Tiempo[$i]);
              $BombasOperativas[$i]["FechaFin"]         =  end($Tiempo[$i]);
              $BombasOperativas[$i]["MinutosOperativa"] =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $BombasOperativas[$i]["Bomba"]            =  $BombaActiva[$i][0]["mt_name"];
              $MinutosOperativa[$i]                     =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
              $Bomba[$i]                                =  $BombaActiva[$i][0]["mt_name"];  


          }



          $columns = array_column($FechaFin, 'date');
          array_multisort($columns, SORT_DESC, $FechaFin);


          for ($i=0; $i <count($FechaFin); $i++) { 
            $FechaFin__[$i]=$FechaFin[$i]["date"];
          }
          unset($FechaFin);
          $FechaFin__=array_count_values($FechaFin__);

          $i=0;
          foreach ($FechaFin__ as $key => $value) {
           $FechaFin[$i]=$key;
           $i++;
          }


          for ($i=0; $i <count($FechaFin) ; $i++) { 
            if ($i < count($FechaFin)-1) {
                $BombasOperativas[$i]["Flujo"]=$FlujoEpa[$FechaFin[$i]]-$FlujoEpa[$FechaFin[$i+1]];
              }
          }
          $BombasOperativas[count($FechaFin)-1]["Flujo"]=0;
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
            // $Fila[$i]["Flujo"]      =$BombasOperativas[$i]["Flujo"];
            
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

        for ($i=0; $i < count($valores); $i++) { 
          $Fila[$i]["Flujo"]=$BombasOperativas[$i]["Flujo"];
        }

       unset($Fila[count($Fila)-1]);

        $ImprimirBombas=true;
    } else{
      $ImprimirBombas=false;
      $Fila=null;
    }



          return view("modals.VinaLuisFelipe.Bombas", ["Bombas" => $Fila, "FechaInicio"=> $FechaInicio______, "FechaFin"=> $FechaFin______,"ImprimirBombas" => $ImprimirBombas, "Horas12" => false]);



   }

   public function GraficarORPDiario(){
          $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value, COUNT(*) Registros,
                                  mt_time
                                   FROM log_biofil02 
                                  
                                     WHERE (mt_name='Biofiltro02--Consumo.ORP_Entrada' OR mt_name='Biofiltro02--Consumo.ORP_Salida')
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.ORP_Entrada' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY mt_name, DAY(mt_time)
                                               ORDER BY mt_name, mt_time ASC");

        
          $k=0;
          $j=0;
          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            
            
            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.ORP_Entrada") {
              $mt_value_entrada[$k]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros), 2);
              $mt_time[$k]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
              $k++;
            }

            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.ORP_Salida") {
              $mt_value_salida[$j]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros), 2);
              $j++;
            }

          }


            ?><script>

                var mt_timeORP = '<?php echo json_encode($mt_time); ?>';
                mt_timeORP=JSON.parse(mt_timeORP);
                mt_timeORPORP =mt_timeORP


                var mt_value_ORPentrada = '<?php echo json_encode($mt_value_entrada); ?>';
                mt_value_ORPentrada=JSON.parse(mt_value_ORPentrada);
                mt_valueORPORP =mt_value_ORPentrada


                var mt_value_ORPsalida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_ORPsalida=JSON.parse(mt_value_ORPsalida);
                mt_valueORPORP =mt_value_ORPsalida





                function DescargarExcelORP() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_timeORPORP+'&mt_value='+mt_valueORPORP+'&mt_value_salida='+mt_valueORPORP+"&n1=ORP Entrada&n2=ORP Salida", '_blank' )
                 }

          GraficarORPDiarioJS(mt_timeORP, mt_value_ORPentrada, mt_value_ORPsalida);
          </script><?php
   }



   public function GraficarORPPersonalizado(Request $Request){

          $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value, COUNT(*) Registros,
                                  mt_time
                                   FROM log_biofil02 
                                  
                                     WHERE (mt_name='Biofiltro02--Consumo.ORP_Entrada' OR mt_name='Biofiltro02--Consumo.ORP_Salida')
                                           AND DATE(mt_time)>='".Request()->FechaInicio."' AND DATE(mt_time)<='".Request()->FechaFin."'
                                             GROUP BY mt_name, DAY(mt_time)
                                               ORDER BY mt_name, mt_time ASC");

        
          $k=0;
          $j=0;
          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            
            
            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.ORP_Entrada") {
              $mt_value_entrada[$k]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros), 2);
              $mt_time[$k]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
              $k++;
            }

            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.ORP_Salida") {
              $mt_value_salida[$j]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros), 2);
              $j++;
            }

          }


            ?><script>

                var mt_timeORP = '<?php echo json_encode($mt_time); ?>';
                mt_timeORP=JSON.parse(mt_timeORP);
                mt_timeORPORP =mt_timeORP

                var mt_value_ORPentrada = '<?php echo json_encode($mt_value_entrada); ?>';
                mt_value_ORPentrada=JSON.parse(mt_value_ORPentrada);
                mt_valueORPORP =mt_value_ORPentrada

                var mt_value_ORPsalida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_ORPsalida=JSON.parse(mt_value_ORPsalida);
                mt_valueORPORP =mt_value_ORPsalida

                function DescargarExcelORP() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_timeORPORP+'&mt_value='+mt_valueORPORP+'&mt_value_salida='+mt_valueORPORP+"&n1=ORP Entrada&n2=ORP Salida", '_blank' )
                 }
          $(".loader-insta").css("display", "none");
          $("#orp-bar-chart").remove();
          $("#orp-bar-chart-div").html('<canvas id="orp-bar-chart" width="400" height="70"></canvas>');
          GraficarORPDiarioJS(mt_timeORP, mt_value_ORPentrada, mt_value_ORPsalida);
          </script><?php
   }




      public function GraficarConductividadDiario(){

          $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value, COUNT(*) Registros, MAX(mt_value) AS maximo, MIN(mt_value) AS minimo,
                                  mt_time
                                   FROM log_biofil02
                                   
                                     WHERE (mt_name='Biofiltro02--Consumo.Conductividad_Entrada' OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.Conductividad_Salida' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY mt_name, DAY(mt_time)
                                               ORDER BY mt_name, mt_time ASC");

        
          $k=0;
          $j=0;
          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            
            
            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Entrada") {
              $mt_value_entrada[$k]=$DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros;
              $mt_value_entrada[$k]=number_format($mt_value_entrada[$k], 0, "", "");
              $mt_value_entrada[$k]=$mt_value_entrada[$k]/100;
              $mt_time[$k]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
              $MaximoEntrada[$k]=$DatosDiarios[$i]->maximo/10;
              $MinimoEntrada[$k]=$DatosDiarios[$i]->minimo/100;
              $k++;
            }

            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Salida") {
              $mt_value_salida[$j]=$DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros;
              $mt_value_salida[$j]=number_format($mt_value_salida[$j], 0, "", "");
              $mt_value_salida[$j]=$mt_value_salida[$j]/100;
              $MaximoSalida[$j]=$DatosDiarios[$i]->maximo/10;
              $MinimoSalida[$j]=$DatosDiarios[$i]->minimo/100;
              $j++;
            }

          }


            ?><script>
                var mt_timeORP = '<?php echo json_encode($mt_time); ?>';
                mt_timeORP=JSON.parse(mt_timeORP);
                mt_time_conductividad= mt_timeORP

                var mt_value_ORPentrada = '<?php echo json_encode($mt_value_entrada); ?>';
                mt_value_ORPentrada=JSON.parse(mt_value_ORPentrada);
                mt_value_conductividad= mt_value_ORPentrada

                var mt_value_ORPsalida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_ORPsalida=JSON.parse(mt_value_ORPsalida);
                mt_value_salida_conductividad= mt_value_ORPsalida

                var MaximoEntrada = '<?php echo json_encode($MaximoEntrada); ?>';
                MaximoEntrada=JSON.parse(MaximoEntrada);

                var MinimoEntrada = '<?php echo json_encode($MinimoEntrada); ?>';
                MinimoEntrada=JSON.parse(MinimoEntrada);


                var MaximoSalida = '<?php echo json_encode($MaximoSalida); ?>';
                MaximoSalida=JSON.parse(MaximoSalida);

                var MinimoSalida = '<?php echo json_encode($MinimoSalida); ?>';
                MinimoSalida=JSON.parse(MinimoSalida);



                function DescargarExcelConductividad() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_conductividad+'&mt_value='+mt_value_conductividad+'&mt_value_salida='+mt_value_salida_conductividad+"&n1=Conductividad Entrada&n2=Conductividad Salida", '_blank' )
                 }


          GraficarConductividadDiarioJS(mt_timeORP, mt_value_ORPentrada, mt_value_ORPsalida, MaximoEntrada, MinimoEntrada, MaximoSalida, MinimoSalida);
          </script><?php
   }


   public function GraficarConductividadPersonalizado(Request $Request){

          $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value, COUNT(*) Registros,
                                  mt_time
                                   FROM log_biofil02 
                                  
                                     WHERE (mt_name='Biofiltro02--Consumo.Conductividad_Entrada' OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                           AND DATE(mt_time)>='".Request()->FechaInicio."' AND DATE(mt_time)<='".Request()->FechaFin."'
                                             GROUP BY mt_name, DAY(mt_time)
                                               ORDER BY mt_name, mt_time ASC");

        
          $k=0;
          $j=0;
          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            
            
            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Entrada") {
              $mt_value_entrada[$k]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros)/100, 0, "", "");
              $mt_time[$k]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
              $k++;
            }

            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Salida") {
              $mt_value_salida[$j]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros)/100, 0, "", "");
              $j++;
            }

          }


            ?><script>

                var mt_timeORP = '<?php echo json_encode($mt_time); ?>';
                mt_timeORP=JSON.parse(mt_timeORP);
                mt_time_conductividad= mt_timeORP

                var mt_value_ORPentrada = '<?php echo json_encode($mt_value_entrada); ?>';
                mt_value_ORPentrada=JSON.parse(mt_value_ORPentrada);
                mt_value_conductividad= mt_value_ORPentrada

                var mt_value_ORPsalida = '<?php echo json_encode($mt_value_salida); ?>';
                mt_value_ORPsalida=JSON.parse(mt_value_ORPsalida);
                mt_value_salida_conductividad= mt_value_ORPsalida

                function DescargarExcelConductividad() {
                    window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_conductividad+'&mt_value='+mt_value_conductividad+'&mt_value_salida='+mt_value_salida_conductividad+"&n1=ORP Entrada&n2=ORP Salida", '_blank' )
                 }
          $(".loader-insta").css("display", "none");
          $("#conductividad-bar-chart").remove();
          $("#conductividad-bar-chart-div").html('<canvas id="conductividad-bar-chart" width="400" height="70"></canvas>');
          GraficarConductividadDiarioJS(mt_timeORP, mt_value_ORPentrada, mt_value_ORPsalida);
          </script><?php
   }

public function ExportarVinaExcel(Request $Request){


        return Excel::download(new UsersExport, "Datos.xlsx");
}



}




class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function collection(){


      if ($_POST["tipo"]==1) {
        return collect(self::RecopDat());
      }

       
    }

    public function headings(): array
    {
      
        return self::RecopHeader();
    }

    public function RecopHeader(){
      
      if ($_POST["tipo"]==1) {
            $hed =[
                              $_POST["nombre_1"],
                              $_POST["nombre_2"],
                            ];
          }
          return $hed;
    }

    public function RecopDat(){

            $m_time    = explode(",", $_POST['mt_time']);
            $m_value_1   = explode(",", $_POST['mt_value_1']);

            for ($i=0; $i <count($m_value_1); $i++) { 
               $Datos[$i]["m_time"]=$m_time[$i];
               $Datos[$i]["m_value_1"]=$m_value_1[$i];
           }


           return $Datos;
    }



}