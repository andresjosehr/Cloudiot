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

                                     return view("SicutIgnis.modal", ["Instalacion" => $instalaciones, "Datos" => $Datos]);
    }
}