<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PruebaController extends Controller{
    public function index(){
    	
    	$datos = DB::connection('telemetria')
                ->select("SELECT * FROM mt_aasa WHERE mt_time BETWEEN DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND NOW()");

                $EnergiaActivaInyectada = array();

                $EnergíaReactivaInyectada= array();
                $EnergíaReactivaRetirada = array();

                $FaseA = array();
                $FaseB = array();
                $FaseC = array();

                $VoltajeDeLineaAB= array();
                $VoltajeDeLineaBC= array();
                $VoltajeDeLineaCA= array();
                $VoltajeDeLineaPromedio= array();

                $VoltajeA=array();
                $VoltajeB=array();
                $VoltajeC=array();
                $VoltajePromedio=array();

                $FactorPotenciaA = array();
                $FactorPotenciaB = array();
                $FactorPotenciaC = array();
                $FactorPotenciaTotal= array();

                $Datos= array();




                for ($i=0; $i < count($datos); $i++) { 

                	if ($datos[$i]->mt_value==null) {
                		$datos[$i]->mt_value=0;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.EnerActIny") {
                		$EnergiaActivaInyectada[$i] = $datos[$i]->mt_value;
                	}





                	if ($datos[$i]->mt_name=="AASA--ION8650.EnerReactIny") {
                		$EnergíaReactivaInyectada[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.EnerReactRet") {
                		$EnergíaReactivaRetirada[$i] = $datos[$i]->mt_value;
                	}





                	if ($datos[$i]->mt_name=="AASA--ION8650.CorrienteFaseA") {
                		$FaseA[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.CorrienteFaseB") {
                		$FaseB[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.CorrienteFaseC") {
                		$FaseC[$i] = $datos[$i]->mt_value;
                	}






                	if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaab") {
                		$VoltajeDeLineaAB[$i] = $datos[$i]->mt_value;
                	}
                	if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineabc") {
                		$VoltajeDeLineaBC[$i] = $datos[$i]->mt_value;
                	}
                	if ($datos[$i]->mt_name=="AASA--ION8650.VotajeLineaca") {
                		$VoltajeDeLineaCA[$i] = $datos[$i]->mt_value;
                	}
                	if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaPromedio") {
                		$VoltajeDeLineaPromedio[$i] = $datos[$i]->mt_value;
                	}





                	if ($datos[$i]->mt_name=="AASA--ION8650.Voltajea") {
                		$VoltajeA[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.Voltajeb") {
                		$VoltajeB[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.Voltajec") {
                		$VoltajeC[$i] = $datos[$i]->mt_value;
                	}
                	if ($datos[$i]->mt_name=="AASA--ION8650.VoltajePromedio") {
                		$VoltajePromedio[$i] = $datos[$i]->mt_value;
                	}


                	if ($datos[$i]->mt_name=="AASA--ION8650.FactorPotenciaa") {
                		$FactorPotenciaA[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.FactorPotenciab") {
                		$FactorPotenciaB[$i] = $datos[$i]->mt_value;
                	}

                	if ($datos[$i]->mt_name=="AASA--ION8650.FactorPotenciac") {
                		$FactorPotenciaC[$i] = $datos[$i]->mt_value;
                	}
                	if ($datos[$i]->mt_name=="AASA--ION8650.FactorPotenciaTotal") {
                		$FactorPotenciaTotal[$i] = $datos[$i]->mt_value;
                	}

                }



               $EnergiaActivaInyectada = array_sum($EnergiaActivaInyectada) / count($EnergiaActivaInyectada);
               $EnergíaReactivaInyectada = array_sum($EnergíaReactivaInyectada) / count($EnergíaReactivaInyectada);
               $EnergíaReactivaRetirada = array_sum($EnergíaReactivaRetirada) / count($EnergíaReactivaRetirada);

               $FaseA = array_sum($FaseA) / count($FaseA);

               $FaseB = array_sum($FaseB) / count($FaseB);

               $FaseC = array_sum($FaseC) / count($FaseC);

               $VoltajeDeLineaAB = array_sum($VoltajeDeLineaAB) / count($VoltajeDeLineaAB);

               $VoltajeDeLineaBC = array_sum($VoltajeDeLineaBC) / count($VoltajeDeLineaBC);

               $VoltajeDeLineaCA = array_sum($VoltajeDeLineaCA) / count($VoltajeDeLineaCA);

               $VoltajeDeLineaPromedio = array_sum($VoltajeDeLineaPromedio) / count($VoltajeDeLineaPromedio);

               $VoltajeA = array_sum($VoltajeA) / count($VoltajeA);

               $VoltajeB = array_sum($VoltajeB) / count($VoltajeB);

               $VoltajeC = array_sum($VoltajeC) / count($VoltajeC);

               $VoltajePromedio = array_sum($VoltajePromedio) / count($VoltajePromedio);

               $FactorPotenciaA = array_sum($FactorPotenciaA) / count($FactorPotenciaA);

               $FactorPotenciaB = array_sum($FactorPotenciaB) / count($FactorPotenciaB);

               $FactorPotenciaC = array_sum($FactorPotenciaC) / count($FactorPotenciaC);
               $FactorPotenciaTotal = array_sum($FactorPotenciaTotal) / count($FactorPotenciaTotal);


               $Datos["EnergiaActivaInyectada"] = number_format(round($EnergiaActivaInyectada),0,",",".");
               $Datos["EnergíaReactivaInyectada"] = number_format(round($EnergíaReactivaInyectada),0,",",".");
               $Datos["EnergíaReactivaRetirada"] = number_format(round($EnergíaReactivaRetirada),0,",",".");
               $Datos["FaseA"] = number_format(round($FaseA),0,",",".");
               $Datos["FaseB"] = number_format(round($FaseB),0,",",".");
               $Datos["FaseC"] = number_format(round($FaseC),0,",",".");
               $Datos["VoltajeDeLineaAB"] = number_format(round($VoltajeDeLineaAB),0,",",".");
               $Datos["VoltajeDeLineaBC"] = number_format(round($VoltajeDeLineaBC),0,",",".");
               $Datos["VoltajeDeLineaCA"] = number_format(round($VoltajeDeLineaCA),0,",",".");
               $Datos["VoltajeDeLineaPromedio"] = number_format(round($VoltajeDeLineaPromedio),0,",",".");
               $Datos["VoltajeA"] = number_format(round($VoltajeA),0,",",".");
               $Datos["VoltajeB"] = number_format(round($VoltajeB),0,",",".");
               $Datos["VoltajeC"] = number_format(round($VoltajeC),0,",",".");
               $Datos["VoltajePromedio"] = number_format(round($VoltajePromedio),0,",",".");
               $Datos["FactorPotenciaA"] = number_format(round($FactorPotenciaA),0,",",".");
               $Datos["FactorPotenciaB"] = number_format(round($FactorPotenciaB),0,",",".");
               $Datos["FactorPotenciaC"] = number_format(round($FactorPotenciaC),0,",",".");
               $Datos["FactorPotenciaTotal"] = number_format(round($FactorPotenciaTotal),0,",",".");

     					return $Datos;

    }
}
