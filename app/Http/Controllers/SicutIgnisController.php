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
                                  ->select("(SELECT mt_name, mt_value, MAX(mt_time) AS mt_time FROM log_aasa 
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

                                     $Datos["FactorPotenciaA"]          =   number_format($Info[9]->mt_value/10000, 2, ",", "");
                                     $Datos["FactorPotenciaB"]          =   number_format($Info[11]->mt_value/10000, 2, ",", "");
                                     $Datos["FactorPotenciaC"]          =   number_format($Info[13]->mt_value/10000, 2, ",", "");
                                     $Datos["FactorPotenciaTotal"]      =   number_format($Info[15]->mt_value/10000, 2, ",", "");

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

       $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                        OR mt_name='AASA--ION8650.EnerActRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC ");
        $j=0;
        $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 

            if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny") {
              if ($j==0) {
                $EnergiaActivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i]->mt_value;
              } else{
                $EnergiaActivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
              }
              $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
              $j++;
            }
            if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet') {
              if ($k==0) {
                $EnergiaActivaRetirada_mt_value[$k]=$datos[$i]->mt_value-$datos[$i]->mt_value;
              } else{
                $EnergiaActivaRetirada_mt_value[$k]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
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

          GraficosIgnisArriba("myChart0", EnergiaActivaInyectada_mt_value, EnergiaActivaInyectada_mt_time, EnergiaActivaRetirada_mt_value, EnergiaActivaRetirada_mt_time, MinDato, MaxDato, "Inyectada", "Retirada" , 1);
          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
        </script><?php
     
    }
    public function Grafico2(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny'
                                                                        OR mt_name='AASA--ION8650.EnerReactRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC ");

        $j=0;
        $k=0;
        $MinDato_a=999999999999999999999999999999999999999999999999999999999999999999999;
        $MaxDato_a=0;
        $MinDato_b=$MinDato_a;
        $MaxDato_b=$MaxDato_a;

        for ($i=0; $i <count($datos) ; $i++) { 

              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny') {

                if ($i==0) {
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i]->mt_value;
                } else{
                  $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
                }
                $EnergiaReactivaInyectada_mt_time[$j]=$datos[$i]->mt_time;

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
                  $EnergiaReactivaRetirada_mt_value[$k]=$datos[$i]->mt_value-$datos[$i-1]->mt_value;
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

          GraficoIgnisArribaDerecha("myChart1", EnergiaReactivaInyectada_mt_value, EnergiaReactivaInyectada_mt_time, EnergiaReactivaRetirada_mt_value, EnergiaReactivaRetirada_mt_time, MinDato_a, MaxDato_a, MinDato_b, MaxDato_b, "Inyectada", "Retirada", 2);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
      </script><?php
     
    }



    public function Grafico3(Request $Request){

            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC");
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

          GraficosIgnisAbajo("myChart4", VoltajeLineaab_mt_value, VoltajeLineaab_mt_time, VoltajeLineabc_mt_value, VoltajeLineaca_mt_value, VoltajeLineaPromedio_mt_value, MinDato, MaxDato, "A-B", "B-C", "C-A", "Promedio", 3, false);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
      </script><?php
     
    }
    public function Grafico4(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.Voltajeb'
                                                                        OR mt_name='AASA--ION8650.Voltajec'
                                                                        OR mt_name='AASA--ION8650.VoltajePromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC ");
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


          GraficosIgnisAbajo("myChart5", Voltajea_mt_value, Voltajea_mt_time, Voltajeb_mt_value, Voltajec_mt_value, VoltajePromedio_mt_value, MinDato, MaxDato, "A", "B", "C", "Promedio", 4, false);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
      </script><?php
     
    }
    public function Grafico5(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaa'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaa') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC ");
                  $j=0;
                  $k=0;                  
                  $h=0;
                  $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaa') {
                    $FactorPotenciaa_mt_value[$j]= $datos[$i]->mt_value/10000;
                    $FactorPotenciaa_mt_time[$j]=$datos[$i]->mt_time;
                    $j++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciab') {
                    $FactorPotenciab_mt_value[$k]= $datos[$i]->mt_value/10000;
                    $FactorPotenciab_mt_time[$k]=$datos[$i]->mt_time;
                    $k++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciac') {
                    $FactorPotenciac_mt_value[$h]= $datos[$i]->mt_value/10000;
                    $FactorPotenciac_mt_time[$h]=$datos[$i]->mt_time;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaTotal') {
                    $FactorPotenciaTotal_mt_value[$g]= $datos[$i]->mt_value/10000;
                    $FactorPotenciaTotal_mt_time[$g]=$datos[$i]->mt_time;
                    $g++;
                  }
                  if ($i==0) {
                    $MinDato=999999999999999999999999999999999999999999999999999999999999999999999;
                    $MaxDato=0;
                  } else{
                    if ($MinDato>$datos[$i]->mt_value/10000 && $datos[$i]->mt_value!=0) {
                      $MinDato=$datos[$i]->mt_value/10000;
                    }
                    if ($MaxDato<$datos[$i]->mt_value/10000) {
                      $MaxDato=$datos[$i]->mt_value/10000;
                    }
                  }
                }

      ?><script>

         var MinDato=parseInt('<?php echo $MinDato; ?>', 10);
          var MaxDato=parseInt('<?php echo $MaxDato; ?>', 10);

          var FactorPotenciaa_mt_value = '<?php echo json_encode($FactorPotenciaa_mt_value); ?>';
          FactorPotenciaa_mt_value = JSON.parse(FactorPotenciaa_mt_value)
          var FactorPotenciaa_mt_time = '<?php echo json_encode($FactorPotenciaa_mt_time); ?>';
          FactorPotenciaa_mt_time = JSON.parse(FactorPotenciaa_mt_time)

          var FactorPotenciab_mt_value = '<?php echo json_encode($FactorPotenciab_mt_value); ?>';
          FactorPotenciab_mt_value = JSON.parse(FactorPotenciab_mt_value)

          var FactorPotenciac_mt_value = '<?php echo json_encode($FactorPotenciac_mt_value); ?>';
          FactorPotenciac_mt_value = JSON.parse(FactorPotenciac_mt_value)

          var FactorPotenciaTotal_mt_value = '<?php echo json_encode($FactorPotenciaTotal_mt_value); ?>';
          FactorPotenciaTotal_mt_value = JSON.parse(FactorPotenciaTotal_mt_value)


          GraficosIgnisAbajo("myChart6", FactorPotenciaa_mt_value, FactorPotenciaa_mt_time, FactorPotenciab_mt_value, FactorPotenciac_mt_value, FactorPotenciaTotal_mt_value, MinDato, MaxDato, "Factor Potencia A", "Factor Potencia B", "Factor Potencia C", "Factor Potencia Total", 5, false);

          FuncionesCompletas++;
          FuncionExportacion(FuncionesCompletas);
      </script><?php
     
     
    }


    public function Grafico6(Request $Request){
      ?><script>
        SicutPieChart();
        FuncionesCompletas++;
        FuncionExportacion(FuncionesCompletas);
      </script><?php
     
     
    }

    public function Grafico7(Request $Request){
      ?><script>
        PotGenerada();
        FuncionesCompletas++;
        FuncionExportacion(FuncionesCompletas);
      </script><?php
     
     
    }


    public function ExportarSicutExcel(Request $Request){


        return Excel::download(new UsersExport, "Datos.xlsx");
   }
}




class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;


    public function collection(){


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



       return collect($Datos);



       
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Ene Act Inyectada',
            'Ene Act Retirada',
            'Ene React Inyectada',
            'Ene React Retirada',
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

}
