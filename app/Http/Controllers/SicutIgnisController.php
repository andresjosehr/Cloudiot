<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


use DB;

class SicutIgnisController extends Controller{
    public function index(Request $request){
    	
    	$id=$_POST['id'];
            $tabla_asociada=$_POST['tabla_asociada'];

			$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();


                      $Datos= array();

                      $Info= DB::connection("telemetria")
                                  ->select("(SELECT mt_name, mt_value, MAX(mt_time) AS mt_time FROM (SELECT * FROM log_aasa ORDER BY mt_time DESC LIMIT 200) la 
                                                                     WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                         OR mt_name='AASA--ION8650.EnerActRet'
                                                                         OR mt_name='AASA--ION8650.EnerReactIny'
                                                                         OR mt_name='AASA--ION8650.EnerReactRet'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaab'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio'
                                                                         OR mt_name='AASA--ION8650.Voltajea'
                                                                         OR mt_name='AASA--ION8650.Voltajeb'
                                                                         OR mt_name='AASA--ION8650.Voltajec'
                                                                         OR mt_name='AASA--ION8650.VoltajePromedio'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaa'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                         GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 32) ORDER BY mt_name, mt_time");
                                  

                                    

                                     $Datos["EnergiaActivaInyectada"]   =   $Info[1]->mt_value-$Info[0]->mt_value;
                                     $Datos["EnergiaActivaRetirada"]    =   $Info[3]->mt_value-$Info[2]->mt_value;

                                     $Datos["EnergíaReactivaInyectada"] =   $Info[5]->mt_value-$Info[4]->mt_value;
                                     $Datos["EnergíaReactivaRetirada"]  =   $Info[7]->mt_value-$Info[6]->mt_value;

                                     $Datos["FactorPotenciaA"]          =   $Info[9]->mt_value/10000;
                                     $Datos["FactorPotenciaB"]          =   $Info[11]->mt_value/10000;
                                     $Datos["FactorPotenciaC"]          =   $Info[13]->mt_value/10000;
                                     $Datos["FactorPotenciaTotal"]      =   number_format($Datos["FactorPotenciaA"]+$Datos["FactorPotenciaB"]+$Datos["FactorPotenciaC"], 2, ",", "");

                                     $Datos["VoltajeA"]                 =   $Info[17]->mt_value;
                                     $Datos["VoltajeB"]                 =   $Info[19]->mt_value;
                                     $Datos["VoltajeC"]                 =   $Info[21]->mt_value;


                                     $Datos["VoltajeDeLineaAB"]         =   $Info[23]->mt_value;
                                     $Datos["VoltajeDeLineaBC"]         =   $Info[25]->mt_value;
                                     $Datos["VoltajeDeLineaCA"]         =   $Info[27]->mt_value;
                                     $Datos["VoltajeDeLineaPromedio"]   =   $Info[29]->mt_value;
                                    
                                     $Datos["VoltajePromedio"]          =   $Info[31]->mt_value;

                                     $Datos["UltimaMedicion"]           =   $Info[31]->mt_time;

                                     return view("modals.SicutIgnis", ["Instalacion" => $instalaciones, "Datos" => $Datos]);
    }

    public function Grafico1(Request $Request){


           if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }


      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa  la
                                                WHERE (mt_name='AASA--ION8650.EnerActIny' 
                                                OR mt_name='AASA--ION8650.EnerActRet')
                                                $Condition
                                                ORDER BY mt_name, mt_time ASC LIMIT 1000;");

        $j=0; $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 

            if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny") {
              if ($j==0) {
                $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value))*(-1);
                $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value))*(-1);
                  $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
                }
              }
              $j++;
            }
            if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet') {
              if ($k==0) {
                $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value));
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value));
                }
              }
              $EnergiaActivaRetirada_mt_time[$k]=$datos[$i]->mt_time;
              $k++;
            }

            if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value;
                    }
                    if ($MaxDato<$datos[$i]->mt_value) {
                      $MaxDato=$datos[$i]->mt_value;
                    }
                  }

        }

        ?><script>

          var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
          var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);


          var EnergiaActivaInyectada_mt_value = '<?php echo json_encode($EnergiaActivaInyectada_mt_value); ?>';
          EnergiaActivaInyectada_mt_value = JSON.parse(EnergiaActivaInyectada_mt_value)
          var EnergiaActivaInyectada_mt_time = '<?php echo json_encode($EnergiaActivaInyectada_mt_time); ?>';
          EnergiaActivaInyectada_mt_time = JSON.parse(EnergiaActivaInyectada_mt_time)

          var EnergiaActivaRetirada_mt_value = '<?php echo json_encode($EnergiaActivaRetirada_mt_value); ?>';
          EnergiaActivaRetirada_mt_value = JSON.parse(EnergiaActivaRetirada_mt_value)
          var EnergiaActivaRetirada_mt_time = '<?php echo json_encode($EnergiaActivaRetirada_mt_time); ?>';
          EnergiaActivaRetirada_mt_time = JSON.parse(EnergiaActivaRetirada_mt_time)
          var mt_mt=EnergiaActivaRetirada_mt_time;

          EnergiaActivaInyectada_mt_time = Object.keys(EnergiaActivaInyectada_mt_time).map(i => EnergiaActivaInyectada_mt_time[i])
          EnergiaActivaInyectada_mt_value = Object.keys(EnergiaActivaInyectada_mt_value).map(i => EnergiaActivaInyectada_mt_value[i])
          EnergiaActivaRetirada_mt_value = Object.keys(EnergiaActivaRetirada_mt_value).map(i => EnergiaActivaRetirada_mt_value[i])

        </script><?php


          if ($Request->Modal) { 
            ?><script>
              var mt_time_def1 = EnergiaActivaInyectada_mt_time;
              var mt_value_def1 = EnergiaActivaInyectada_mt_value;
              var mt_value_def2 = EnergiaActivaRetirada_mt_value;
              var Grac=1;
              var grafper=1;

              var nombre_1 = "Fecha";
              var nombre_2 = "Energia Activa Inyectada";
              var nombre_3 = "Energia Activa Retirada";

            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
            GraficosIgnisArriba("myChart0", EnergiaActivaInyectada_mt_value, EnergiaActivaInyectada_mt_time, EnergiaActivaRetirada_mt_value, EnergiaActivaRetirada_mt_time, MinDato, MaxDato, "Inyectada", "Retirada" , 1);
              FuncionesCompletas++;
              FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
    
    }
    public function Grafico2(Request $Request){

      if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny'
                                                                        OR mt_name='AASA--ION8650.EnerReactRet')
                                                                        $Condition
                                                                        ORDER BY mt_name, mt_time ASC LIMIT 1000");

        $j=0;
        $k=0;
        $MinDato_a=999999999999999999999999999999999999999999999999999999999999999999999;
        $MaxDato_a=0;
        $MinDato_b=$MinDato_a;
        $MaxDato_b=$MaxDato_a;

        for ($i=0; $i <count($datos) ; $i++) { 

              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny') {

                if ($i==0 && $datos[$i]->mt_value!=0) {
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i]->mt_value;
                  $EnergiaReactivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
                  $EnergiaReactivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
                  }
                }

                if ($MinDato_a>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                  $MinDato_a=$datos[$i]->mt_value;
                }
                if ($MaxDato_a<$datos[$i]->mt_value) {
                  $MaxDato_a=$datos[$i]->mt_value;
                }

                $j++;
              }
              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactRet') {

                if ($k==0) {
                  $EnergiaReactivaRetirada_mt_value[$k]=$datos[$i]->mt_value-$datos[$i]->mt_value;
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                    $EnergiaReactivaRetirada_mt_value[$k]=abs($datos[$i]->mt_value-$datos[$i-1]->mt_value)*(-1);
                  }
                }
                $EnergiaReactivaRetirada_mt_time[$k]=$datos[$i]->mt_time;

                if ($MinDato_b>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                  $MinDato_b=$datos[$i]->mt_value;
                }
                if ($MaxDato_b<$datos[$i]->mt_value) {
                  $MaxDato_b=$datos[$i]->mt_value;
                }
                $k++;
              }

        }

      ?><script>

          var MinDato_a=parseInt('<?php echo $MinDato_a; ?>', 10);
          var MaxDato_a=parseInt('<?php echo $MaxDato_a; ?>', 10);

          var MinDato_b=parseInt('<?php echo $MinDato_b; ?>', 10);
          var MaxDato_b=parseInt('<?php echo $MaxDato_b; ?>', 10);


          var EnergiaReactivaInyectada_mt_value = '<?php echo json_encode($EnergiaReactivaInyectada_mt_value); ?>';
          EnergiaReactivaInyectada_mt_value = JSON.parse(EnergiaReactivaInyectada_mt_value)
          var EnergiaReactivaInyectada_mt_time = '<?php echo json_encode($EnergiaReactivaInyectada_mt_time); ?>';
          EnergiaReactivaInyectada_mt_time = JSON.parse(EnergiaReactivaInyectada_mt_time)

          var EnergiaReactivaRetirada_mt_value = '<?php echo json_encode($EnergiaReactivaRetirada_mt_value); ?>';
          EnergiaReactivaRetirada_mt_value = JSON.parse(EnergiaReactivaRetirada_mt_value)
          var EnergiaReactivaRetirada_mt_time = '<?php echo json_encode($EnergiaReactivaRetirada_mt_time); ?>';
          EnergiaReactivaRetirada_mt_time = JSON.parse(EnergiaReactivaRetirada_mt_time)

          EnergiaReactivaInyectada_mt_time = Object.keys(EnergiaReactivaInyectada_mt_time).map(i => EnergiaReactivaInyectada_mt_time[i])
          EnergiaReactivaInyectada_mt_value = Object.keys(EnergiaReactivaInyectada_mt_value).map(i => EnergiaReactivaInyectada_mt_value[i])
          EnergiaReactivaRetirada_mt_value = Object.keys(EnergiaReactivaRetirada_mt_value).map(i => EnergiaReactivaRetirada_mt_value[i])


      </script><?php

      if ($Request->Modal) { 

        ?><script>
              var mt_time_def1 = EnergiaReactivaInyectada_mt_time;
              var mt_value_def1 = EnergiaReactivaInyectada_mt_value;
              var mt_value_def2 = EnergiaReactivaRetirada_mt_value;
              var Grac=1;
              var grafper=2;

              var nombre_1 = "Fecha";
              var nombre_2 = "Energia Reactiva Inyectada";
              var nombre_3 = "Energia Reactiva Retirada";

            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
           GraficoIgnisArribaDerecha("myChart1", EnergiaReactivaInyectada_mt_value, EnergiaReactivaInyectada_mt_time, EnergiaReactivaRetirada_mt_value, EnergiaReactivaRetirada_mt_time, MinDato_a, MaxDato_a, MinDato_b, MaxDato_b, "Inyectada", "Retirada", 2);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
     
    }



    public function Grafico3(Request $Request){

       if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }



            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio')
                                                                        $Condition
                                                                        ORDER BY mt_name, mt_time ASC LIMIT 1000");
                  $j=0;
                  $k=0;                  
                  $h=0;
                  $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaab") {
                    $VoltajeLineaab_mt_value[$j]=$datos[$i]->mt_value;
                    $VoltajeLineaab_mt_time[$j]=$datos[$i]->mt_time;
                    $j++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineabc") {
                    $VoltajeLineabc_mt_value[$k]=$datos[$i]->mt_value;
                    $VoltajeLineabc_mt_time[$k]=$datos[$i]->mt_time;
                    $k++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaca") {
                    $VoltajeLineaca_mt_value[$h]=$datos[$i]->mt_value;
                    $VoltajeLineaca_mt_time[$h]=$datos[$i]->mt_time;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaPromedio") {
                    $VoltajeLineaPromedio_mt_value[$g]=$datos[$i]->mt_value;
                    $VoltajeLineaPromedio_mt_time[$g]=$datos[$i]->mt_time;
                    $g++;
                  }
                  if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value;
                    }
                    if ($MaxDato<$datos[$i]->mt_value) {
                      $MaxDato=$datos[$i]->mt_value;
                    }
                  }
                }


      ?><script>

          var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
          var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);

          var VoltajeLineaab_mt_value = '<?php echo json_encode($VoltajeLineaab_mt_value); ?>';
          VoltajeLineaab_mt_value = JSON.parse(VoltajeLineaab_mt_value)
          var VoltajeLineaab_mt_time = '<?php echo json_encode($VoltajeLineaab_mt_time); ?>';
          VoltajeLineaab_mt_time = JSON.parse(VoltajeLineaab_mt_time)

          var VoltajeLineabc_mt_value = '<?php echo json_encode($VoltajeLineabc_mt_value); ?>';
          VoltajeLineabc_mt_value = JSON.parse(VoltajeLineabc_mt_value)

          var VoltajeLineaca_mt_value = '<?php echo json_encode($VoltajeLineaca_mt_value); ?>';
          VoltajeLineaca_mt_value = JSON.parse(VoltajeLineaca_mt_value)

          var VoltajeLineaPromedio_mt_value = '<?php echo json_encode($VoltajeLineaPromedio_mt_value); ?>';
          VoltajeLineaPromedio_mt_value = JSON.parse(VoltajeLineaPromedio_mt_value)

      </script><?php

      if ($Request->Modal) { 

            ?><script>
              var mt_time_def1 = VoltajeLineaab_mt_time;
              var mt_value_def1 = VoltajeLineaab_mt_value;
              var mt_value_def2 = VoltajeLineabc_mt_value;
              var mt_value_def3 = VoltajeLineaca_mt_value;
              var mt_value_def4 = VoltajeLineaPromedio_mt_value;
              var Grac=2;
              var grafper=3;


              var nombre_1 = "Fecha";
              var nombre_2 = "Voltaje Linea A-B";
              var nombre_3 = "Voltaje Linea B-C";
              var nombre_4 = "Voltaje Linea C-A";
              var nombre_5 = "Voltaje Linea Promedio";
            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
GraficosIgnisAbajo("myChart4", VoltajeLineaab_mt_value, VoltajeLineaab_mt_time, VoltajeLineabc_mt_value, VoltajeLineaca_mt_value, VoltajeLineaPromedio_mt_value, MinDato, MaxDato, "A-B", "B-C", "C-A", "Promedio", 3, false);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
            </script><?php

          }
     
    }
    public function Grafico4(Request $Request){

       if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }


      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.Voltajeb'
                                                                        OR mt_name='AASA--ION8650.Voltajec'
                                                                        OR mt_name='AASA--ION8650.VoltajePromedio')
                                                                        $Condition
                                                                        ORDER BY mt_name, mt_time ASC LIMIT 1000");
                  $j=0;
                  $k=0;                  
                  $h=0;
                  $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                  if ($datos[$i]->mt_name=='AASA--ION8650.Voltajea') {
                    $Voltajea_mt_value[$j]=$datos[$i]->mt_value;
                    $Voltajea_mt_time[$j]=$datos[$i]->mt_time;
                    $j++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.Voltajeb') {
                    $Voltajeb_mt_value[$k]=$datos[$i]->mt_value;
                    $Voltajeb_mt_time[$k]=$datos[$i]->mt_time;
                    $k++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.Voltajec') {
                    $Voltajec_mt_value[$h]=$datos[$i]->mt_value;
                    $Voltajec_mt_time[$h]=$datos[$i]->mt_time;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.VoltajePromedio') {
                    $VoltajePromedio_mt_value[$g]=$datos[$i]->mt_value;
                    $VoltajePromedio_mt_time[$g]=$datos[$i]->mt_time;
                    $g++;
                  }
                  if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value;
                    }
                    if ($MaxDato<$datos[$i]->mt_value) {
                      $MaxDato=$datos[$i]->mt_value;
                    }
                  }
                }

      ?><script>
          var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
          var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);
          var Voltajea_mt_value = '<?php echo json_encode($Voltajea_mt_value); ?>';
          Voltajea_mt_value = JSON.parse(Voltajea_mt_value)
          var Voltajea_mt_time = '<?php echo json_encode($Voltajea_mt_time); ?>';
          Voltajea_mt_time = JSON.parse(Voltajea_mt_time)

          var Voltajeb_mt_value = '<?php echo json_encode($Voltajeb_mt_value); ?>';
          Voltajeb_mt_value = JSON.parse(Voltajeb_mt_value)

          var Voltajec_mt_value = '<?php echo json_encode($Voltajec_mt_value); ?>';
          Voltajec_mt_value = JSON.parse(Voltajec_mt_value)

          var VoltajePromedio_mt_value = '<?php echo json_encode($VoltajePromedio_mt_value); ?>';
          VoltajePromedio_mt_value = JSON.parse(VoltajePromedio_mt_value)

      </script><?php


      if ($Request->Modal) { 

            ?><script>
              var mt_time_def1 = Voltajea_mt_time;
              var mt_value_def1 = Voltajea_mt_value;
              var mt_value_def2 = Voltajeb_mt_value;
              var mt_value_def3 = Voltajec_mt_value;
              var mt_value_def4 = VoltajePromedio_mt_value;
              var Grac=2;
              var grafper=4;


              var nombre_1 = "Fecha";
              var nombre_2 = "Voltaje A";
              var nombre_3 = "Voltaje B";
              var nombre_4 = "Voltaje C";
              var nombre_5 = "Voltaje Promedio";


            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
              GraficosIgnisAbajo("myChart5", Voltajea_mt_value, Voltajea_mt_time, Voltajeb_mt_value, Voltajec_mt_value, VoltajePromedio_mt_value, MinDato, MaxDato, "A", "B", "C", "Promedio", 4, false);
              FuncionesCompletas++;
              FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
     
    }
    public function Grafico5(Request $Request){



        if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa  
                                                WHERE (mt_name='AASA--ION8650.EnerActIny' 
                                                OR mt_name='AASA--ION8650.EnerActRet' 
                                                OR mt_name='AASA--ION8650.EnerReactIny' 
                                                OR mt_name='AASA--ION8650.EnerReactRet')
                                                $Condition 
                                                ORDER BY mt_name, mt_time DESC LIMIT 1000;");


                $j=0; $k=0; $h=0; $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                    if ($datos[$i]->mt_name=='AASA--ION8650.EnerActIny') {
                      $EnerActIny_value[$j]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                      $EnerActIny_time[$j]=$datos[$i]->mt_time;
                      $j++;
                    }
                    if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet') {
                      $EnerActRet_value[$k]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                      $k++;
                    }
                    if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny') {
                      $EnerReactIny_mt_value[$h]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                      $h++;
                    }
                    if ($i!=count($datos)-1) {
                      if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactRet') {
                        $EnerReactRet_mt_value[$g]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                        $g++;
                      }
                  } 

                }

                for ($i=0; $i <count($EnerActIny_time)-1 ; $i++) { 
                  if ($EnerReactIny_mt_value[$i]==0) {
                    $FPiny[$i]=0;
                  } else{
                    $FPiny[$i]=$EnerActIny_value[$i]/$EnerReactIny_mt_value[$i];
                    $FPiny[$i]=cos(atan($FPiny[$i]));
                  }
                  if ($EnerReactRet_mt_value[$i]==0) {
                    $FPret[$i]=0;
                  } else{
                    $FPret[$i]=$EnerActRet_value[$i]/$EnerReactRet_mt_value[$i];
                    $FPret[$i]=cos(atan($FPret[$i]));
                  }

                  if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value;
                    }
                    if ($MaxDato<$datos[$i]->mt_value) {
                      $MaxDato=$datos[$i]->mt_value;
                    }
                }

                } 



      ?><script>

        var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
        var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);


        var FPret = '<?php echo json_encode($FPret); ?>';
        FPret = JSON.parse(FPret)

        var FPiny = '<?php echo json_encode($FPiny); ?>';
        FPiny = JSON.parse(FPiny)

        var mt_time = '<?php echo json_encode($EnerActIny_time); ?>';
        mt_time = JSON.parse(mt_time)

  


      </script><?php

      if ($Request->Modal) { 

            ?><script>
              var mt_time_def1 = mt_time;
              var mt_value_def1 = FPiny;
              var mt_value_def2 = FPret;
              var Grac=1;
              var grafper=5;

              var nombre_1 = "Fecha";
              var nombre_2 = "Factor Potencia Inyectada";
              var nombre_3 = "Factor Potencia Retirada";
            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
              $("#FactorPotencia_td").text(FPiny[FPiny.length-1]);
            GraficosPotenciaINY("myChart6", FPiny, mt_time, FPret, mt_time, MinDato, MaxDato, "FPiny", "FPret" , 5);
            </script><?php

          } 


     
     
    }

    public function Grafico7(Request $Request){

         if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }


      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa  
                                                WHERE (mt_name='AASA--ION8650.EnerActIny' 
                                                OR mt_name='AASA--ION8650.EnerActRet')
                                                $Condition
                                                ORDER BY mt_name, mt_time ASC LIMIT 1000;");

        $j=0; $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 

            if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny") {
              if ($j==0) {
                $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value)*4);
                $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value)*4);
                  $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
                }
              }
              $j++;
            }
            if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet') {
              if ($k==0) {
                $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value)*4)*(-1);
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value)*4)*(-1);
                }
              }
              $EnergiaActivaRetirada_mt_time[$k]=$datos[$i]->mt_time;
              $k++;
            }

            if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value;
                    }
                    if ($MaxDato<$datos[$i]->mt_value) {
                      $MaxDato=$datos[$i]->mt_value;
                    }
                  }

        }




      ?><script>

        var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
        var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);


          var EnergiaActivaInyectada_mt_value = '<?php echo json_encode($EnergiaActivaInyectada_mt_value); ?>';
          EnergiaActivaInyectada_mt_value = JSON.parse(EnergiaActivaInyectada_mt_value)
          var EnergiaActivaInyectada_mt_time = '<?php echo json_encode($EnergiaActivaInyectada_mt_time); ?>';
          EnergiaActivaInyectada_mt_time = JSON.parse(EnergiaActivaInyectada_mt_time)

          var EnergiaActivaRetirada_mt_value = '<?php echo json_encode($EnergiaActivaRetirada_mt_value); ?>';
          EnergiaActivaRetirada_mt_value = JSON.parse(EnergiaActivaRetirada_mt_value)
          var EnergiaActivaRetirada_mt_time = '<?php echo json_encode($EnergiaActivaRetirada_mt_time); ?>';
          EnergiaActivaRetirada_mt_time = JSON.parse(EnergiaActivaRetirada_mt_time)
          var mt_mt=EnergiaActivaRetirada_mt_time;

          EnergiaActivaInyectada_mt_time = Object.keys(EnergiaActivaInyectada_mt_time).map(i => EnergiaActivaInyectada_mt_time[i])
          EnergiaActivaInyectada_mt_value = Object.keys(EnergiaActivaInyectada_mt_value).map(i => EnergiaActivaInyectada_mt_value[i])
          EnergiaActivaRetirada_mt_value = Object.keys(EnergiaActivaRetirada_mt_value).map(i => EnergiaActivaRetirada_mt_value[i])

    
      </script><?php

      if ($Request->Modal) { 

        ?><script>
              var mt_time_def1 = EnergiaActivaInyectada_mt_time;
              var mt_value_def1 = EnergiaActivaInyectada_mt_value;
              var mt_value_def2 = EnergiaActivaRetirada_mt_value;
              var Grac=1;
              var grafper=7;

              var nombre_1 = "Fecha";
              var nombre_2 = "Potencia Inyectada";
              var nombre_3 = "Potencia Retirada";

            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
              var last =  function(array, n) {
                if (array == null) 
                  return void 0;
                if (n == null) 
                   return array[array.length - 1];
                return array.slice(Math.max(array.length - n, 0));  
                };

              $("#PoteIny").text(last(EnergiaActivaInyectada_mt_value));
              $("#PoteRet").text(last(EnergiaActivaRetirada_mt_value));
            PotGenerada(EnergiaActivaInyectada_mt_time, EnergiaActivaInyectada_mt_value, EnergiaActivaRetirada_mt_value);
            FuncionesCompletas++;
            FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
     
     
    }


    public function ExportarSicutExcel(Request $Request){


        return Excel::download(new UsersExport, "Datos.xlsx");
   }
}




class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function collection(){

      if (isset($_POST['EnergiaActivaInyectada_mt_time'])) {
        return collect(self::RecopDat());
      }

      if ($_POST["tipo"]==1) {
        return collect(self::RecopDat2());
      }

      if ($_POST["tipo"]==2) {
        return collect(self::RecopDat3());
      }



       
    }

    public function headings(): array
    {
      
        return self::RecopHeader();
    }














public function RecopHeader()
{

  if ($_POST["tipo"]==1) {
    $hed =[
                      $_POST["nombre_1"],
                      $_POST["nombre_2"],
                      $_POST["nombre_3"],
                    ];
  }


  if ($_POST["tipo"]==2) {
    $hed =[
                      $_POST["nombre_1"],
                      $_POST["nombre_2"],
                      $_POST["nombre_3"],
                      $_POST["nombre_4"],
                      $_POST["nombre_5"],
                    ];
  }

  if (isset($_POST['EnergiaActivaInyectada_mt_time'])) {
        $hed =[
                      'Fecha',
                      'Ene Act Inyectada (kWh)',
                      'Ene Act Retirada (kWh)',
                      'Ene React Inyectada (kVARh)',
                      'Ene React Retirada (kVARh)',
                      'VL AB',
                      'VL BC',
                      'VL CA',
                      'VL Promedio',
                      'V A',
                      'V B',
                      'V C',
                      'V Promedio',
                      'FP A',
                      'FP B',
                      'FP C',
                      'FP Total'
                    ];
      }
  return $hed;
}




public function RecopDat2(){


            $m_time    = explode(",", $_POST['mt_time']);
            $m_value_1   = explode(",", $_POST['mt_value_1']);
            $m_value_2    = explode(",", $_POST['mt_value_2']);

            for ($i=0; $i <count($m_value_2); $i++) { 
               $Datos[$i]["m_time"]=$m_time[$i];
               $Datos[$i]["m_value_1"]=$m_value_1[$i];
               $Datos[$i]["m_value_2"]=$m_value_2[$i];
           }


           return $Datos;
}



public function RecopDat3(){
            

            $m_time    = explode(",", $_POST['mt_time']);
            $m_value_1   = explode(",", $_POST['mt_value_1']);
            $m_value_2    = explode(",", $_POST['mt_value_2']);
            $m_value_3    = explode(",", $_POST['mt_value_3']);
            $m_value_4    = explode(",", $_POST['mt_value_4']);

            for ($i=0; $i <count($m_value_2); $i++) { 
               $Datos[$i]["m_time"]=$m_time[$i];
               $Datos[$i]["m_value_1"]=$m_value_1[$i];
               $Datos[$i]["m_value_2"]=$m_value_2[$i];
               $Datos[$i]["m_value_3"]=$m_value_3[$i];
               $Datos[$i]["m_value_4"]=$m_value_4[$i];
           }


           return $Datos;
}








      public function RecopDat(){

              $hed =[
                      'Fecha',
                      'Ene Act Inyectada (kWh)',
                      'Ene Act Retirada (kWh)',
                      'Ene React Inyectada (kVARh)',
                      'Ene React Retirada (kVARh)',
                      'VL AB',
                      'VL BC',
                      'VL CA',
                      'VL Promedio',
                      'V A',
                      'V B',
                      'V C',
                      'V Promedio',
                      'FP A',
                      'FP B',
                      'FP C',
                      'FP Total'
                    ];

      define("HeadDefin", $hed);

      $EnergiaActivaInyectada_mt_time    = explode(",", $_POST['EnergiaActivaInyectada_mt_time']);
      $EnergiaActivaInyectada_mt_value   = explode(",", $_POST['EnergiaActivaInyectada_mt_value']);
      $EnergiaActivaRetirada_mt_value    = explode(",", $_POST['EnergiaActivaRetirada_mt_value']);

      $EnergiaReactivaInyectada_mt_time  = explode(",", $_POST['EnergiaReactivaInyectada_mt_time']);
      $EnergiaReactivaInyectada_mt_value = explode(",", $_POST['EnergiaReactivaInyectada_mt_value']);
      $EnergiaReactivaRetirada_mt_value  = explode(",", $_POST['EnergiaReactivaRetirada_mt_value']);

      $VoltajeLineaab_mt_time            = explode(",", $_POST['VoltajeLineaab_mt_time']);
      $VoltajeLineaab_mt_value           = explode(",", $_POST['VoltajeLineaab_mt_value']);
      $VoltajeLineabc_mt_value           = explode(",", $_POST['VoltajeLineabc_mt_value']);
      $VoltajeLineaca_mt_value           = explode(",", $_POST['VoltajeLineaca_mt_value']);
      $VoltajeLineaPromedio_mt_value     = explode(",", $_POST['VoltajeLineaPromedio_mt_value']);

      $Voltajea_mt_time                  = explode(",", $_POST['Voltajea_mt_time']);
      $Voltajea_mt_value                 = explode(",", $_POST['Voltajea_mt_value']);
      $Voltajeb_mt_value                 = explode(",", $_POST['Voltajeb_mt_value']);
      $Voltajec_mt_value                 = explode(",", $_POST['Voltajec_mt_value']);
      $VoltajePromedio_mt_value          = explode(",", $_POST['VoltajePromedio_mt_value']);

      $FactorPotenciaa_mt_time           = explode(",", $_POST['FactorPotenciaa_mt_time']);
      $FactorPotenciaa_mt_value          = explode(",", $_POST['FactorPotenciaa_mt_value']);
      $FactorPotenciab_mt_value          = explode(",", $_POST['FactorPotenciab_mt_value']);
      $FactorPotenciac_mt_value          = explode(",", $_POST['FactorPotenciac_mt_value']);
      $FactorPotenciaTotal_mt_value      = explode(",", $_POST['FactorPotenciaTotal_mt_value']);


    

      for ($i=0; $i <count($EnergiaActivaInyectada_mt_time); $i++) { 
         for ($k=0; $k < 3 ; $k++) { 
           $Datos[$i]["EnergiaActivaInyectada_mt_time"]=$EnergiaActivaInyectada_mt_time[$i];
           $Datos[$i]["EnergiaActivaInyectada_mt_value"]=$EnergiaActivaInyectada_mt_value[$i];
           $Datos[$i]["EnergiaActivaRetirada_mt_value"]=$EnergiaActivaRetirada_mt_value[$i];
         }
       }

       for ($i=0; $i <count($EnergiaReactivaInyectada_mt_time); $i++) { 
         for ($k=0; $k < 3 ; $k++) { 
           $Datos[$i]["EnergiaReactivaInyectada_mt_value"]=$EnergiaReactivaInyectada_mt_value[$i];
           $Datos[$i]["EnergiaReactivaRetirada_mt_value"]=$EnergiaReactivaRetirada_mt_value[$i];
         }
       }

       for ($i=0; $i <count($VoltajeLineaab_mt_time); $i++) { 
         for ($k=0; $k < 6 ; $k++) { 
           $Datos[$i]["VoltajeLineaab_mt_value"]=$VoltajeLineaab_mt_value[$i];
           $Datos[$i]["VoltajeLineabc_mt_value"]=$VoltajeLineabc_mt_value[$i];
           $Datos[$i]["VoltajeLineaca_mt_value"]=$VoltajeLineaca_mt_value[$i];
           $Datos[$i]["VoltajeLineaPromedio_mt_value"]=$VoltajeLineaPromedio_mt_value[$i];
         }
       }

       for ($i=0; $i <count($VoltajeLineaab_mt_time); $i++) { 
         for ($k=0; $k < 6 ; $k++) { 
           $Datos[$i]["Voltajea_mt_value"]=$Voltajea_mt_value[$i];
           $Datos[$i]["Voltajeb_mt_value"]=$Voltajeb_mt_value[$i];
           $Datos[$i]["Voltajec_mt_value"]=$Voltajec_mt_value[$i];
           $Datos[$i]["VoltajePromedio_mt_value"]=$VoltajePromedio_mt_value[$i];
         }
       }

       for ($i=0; $i <count($VoltajeLineaab_mt_time); $i++) { 
         for ($k=0; $k < 6 ; $k++) { 
           $Datos[$i]["FactorPotenciaa_mt_value"]=$FactorPotenciaa_mt_value[$i];
           $Datos[$i]["FactorPotenciab_mt_value"]=$FactorPotenciab_mt_value[$i];
           $Datos[$i]["FactorPotenciac_mt_value"]=$FactorPotenciac_mt_value[$i];
           $Datos[$i]["FactorPotenciaTotal_mt_value"]=$FactorPotenciaTotal_mt_value[$i];
         }
       }

       return $Datos;
    }

}
