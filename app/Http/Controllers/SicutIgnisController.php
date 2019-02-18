<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class SicutIgnisController extends Controller{
    public function index(Request $request){
    	
    	$id=$_POST['id'];
            $tabla_asociada=$_POST['tabla_asociada'];

			$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();


                      $EnergiaActivaInyectada = array();

                      $EnergíaReactivaInyectada= array();
                      $EnergíaReactivaRetirada = array();

                      $FaseA = array();
                      $FaseB = array();
                      $FaseC = array();

                      $VoltajeDeLineaAB= array();
                      $VoltajeDeLineaBC= array();
                      $VoltajeDeLineaCA= array();
                      $VoltajeDeLineaPromedio = array();

                      $VoltajeA=array();
                      $VoltajeB=array();
                      $VoltajeC=array();
                      $VoltajePromedio=array();

                      $FactorPotenciaA = array();
                      $FactorPotenciaB = array();
                      $FactorPotenciaC = array();
                      $FactorPotenciaTotal= array();

                      $Datos= array();



                      // $dato = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerActIny' ORDER BY mt_time DESC LIMIT 2");

                      // $EnergiaActivaInyectada = $dato[0]->mt_value-$dato[1]->mt_value;


                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerActRet' ORDER BY mt_time DESC LIMIT 3");

                      // $EnergiaActivarRetirada = $dato[0]->mt_value-$dato[1]->mt_value;


                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerReactIny' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $EnergíaReactivaInyectada = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.EnerReactIny")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();



                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerReactRet' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $EnergíaReactivaRetirada = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.EnerReactRet")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();


                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajea' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $VoltajeA = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.Voltajea")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();


                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajeb' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $VoltajeB = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.Voltajeb")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();






                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajec' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $VoltajeC = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.Voltajec")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();





                      // $fecha = DB::connection('telemetria')
                      //               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.VoltajePromedio' ORDER BY mt_time DESC LIMIT 1");

                      //           $date= $fecha[0]->mt_time; 
                      //           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      // $VoltajePromedio = DB::connection('telemetria')
                      //                            ->table("mt_aasa")
                      //                            ->where("mt_name", "AASA--ION8650.VoltajePromedio")
                      //                            ->where("mt_time", ">", $newDate)
                      //                            ->orderBy("mt_time", "desc")
                      //                            ->get();



                      //               $fecha = DB::connection('telemetria')
                      //                               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciaa' ORDER BY mt_time DESC LIMIT 1");

                      //                           $date= $fecha[0]->mt_time; 
                      //                           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //                           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      //                 $FactorPotenciaA = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.FactorPotenciaa")
                      //                                            ->where("mt_time", ">", $newDate)
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->get();


                      //               $fecha = DB::connection('telemetria')
                      //                               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciab' ORDER BY mt_time DESC LIMIT 1");

                      //                           $date= $fecha[0]->mt_time; 
                      //                           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //                           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      //                 $FactorPotenciaB = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.FactorPotenciab")
                      //                                            ->where("mt_time", ">", $newDate)
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->get();




                      //               $fecha = DB::connection('telemetria')
                      //                               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciac' ORDER BY mt_time DESC LIMIT 1");

                      //                           $date= $fecha[0]->mt_time; 
                      //                           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //                           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      //                 $FactorPotenciaC = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.FactorPotenciac")
                      //                                            ->where("mt_time", ">", $newDate)
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->get();




                      //               $fecha = DB::connection('telemetria')
                      //                               ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciaTotal' ORDER BY mt_time DESC LIMIT 1");

                      //                           $date= $fecha[0]->mt_time; 
                      //                           $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                      //                           $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      //                 $FactorPotenciaTotal = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.FactorPotenciaTotal")
                      //                                            ->where("mt_time", ">", $newDate)
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->get();

                                      



                      //                 $UltimaMedicion = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->first();









                      //                 $VoltajeDeLineaAB = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.VoltajeLineaab")
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->first();
                                      

                                      
                      //                 $VoltajeDeLineaBC = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.VoltajeLineabc")
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->first();
                                      

                                      
                      //                 $VoltajeDeLineaCA = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.VotajeLineaca")
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->first();


                      //                 $VoltajeDeLineaPromedio = DB::connection('telemetria')
                      //                                            ->table("mt_aasa")
                      //                                            ->where("mt_name", "AASA--ION8650.VoltajeLineaPromedio")
                      //                                            ->orderBy("mt_time", "desc")
                      //                                            ->first();


                      $Info= DB::connection("telemetria")
                                  ->select("(SELECT mt_name, mt_value, MAX(mt_time) AS mt_time FROM mt_aasa 
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

                                     $Datos["FactorPotenciaA"]          =   $Info[9]->mt_value;                                     $Datos["FactorPotenciaB"]          =   $Info[11]->mt_value;
                                     $Datos["FactorPotenciaC"]          =   $Info[13]->mt_value;
                                     $Datos["FactorPotenciaTotal"]      =   $Info[15]->mt_value;

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
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                        OR mt_name='AASA--ION8650.EnerActRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
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

        </script><?php
     
    }
    public function Grafico2(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny'
                                                                        OR mt_name='AASA--ION8650.EnerReactRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
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
      </script><?php
     
    }



    public function Grafico3(Request $Request){

            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VotajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
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
                  if ($datos[$i]->mt_name=="AASA--ION8650.VotajeLineaca") {
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

          var VoltajeLineaca_mt_value = '0';
          VoltajeLineaca_mt_value = JSON.parse(VoltajeLineaca_mt_value)

          var VoltajeLineaPromedio_mt_value = '<?php echo json_encode($VoltajeLineaPromedio_mt_value); ?>';
          VoltajeLineaPromedio_mt_value = JSON.parse(VoltajeLineaPromedio_mt_value)

          GraficosIgnisAbajo("myChart4", VoltajeLineaab_mt_value, VoltajeLineaab_mt_time, VoltajeLineabc_mt_value, VoltajeLineaca_mt_value, VoltajeLineaPromedio_mt_value, MinDato, MaxDato, "A-B", "B-C", "C-A", "Promedio", 3);
      </script><?php
     
    }
    public function Grafico4(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.Voltajeb'
                                                                        OR mt_name='AASA--ION8650.Voltajec'
                                                                        OR mt_name='AASA--ION8650.VoltajePromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.Voltajea') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
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


          GraficosIgnisAbajo("myChart5", Voltajea_mt_value, Voltajea_mt_time, Voltajeb_mt_value, Voltajec_mt_value, VoltajePromedio_mt_value, MinDato, MaxDato, "Voltaje A", "Voltaje B", "Voltaje C", "Voltaje Promedio", 4);
      </script><?php
     
    }
    public function Grafico5(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaa'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaa') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC ");
                  $j=0;
                  $k=0;                  
                  $h=0;
                  $g=0;
                for ($i=0; $i <count($datos) ; $i++) { 
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaa') {
                    $FactorPotenciaa_mt_value[$j]=$datos[$i]->mt_value;
                    $FactorPotenciaa_mt_time[$j]=$datos[$i]->mt_time;
                    $j++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciab') {
                    $FactorPotenciab_mt_value[$k]=$datos[$i]->mt_value;
                    $FactorPotenciab_mt_time[$k]=$datos[$i]->mt_time;
                    $k++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciac') {
                    $FactorPotenciac_mt_value[$h]=$datos[$i]->mt_value;
                    $FactorPotenciac_mt_time[$h]=$datos[$i]->mt_time;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaTotal') {
                    $FactorPotenciaTotal_mt_value[$g]=$datos[$i]->mt_value;
                    $FactorPotenciaTotal_mt_time[$g]=$datos[$i]->mt_time;
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


          GraficosIgnisAbajo("myChart6", FactorPotenciaa_mt_value, FactorPotenciaa_mt_time, FactorPotenciab_mt_value, FactorPotenciac_mt_value, FactorPotenciaTotal_mt_value, MinDato, MaxDato, "Factor Potencia A", "Factor Potencia B", "Factor Potencia C", "Factor Potencia Total", 5);
      </script><?php
     
     
    }


}



 // $datos = DB::connection('telemetria')
 //                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny'
 //                                                                        OR mt_name='AASA--ION8650.EnerActRet'
 //                                                                        OR mt_name='AASA--ION8650.EnerReactIny'
 //                                                                        OR mt_name='AASA--ION8650.EnerReactRet'
 //                                                                        OR mt_name='AASA--ION8650.VoltajeLineaab'
 //                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
 //                                                                        OR mt_name='AASA--ION8650.VotajeLineaca'
 //                                                                        OR mt_name='AASA--ION8650.VoltajeLineaPromedio'
 //                                                                        OR mt_name='AASA--ION8650.Voltajea'
 //                                                                        OR mt_name='AASA--ION8650.Voltajeb'
 //                                                                        OR mt_name='AASA--ION8650.Voltajec'
 //                                                                        OR mt_name='AASA--ION8650.VoltajePromedio'
 //                                                                        OR mt_name='AASA--ION8650.FactorPotenciaa'
 //                                                                        OR mt_name='AASA--ION8650.FactorPotenciab'
 //                                                                        OR mt_name='AASA--ION8650.FactorPotenciac'
 //                                                                        OR mt_name='AASA--ION8650.FactorPotenciaTotal')
 //                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
 //                                                                        ORDER BY mt_name, mt_time DESC ");