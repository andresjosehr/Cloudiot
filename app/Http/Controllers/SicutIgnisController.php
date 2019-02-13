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



                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerActIny' ORDER BY mt_time DESC LIMIT 1");



                                  

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $EnergiaActivaInyectada = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.EnerActIny")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();


                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerActRet' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $EnergiaActivarRetirada = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.EnerActIny")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();


                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerReactIny' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $EnergíaReactivaInyectada = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.EnerReactIny")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();



                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.EnerReactRet' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $EnergíaReactivaRetirada = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.EnerReactRet")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();


                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajea' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $VoltajeA = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.Voltajea")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();


                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajeb' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $VoltajeB = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.Voltajeb")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();






                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.Voltajec' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $VoltajeC = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.Voltajec")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();





                      $fecha = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.VoltajePromedio' ORDER BY mt_time DESC LIMIT 1");

                                $date= $fecha[0]->mt_time; 
                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                      $VoltajePromedio = DB::connection('telemetria')
                                                 ->table("mt_aasa")
                                                 ->where("mt_name", "AASA--ION8650.VoltajePromedio")
                                                 ->where("mt_time", ">", $newDate)
                                                 ->orderBy("mt_time", "desc")
                                                 ->get();



                                    $fecha = DB::connection('telemetria')
                                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciaa' ORDER BY mt_time DESC LIMIT 1");

                                                $date= $fecha[0]->mt_time; 
                                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                                      $FactorPotenciaA = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.FactorPotenciaa")
                                                                 ->where("mt_time", ">", $newDate)
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->get();


                                    $fecha = DB::connection('telemetria')
                                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciab' ORDER BY mt_time DESC LIMIT 1");

                                                $date= $fecha[0]->mt_time; 
                                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                                      $FactorPotenciaB = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.FactorPotenciab")
                                                                 ->where("mt_time", ">", $newDate)
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->get();




                                    $fecha = DB::connection('telemetria')
                                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciac' ORDER BY mt_time DESC LIMIT 1");

                                                $date= $fecha[0]->mt_time; 
                                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                                      $FactorPotenciaC = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.FactorPotenciac")
                                                                 ->where("mt_time", ">", $newDate)
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->get();




                                    $fecha = DB::connection('telemetria')
                                                    ->select("SELECT * FROM mt_aasa WHERE mt_name='AASA--ION8650.FactorPotenciaTotal' ORDER BY mt_time DESC LIMIT 1");

                                                $date= $fecha[0]->mt_time; 
                                                $newDate = strtotime ( '-15 minute' , strtotime ($date) ) ; 
                                                $newDate = date ( 'Y-m-j H:i:s' , $newDate); 

                                      $FactorPotenciaTotal = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.FactorPotenciaTotal")
                                                                 ->where("mt_time", ">", $newDate)
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->get();

                                      



                                      $UltimaMedicion = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->first();









                                      $VoltajeDeLineaAB = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.VoltajeLineaab")
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->first();
                                      

                                      
                                      $VoltajeDeLineaBC = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.VoltajeLineabc")
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->first();
                                      

                                      
                                      $VoltajeDeLineaCA = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.VotajeLineaca")
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->first();


                                      $VoltajeDeLineaPromedio = DB::connection('telemetria')
                                                                 ->table("mt_aasa")
                                                                 ->where("mt_name", "AASA--ION8650.VoltajeLineaPromedio")
                                                                 ->orderBy("mt_time", "desc")
                                                                 ->first();



                                     $Datos["UltimaMedicion"] = $UltimaMedicion->mt_time;
                                      $Datos["VoltajeDeLineaAB"]       = $VoltajeDeLineaAB->mt_value;
                                      $Datos["VoltajeDeLineaBC"]       = $VoltajeDeLineaBC->mt_value;
                                      $Datos["VoltajeDeLineaCA"]       = $VoltajeDeLineaCA->mt_value;
                                      $Datos["VoltajeDeLineaPromedio"] = $VoltajeDeLineaPromedio->mt_value;
                                    

                                     $Datos["EnergiaActivaInyectada"]    =   abs($EnergiaActivaInyectada[0]->mt_value - $EnergiaActivaInyectada[count($EnergiaActivaInyectada)-1]->mt_value);
                                     $Datos["EnergiaActivaRetirada"]    =   abs($EnergiaActivarRetirada[0]->mt_value - $EnergiaActivarRetirada[count($EnergiaActivarRetirada)-1]->mt_value);
                                     $Datos["EnergíaReactivaInyectada"]  =   abs($EnergíaReactivaInyectada[0]->mt_value - $EnergíaReactivaInyectada[count($EnergíaReactivaInyectada)-1]->mt_value);
                                     $Datos["EnergíaReactivaRetirada"]   =   abs($EnergíaReactivaRetirada[0]->mt_value - $EnergíaReactivaRetirada[count($EnergíaReactivaRetirada)-1]->mt_value);
                                     $Datos["VoltajeA"]                  =   abs($VoltajeA[0]->mt_value - $VoltajeA[count($VoltajeA)-1]->mt_value);
                                     $Datos["VoltajeB"]                  =   abs($VoltajeB[0]->mt_value - $VoltajeB[count($VoltajeB)-1]->mt_value);
                                     $Datos["VoltajeC"]                  =   abs($VoltajeC[0]->mt_value - $VoltajeC[count($VoltajeC)-1]->mt_value);
                                     $Datos["VoltajePromedio"]           =   abs($VoltajePromedio[0]->mt_value - $VoltajePromedio[count($VoltajePromedio)-1]->mt_value);
                                     $Datos["FactorPotenciaA"]           =   abs($FactorPotenciaA[0]->mt_value - $FactorPotenciaA[count($FactorPotenciaA)-1]->mt_value);
                                     $Datos["FactorPotenciaB"]           =   abs($FactorPotenciaB[0]->mt_value - $FactorPotenciaB[count($FactorPotenciaB)-1]->mt_value);
                                     $Datos["FactorPotenciaC"]           =   abs($FactorPotenciaC[0]->mt_value - $FactorPotenciaC[count($FactorPotenciaC)-1]->mt_value);
                                     $Datos["FactorPotenciaTotal"]       =   abs($FactorPotenciaTotal[0]->mt_value - $FactorPotenciaTotal[count($FactorPotenciaTotal)-1]->mt_value);

                                     return view("modals.SicutIgnis", ["Instalacion" => $instalaciones, "Datos" => $Datos]);
    }

    public function Grafico1(Request $Request){

       $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                        OR mt_name='AASA--ION8650.EnerActRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");
        $j=0;
        $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 
          if ($datos[$i]->mt_value<20000000 && $datos[$i]->mt_value!=0) {
            if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny") {
              $EnergiaActivaInyectada_mt_value[$j]=$datos[$i]->mt_value;
              $EnergiaActivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
              $j++;
            }
            if ($datos[$i]->mt_name=='AASA--ION8650.EnerActRet') {
              $EnergiaActivaRetirada_mt_value[$k]=$datos[$i]->mt_value;
              $EnergiaActivaRetirada_mt_time[$k]=$datos[$i]->mt_time;
              $k++;
            }
          }
        }

        ?><script>
          var EnergiaActivaInyectada_mt_value = '<?php echo json_encode($EnergiaActivaInyectada_mt_value); ?>';
          EnergiaActivaInyectada_mt_value = JSON.parse(EnergiaActivaInyectada_mt_value)
          var EnergiaActivaInyectada_mt_time = '<?php echo json_encode($EnergiaActivaInyectada_mt_time); ?>';
          EnergiaActivaInyectada_mt_time = JSON.parse(EnergiaActivaInyectada_mt_time)

          var EnergiaActivaRetirada_mt_value = '<?php echo json_encode($EnergiaActivaRetirada_mt_value); ?>';
          EnergiaActivaRetirada_mt_value = JSON.parse(EnergiaActivaRetirada_mt_value)
          var EnergiaActivaRetirada_mt_time = '<?php echo json_encode($EnergiaActivaRetirada_mt_time); ?>';
          EnergiaActivaRetirada_mt_time = JSON.parse(EnergiaActivaRetirada_mt_time)

          GraficosIgnisArriba("myChart0", EnergiaActivaInyectada_mt_value, EnergiaActivaInyectada_mt_time, EnergiaActivaRetirada_mt_value, EnergiaActivaRetirada_mt_time, "Energia Activa Inyectada", "Energia Activa Retirada" , 1);

        </script><?php
     
    }
    public function Grafico2(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny'
                                                                        OR mt_name='AASA--ION8650.EnerReactRet')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");

        $j=0;
        $k=0;
        for ($i=0; $i <count($datos) ; $i++) { 

          if ($datos[$i]->mt_value<20000000 && $datos[$i]->mt_value!=0) {

              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactIny') {
                $EnergiaReactivaInyectada_mt_value[$j]=$datos[$i]->mt_value;
                $EnergiaReactivaInyectada_mt_time[$j]=$datos[$i]->mt_time;
                $j++;
              }
              if ($datos[$i]->mt_name=='AASA--ION8650.EnerReactRet') {
                $EnergiaReactivaRetirada_mt_value[$k]=$datos[$i]->mt_value;
                $EnergiaReactivaRetirada_mt_time[$k]=$datos[$i]->mt_time;
                $k++;
              }

          }
        }

      ?><script>
         var EnergiaReactivaInyectada_mt_value = '<?php echo json_encode($EnergiaReactivaInyectada_mt_value); ?>';
          EnergiaReactivaInyectada_mt_value = JSON.parse(EnergiaReactivaInyectada_mt_value)
          var EnergiaReactivaInyectada_mt_time = '<?php echo json_encode($EnergiaReactivaInyectada_mt_time); ?>';
          EnergiaReactivaInyectada_mt_time = JSON.parse(EnergiaReactivaInyectada_mt_time)

          var EnergiaReactivaRetirada_mt_value = '<?php echo json_encode($EnergiaReactivaRetirada_mt_value); ?>';
          EnergiaReactivaRetirada_mt_value = JSON.parse(EnergiaReactivaRetirada_mt_value)
          var EnergiaReactivaRetirada_mt_time = '<?php echo json_encode($EnergiaReactivaRetirada_mt_time); ?>';
          EnergiaReactivaRetirada_mt_time = JSON.parse(EnergiaReactivaRetirada_mt_time)

          GraficosIgnisArriba("myChart1", EnergiaReactivaInyectada_mt_value, EnergiaReactivaInyectada_mt_time, EnergiaReactivaRetirada_mt_value, EnergiaReactivaRetirada_mt_time, "Energia Reactiva Inyectada", "Energia Reactiva Retirada", 2);
      </script><?php
     
    }



    public function Grafico3(Request $Request){

            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VotajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.VotajeLineaca') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");
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
                }

      ?><script>
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


          GraficosIgnisAbajo("myChart4", VoltajeLineaab_mt_value, VoltajeLineaab_mt_time, VoltajeLineabc_mt_value, VoltajeLineaca_mt_value, VoltajeLineaPromedio_mt_value, "VoltajeLinea AB", "VoltajeLinea BC", "Voltaje Linea CA", "Voltaje Linea Promedio", 3);
      </script><?php
     
    }
    public function Grafico4(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.Voltajeb'
                                                                        OR mt_name='AASA--ION8650.Voltajec'
                                                                        OR mt_name='AASA--ION8650.VoltajePromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.VotajeLineaca') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");
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
                }

      ?><script>
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


          GraficosIgnisAbajo("myChart5", Voltajea_mt_value, Voltajea_mt_time, Voltajeb_mt_value, Voltajec_mt_value, VoltajePromedio_mt_value, "Voltaje A", "Voltaje B", "Voltaje C", "Voltaje Promedio", 4);
      </script><?php
     
    }
    public function Grafico5(Request $Request){

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaa'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.VotajeLineaca') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");
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
                }

      ?><script>
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


          GraficosIgnisAbajo("myChart6", FactorPotenciaa_mt_value, Voltajea_mt_time, FactorPotenciab_mt_value, FactorPotenciac_mt_value, FactorPotenciaTotal_mt_value, "Factor Potencia A", "Factor Potencia B", "Factor Potencia C", "Factor Potencia Total", 5);
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
 //    for ($i=0; $i <count($datos) ; $i++) { 
 //      if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaa') {
 //        $FactorPotenciaa_mt_value[$i]=$datos[$i]->mt_value;
 //        $FactorPotenciaa_mt_time[$i]=$datos[$i]->mt_time;
 //      }
 //      if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciab') {
 //        $FactorPotenciab_mt_value[$i]=$datos[$i]->mt_value;
 //        $FactorPotenciab_mt_time[$i]=$datos[$i]->mt_time;
 //      }
 //      if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciac') {
 //        $FactorPotenciac_mt_value[$i]=$datos[$i]->mt_value;
 //        $FactorPotenciac_mt_time[$i]=$datos[$i]->mt_time;
 //      }
 //      if ($datos[$i]->mt_name=='AASA--ION8650.FactorPotenciaTotal') {
 //        $FactorPotenciaTotal_mt_value[$i]=$datos[$i]->mt_value;
 //        $FactorPotenciaTotal_mt_time[$i]=$datos[$i]->mt_time;
 //      }
 //    }
