<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Exports\AasaExport;
use App\Exports\SubmodalAasa;


use DB;

class SicutIgnisController2 extends Controller{
    public function index(Request $request){

    	
    	$id=$_POST['id'];
            $tabla_asociada=$_POST['tabla_asociada'];

			$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();


                      $Datos= array();

                      $Info= DB::connection("telemetria")
                                  ->select("(SELECT mt_name, mt_value, MAX(dt_utc) AS dt_utc FROM (SELECT * FROM log_aasa ORDER BY dt_utc DESC LIMIT 200) la 
                                                                     WHERE (mt_name='AASA--ION8650.EnerActIny7400'
                                                                         OR mt_name='AASA--ION8650.EnerActRet7400'
                                                                         OR mt_name='AASA--ION8650.EnerReactIny7400'
                                                                         OR mt_name='AASA--ION8650.EnerReactRet7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaab7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineabc7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio7400'
                                                                         OR mt_name='AASA--ION8650.Voltajea7400'
                                                                         OR mt_name='AASA--ION8650.Voltajeb7400'
                                                                         OR mt_name='AASA--ION8650.Voltajec7400'
                                                                         OR mt_name='AASA--ION8650.VoltajePromedio7400'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaa7400'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciab7400'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciac7400'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                         GROUP BY dt_utc, mt_name ORDER BY dt_utc DESC LIMIT 32) ORDER BY mt_name, dt_utc");
                                  

                                    

                                     $Datos["EnergiaActivaInyectada"]   =   $Info[1]->mt_value-$Info[0]->mt_value;
                                     $Datos["EnergiaActivaRetirada"]    =   $Info[3]->mt_value-$Info[2]->mt_value;

                                     $Datos["EnergíaReactivaInyectada"] =   $Info[5]->mt_value-$Info[4]->mt_value;
                                     $Datos["EnergíaReactivaRetirada"]  =   $Info[7]->mt_value-$Info[6]->mt_value;

                                     // $Datos["FactorPotenciaA"]          =   $Info[9]->mt_value/10000;
                                     // $Datos["FactorPotenciaB"]          =   $Info[11]->mt_value/10000;
                                     // $Datos["FactorPotenciaC"]          =   $Info[13]->mt_value/10000;
                                     // $Datos["FactorPotenciaTotal"]      =   number_format($Datos["FactorPotenciaA"]+$Datos["FactorPotenciaB"]+$Datos["FactorPotenciaC"], 2, ",", "");

                                     $Datos["VoltajeA"]                 =   $Info[17]->mt_value;
                                     $Datos["VoltajeB"]                 =   $Info[19]->mt_value;
                                     $Datos["VoltajeC"]                 =   $Info[21]->mt_value;


                                     $Datos["VoltajeDeLineaAB"]         =   $Info[23]->mt_value;
                                     $Datos["VoltajeDeLineaBC"]         =   $Info[25]->mt_value;
                                     $Datos["VoltajeDeLineaCA"]         =   $Info[27]->mt_value;
                                     $Datos["VoltajeDeLineaPromedio"]   =   $Info[29]->mt_value;
                                    
                                     $Datos["VoltajePromedio"]          =   $Info[31]->mt_value;

                                     $Datos["UltimaMedicion"]           =   $Info[31]->dt_utc;

                                     $Datos["instalacion"]=1;

                                     return view("modals.SicutIgnis", ["Instalacion" => $instalaciones, "Datos" => $Datos]);
    }

    public function Grafico1(Request $Request){


      if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }


      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa  la
                                                WHERE (mt_name='AASA--ION8650.EnerActIny7400' 
                                                OR mt_name='AASA--ION8650.EnerActRet7400')
                                                $Condition
                                                ORDER BY mt_name, dt_utc ASC LIMIT 1000;");

        $j=0; $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 

            if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny7400") {
              if ($j==0) {
                $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value));
                $EnergiaActivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value));
                  $EnergiaActivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
                }
              }
              $j++;
            }
            if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet7400') {
              if ($k==0) {
                $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value))*(-1);
              } else{
                if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value))*(-1);
                }
              }
              $EnergiaActivaRetirada_dt_utc[$k]=$datos[$i]->dt_utc;
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
          var EnergiaActivaInyectada_dt_utc = '<?php echo json_encode($EnergiaActivaInyectada_dt_utc); ?>';
          EnergiaActivaInyectada_dt_utc = JSON.parse(EnergiaActivaInyectada_dt_utc)

          var EnergiaActivaRetirada_mt_value = '<?php echo json_encode($EnergiaActivaRetirada_mt_value); ?>';
          EnergiaActivaRetirada_mt_value = JSON.parse(EnergiaActivaRetirada_mt_value)
          var EnergiaActivaRetirada_dt_utc = '<?php echo json_encode($EnergiaActivaRetirada_dt_utc); ?>';
          EnergiaActivaRetirada_dt_utc = JSON.parse(EnergiaActivaRetirada_dt_utc)
          var mt_mt=EnergiaActivaRetirada_dt_utc;

          EnergiaActivaInyectada_dt_utc = Object.keys(EnergiaActivaInyectada_dt_utc).map(i => EnergiaActivaInyectada_dt_utc[i])
          EnergiaActivaInyectada_mt_value = Object.keys(EnergiaActivaInyectada_mt_value).map(i => EnergiaActivaInyectada_mt_value[i])
          EnergiaActivaRetirada_mt_value = Object.keys(EnergiaActivaRetirada_mt_value).map(i => EnergiaActivaRetirada_mt_value[i])

        </script><?php


          if ($Request->Modal) { 
            ?><script>
              var dt_utc_def1   = EnergiaActivaInyectada_dt_utc;
              var mt_value_def1 = EnergiaActivaInyectada_mt_value;
              var mt_value_def2 = EnergiaActivaRetirada_mt_value;
              var Grac          =1;
              var grafper       =1;
              
              var nombre_1      = "Fecha";
              var nombre_2      = "Energia Activa Inyectada";
              var nombre_3      = "Energia Activa Retirada";
              window.Grafico=1;
            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
              var Colores=[];
              Colores[0]='rgba(66, 134, 244, 0.2)';
              Colores[1]='rgba(66, 134, 244, 1)';
              Colores[2]='rgba(255, 99, 132, 0.2)';
              Colores[3]='rgba(255, 99, 132, 1)';

            GraficosIgnisArriba("aasa2_myChart0", EnergiaActivaInyectada_mt_value, EnergiaActivaInyectada_dt_utc, EnergiaActivaRetirada_mt_value, EnergiaActivaRetirada_dt_utc, MinDato, MaxDato, "Inyectada", "Retirada" , 1, Colores);
              FuncionesCompletas++;
              FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
    
    }
    public function Grafico2(Request $Request){

      if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_dt_utc_index) FORCE INDEX (log_aasa_dt_utc_index) WHERE (mt_name='AASA--ION8650.EnerReactIny7400' 
                                                                        OR mt_name='AASA--ION8650.EnerReactRet7400')
                                                                        $Condition
                                                                        ORDER BY mt_name, dt_utc ASC LIMIT 1000");

        $j=0;
        $k=0;
        $MinDato_a=999999999999999999999999999999999999999999999999999999999999999999999;
        $MaxDato_a=0;
        $MinDato_b=$MinDato_a;
        $MaxDato_b=$MaxDato_a;

        for ($i=0; $i <count($datos) ; $i++) { 

              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny7400') {

                if ($i==0 && $datos[$i]->mt_value!=0) {
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i]->mt_value;
                  $EnergiaReactivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
                  $EnergiaReactivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
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
              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactRet7400') {

                if ($k==0) {
                  $EnergiaReactivaRetirada_mt_value[$k]=$datos[$i]->mt_value-$datos[$i]->mt_value;
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                    $EnergiaReactivaRetirada_mt_value[$k]=abs($datos[$i]->mt_value-$datos[$i-1]->mt_value)*(-1);
                  }
                }
                $EnergiaReactivaRetirada_dt_utc[$k]=$datos[$i]->dt_utc;

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
          var EnergiaReactivaInyectada_dt_utc = '<?php echo json_encode($EnergiaReactivaInyectada_dt_utc); ?>';
          EnergiaReactivaInyectada_dt_utc = JSON.parse(EnergiaReactivaInyectada_dt_utc)

          var EnergiaReactivaRetirada_mt_value = '<?php echo json_encode($EnergiaReactivaRetirada_mt_value); ?>';
          EnergiaReactivaRetirada_mt_value = JSON.parse(EnergiaReactivaRetirada_mt_value)
          var EnergiaReactivaRetirada_dt_utc = '<?php echo json_encode($EnergiaReactivaRetirada_dt_utc); ?>';
          EnergiaReactivaRetirada_dt_utc = JSON.parse(EnergiaReactivaRetirada_dt_utc)

          EnergiaReactivaInyectada_dt_utc = Object.keys(EnergiaReactivaInyectada_dt_utc).map(i => EnergiaReactivaInyectada_dt_utc[i])
          EnergiaReactivaInyectada_mt_value = Object.keys(EnergiaReactivaInyectada_mt_value).map(i => EnergiaReactivaInyectada_mt_value[i])
          EnergiaReactivaRetirada_mt_value = Object.keys(EnergiaReactivaRetirada_mt_value).map(i => EnergiaReactivaRetirada_mt_value[i])


      </script><?php

      if ($Request->Modal) { 

        ?><script>
              var dt_utc_def1 = EnergiaReactivaInyectada_dt_utc;
              var mt_value_def1 = EnergiaReactivaInyectada_mt_value;
              var mt_value_def2 = EnergiaReactivaRetirada_mt_value;
              var Grac=1;
              var grafper=2;

              var nombre_1 = "Fecha";
              var nombre_2 = "Energia Reactiva Inyectada";
              var nombre_3 = "Energia Reactiva Retirada";
              window.Grafico=2;

            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
              var Colores=[];
              Colores[0]='rgba(66, 134, 244, 0.2)';
              Colores[1]='rgba(66, 134, 244, 1)';
              Colores[2]='rgba(255, 99, 132, 0.2)';
              Colores[3]='rgba(255, 99, 132, 1)';

           GraficoIgnisArribaDerecha("aasa2_myChart1", EnergiaReactivaInyectada_mt_value, EnergiaReactivaInyectada_dt_utc, EnergiaReactivaRetirada_mt_value, EnergiaReactivaRetirada_dt_utc, MinDato_a, MaxDato_a, MinDato_b, MaxDato_b, "Inyectada", "Retirada", 2, Colores);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
            </script><?php

          } 
     
    }



    public function Grafico3(Request $Request){

       if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }



            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_dt_utc_index) FORCE INDEX (log_aasa_dt_utc_index) WHERE (mt_name='AASA--ION8650.VoltajeLineaab7400'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca7400'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio7400')
                                                                        $Condition
                                                                        ORDER BY mt_name, dt_utc ASC LIMIT 1000");
                  $j=0;
                  $k=0;                  
                  $h=0;
                  $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaab7400") {
                    $VoltajeLineaab_mt_value[$j]=$datos[$i]->mt_value;
                    $VoltajeLineaab_dt_utc[$j]=$datos[$i]->dt_utc;
                    $j++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineabc7400") {
                    $VoltajeLineabc_mt_value[$k]=$datos[$i]->mt_value;
                    $VoltajeLineabc_dt_utc[$k]=$datos[$i]->dt_utc;
                    $k++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaca7400") {
                    $VoltajeLineaca_mt_value[$h]=$datos[$i]->mt_value;
                    $VoltajeLineaca_dt_utc[$h]=$datos[$i]->dt_utc;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaPromedio7400") {
                    $VoltajeLineaPromedio_mt_value[$g]=$datos[$i]->mt_value;
                    $VoltajeLineaPromedio_dt_utc[$g]=$datos[$i]->dt_utc;
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
          var VoltajeLineaab_dt_utc = '<?php echo json_encode($VoltajeLineaab_dt_utc); ?>';
          VoltajeLineaab_dt_utc = JSON.parse(VoltajeLineaab_dt_utc)

          var VoltajeLineabc_mt_value = '<?php echo json_encode($VoltajeLineabc_mt_value); ?>';
          VoltajeLineabc_mt_value = JSON.parse(VoltajeLineabc_mt_value)

          var VoltajeLineaca_mt_value = '<?php echo json_encode($VoltajeLineaca_mt_value); ?>';
          VoltajeLineaca_mt_value = JSON.parse(VoltajeLineaca_mt_value)

          var VoltajeLineaPromedio_mt_value = '<?php echo json_encode($VoltajeLineaPromedio_mt_value); ?>';
          VoltajeLineaPromedio_mt_value = JSON.parse(VoltajeLineaPromedio_mt_value)

      </script><?php

      if ($Request->Modal) { 

            ?><script>
              var dt_utc_def1 = VoltajeLineaab_dt_utc;
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
              window.Grafico=4;
            </script><?php

            return view("modals.SicutIgnis.submodal");

          } else{ 

            ?><script>
  GraficosIgnisAbajo("aasa2_myChart4", VoltajeLineaab_mt_value, VoltajeLineaab_dt_utc, VoltajeLineabc_mt_value, VoltajeLineaca_mt_value, VoltajeLineaPromedio_mt_value, MinDato, MaxDato, "A-B", "B-C", "C-A", "Promedio", 3, false);

            FuncionesCompletas++;
            FuncionExportacion(FuncionesCompletas);
              </script><?php

            }
       
      }
      public function Grafico4(Request $Request){

         if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }


        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_dt_utc_index) FORCE INDEX (log_aasa_dt_utc_index) WHERE (mt_name='AASA--ION8650.Voltajea7400'
                                                                          OR mt_name='AASA--ION8650.Voltajeb7400'
                                                                          OR mt_name='AASA--ION8650.Voltajec7400'
                                                                          OR mt_name='AASA--ION8650.VoltajePromedio7400')
                                                                          $Condition
                                                                          ORDER BY mt_name, dt_utc ASC LIMIT 1000");
                    $j=0;
                    $k=0;                  
                    $h=0;
                    $g=0;
                  for ($i=0; $i <count($datos) ; $i++) { 
                    if ($datos[$i]->mt_name=='AASA--ION8650.Voltajea7400') {
                      $Voltajea_mt_value[$j]=$datos[$i]->mt_value;
                      $Voltajea_dt_utc[$j]=$datos[$i]->dt_utc;
                      $j++;
                    }
                    if ($datos[$i]->mt_name=='AASA--ION8650.Voltajeb7400') {
                      $Voltajeb_mt_value[$k]=$datos[$i]->mt_value;
                      $Voltajeb_dt_utc[$k]=$datos[$i]->dt_utc;
                      $k++;
                    }
                    if ($datos[$i]->mt_name=='AASA--ION8650.Voltajec7400') {
                      $Voltajec_mt_value[$h]=$datos[$i]->mt_value;
                      $Voltajec_dt_utc[$h]=$datos[$i]->dt_utc;
                      $h++;
                    }
                    if ($datos[$i]->mt_name=='AASA--ION8650.VoltajePromedio7400') {
                      $VoltajePromedio_mt_value[$g]=$datos[$i]->mt_value;
                      $VoltajePromedio_dt_utc[$g]=$datos[$i]->dt_utc;
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
            var Voltajea_dt_utc = '<?php echo json_encode($Voltajea_dt_utc); ?>';
            Voltajea_dt_utc = JSON.parse(Voltajea_dt_utc)

            var Voltajeb_mt_value = '<?php echo json_encode($Voltajeb_mt_value); ?>';
            Voltajeb_mt_value = JSON.parse(Voltajeb_mt_value)

            var Voltajec_mt_value = '<?php echo json_encode($Voltajec_mt_value); ?>';
            Voltajec_mt_value = JSON.parse(Voltajec_mt_value)

            var VoltajePromedio_mt_value = '<?php echo json_encode($VoltajePromedio_mt_value); ?>';
            VoltajePromedio_mt_value = JSON.parse(VoltajePromedio_mt_value)

        </script><?php


        if ($Request->Modal) { 

              ?><script>
                var dt_utc_def1 = Voltajea_dt_utc;
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

                window.Grafico=5;


              </script><?php

              return view("modals.SicutIgnis.submodal");

            } else{ 

              ?><script>
                GraficosIgnisAbajo("aasa2_myChart5", Voltajea_mt_value, Voltajea_dt_utc, Voltajeb_mt_value, Voltajec_mt_value, VoltajePromedio_mt_value, MinDato, MaxDato, "A", "B", "C", "Promedio", 4, false);
                FuncionesCompletas++;
                FuncionExportacion(FuncionesCompletas);
              </script><?php

            } 
       
      }
      public function Grafico5(Request $Request){



          if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }

        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_dt_utc_index) FORCE INDEX (log_aasa_dt_utc_index) 
                                                  WHERE (mt_name='AASA--ION8650.EnerActIny7400' 
                                                  OR mt_name='AASA--ION8650.EnerActRet7400' 
                                                  OR mt_name='AASA--ION8650.EnerReactIny7400' 
                                                  OR mt_name='AASA--ION8650.EnerReactRet7400')
                                                  $Condition 
                                                  ORDER BY mt_name, dt_utc DESC LIMIT 1000;");


                  $j=0; $k=0; $h=0; $g=0;
                  for ($i=0; $i <count($datos) ; $i++) { 
                      if ($datos[$i]->mt_name=='AASA--ION8650.EnerActIny7400') {
                        $EnerActIny_value[$j]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                        $EnerActIny_time[$j]=$datos[$i]->dt_utc;
                        $j++;
                      }
                      if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet7400') {
                        $EnerActRet_value[$k]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                        $k++;
                      }
                      if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny7400') {
                        $EnerReactIny_mt_value[$h]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                        $h++;
                      }
                      if ($i!=count($datos)-1) {
                        if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactRet7400') {
                          $EnerReactRet_mt_value[$g]=$datos[$i]->mt_value-$datos[$i+1]->mt_value;
                          $g++;
                        }
                    } 

                  }

                  for ($i=0; $i <count($EnerActIny_time)-1 ; $i++) { 
                    if ($EnerReactIny_mt_value[$i]==0) {
                      $FPiny[$i]=0;
                    } else{
                      if ($EnerActIny_value[$i]!=0) {
                        $FPiny[$i]=$EnerReactIny_mt_value[$i]/$EnerActIny_value[$i];
                        $FPiny[$i]=cos(atan($FPiny[$i]));
                      }else{
                        $FPiny[$i]=0;
                      }
                    }
                    if ($EnerReactRet_mt_value[$i]==0) {
                      $FPret[$i]=0;
                    } else{
                      if ($EnerActRet_value[$i]!=0) {
                        $FPret[$i]=$EnerReactRet_mt_value[$i]/$EnerActRet_value[$i];
                        $FPret[$i]=cos(atan($FPret[$i]));
                      } else{
                        $FPret[$i]=0;
                      }
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

          var dt_utc = '<?php echo json_encode($EnerActIny_time); ?>';
          dt_utc = JSON.parse(dt_utc)

    


        </script><?php

        if ($Request->Modal) { 

              ?><script>
                var dt_utc_def1 = dt_utc;
                var mt_value_def1 = FPiny;
                var mt_value_def2 = FPret;
                var Grac=1;
                var grafper=5;

                var nombre_1 = "Fecha";
                var nombre_2 = "Factor Potencia Inyectada";
                var nombre_3 = "Factor Potencia Retirada";
                window.Grafico=6;
              </script><?php

              return view("modals.SicutIgnis.submodal");

            } else{ 

              ?><script>
                $("#FactorPotencia_td").text(FPiny[FPiny.length-1]);
              GraficosPotenciaINY("aasa2_myChart6", FPiny, dt_utc, FPret, dt_utc, MinDato, MaxDato, "FPiny", "FPret" , 5);
              </script><?php

            } 


       
       
      }

      public function Grafico7(Request $Request){

           if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND dt_utc > '$Request->Inicio' AND dt_utc < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND dt_utc > DATE_SUB((SELECT dt_utc FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet7400') ORDER BY dt_utc DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }


        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_dt_utc_index) FORCE INDEX (log_aasa_dt_utc_index)
                                                  WHERE (mt_name='AASA--ION8650.EnerActIny7400' 
                                                  OR mt_name='AASA--ION8650.EnerActRet7400')
                                                  $Condition
                                                  ORDER BY mt_name, dt_utc ASC LIMIT 1000;");

          $j=0; $k=0;
          for ($i=0; $i <count($datos) ; $i++) { 

              if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny7400") {
                if ($j==0) {
                  $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value)*4);
                  $EnergiaActivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                    $EnergiaActivaInyectada_mt_value[$j]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value)*4);
                    $EnergiaActivaInyectada_dt_utc[$j]=$datos[$i]->dt_utc;
                  }
                }
                $j++;
              }
              if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet7400') {
                if ($k==0) {
                  $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i]->mt_value)*4)*(-1);
                } else{
                  if ($datos[$i]->mt_value!=0 && $datos[$i-1]->mt_value!=0) {
                    $EnergiaActivaRetirada_mt_value[$k]=abs(($datos[$i]->mt_value-$datos[$i-1]->mt_value)*4)*(-1);
                  }
                }
                $EnergiaActivaRetirada_dt_utc[$k]=$datos[$i]->dt_utc;
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




        ?><script>

          var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
          var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);


            var EnergiaActivaInyectada_mt_value = '<?php echo json_encode($EnergiaActivaInyectada_mt_value); ?>';
            EnergiaActivaInyectada_mt_value = JSON.parse(EnergiaActivaInyectada_mt_value)
            var EnergiaActivaInyectada_dt_utc = '<?php echo json_encode($EnergiaActivaInyectada_dt_utc); ?>';
            EnergiaActivaInyectada_dt_utc = JSON.parse(EnergiaActivaInyectada_dt_utc)

            var EnergiaActivaRetirada_mt_value = '<?php echo json_encode($EnergiaActivaRetirada_mt_value); ?>';
            EnergiaActivaRetirada_mt_value = JSON.parse(EnergiaActivaRetirada_mt_value)
            var EnergiaActivaRetirada_dt_utc = '<?php echo json_encode($EnergiaActivaRetirada_dt_utc); ?>';
            EnergiaActivaRetirada_dt_utc = JSON.parse(EnergiaActivaRetirada_dt_utc)
            var mt_mt=EnergiaActivaRetirada_dt_utc;

            EnergiaActivaInyectada_dt_utc = Object.keys(EnergiaActivaInyectada_dt_utc).map(i => EnergiaActivaInyectada_dt_utc[i])
            EnergiaActivaInyectada_mt_value = Object.keys(EnergiaActivaInyectada_mt_value).map(i => EnergiaActivaInyectada_mt_value[i])
            EnergiaActivaRetirada_mt_value = Object.keys(EnergiaActivaRetirada_mt_value).map(i => EnergiaActivaRetirada_mt_value[i])

      
        </script><?php

        if ($Request->Modal) { 

          ?><script>
                var dt_utc_def1 = EnergiaActivaInyectada_dt_utc;
                var mt_value_def1 = EnergiaActivaInyectada_mt_value;
                var mt_value_def2 = EnergiaActivaRetirada_mt_value;
                var Grac=1;
                var grafper=7;

                var nombre_1 = "Fecha";
                var nombre_2 = "Potencia Inyectada";
                var nombre_3 = "Potencia Retirada";
                window.Grafico=3;

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
                var Colores=[];
                Colores[0]='rgba(66, 134, 244, 0.2)';
                Colores[1]='rgba(66, 134, 244, 1)';
                Colores[2]='rgba(255, 99, 132, 0.2)';
                Colores[3]='rgba(255, 99, 132, 1)';
              PotGenerada(EnergiaActivaInyectada_dt_utc, EnergiaActivaInyectada_mt_value, EnergiaActivaRetirada_mt_value, Colores);
              FuncionesCompletas++;
              FuncionExportacion(FuncionesCompletas);
              </script><?php

            } 
       
       
      }


      public function ExportarSicutExcel(Request $Request){


          return Excel::download(new UsersExport, "Datos.xlsx");
     }


     public function ExportarAasa()
     {
       return Excel::download(new AasaExport, 'Aasa.xlsx');
     }

     public function ExportarAasa2($Grafico)
     {
       return Excel::download(new SubmodalAasa, 'Aasa.xlsx');
     }
  }




 
