<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class InstalacionesController extends Controller{

    public function index(){

    	$usuario =  Auth::user();
    	$instalaciones = DB::table('instalaciones')->get();

    	return view("home", ["Instalaciones" => $instalaciones, "Usuario" => $usuario]);
    }

    public function ConsultaModal(Request $request){
		
			$id=$_POST['id'];
            $tabla_asociada=$_POST['tabla_asociada'];

			$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();
            if ($instalaciones->id==1) {

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



               $Datos["EnergiaActivaInyectada"]    =   abs(reset($EnergiaActivaInyectada) - end($EnergiaActivaInyectada));
               $Datos["EnergíaReactivaInyectada"]  =   abs(reset($EnergíaReactivaInyectada) - end($EnergíaReactivaInyectada));
               $Datos["EnergíaReactivaRetirada"]   =   abs(reset($EnergíaReactivaRetirada) - end($EnergíaReactivaRetirada));
               $Datos["FaseA"]                     =   end($FaseA);
               $Datos["FaseB"]                     =   end($FaseB);
               $Datos["FaseC"]                     =   end($FaseC);
               $Datos["VoltajeDeLineaAB"]          =   abs(reset($VoltajeDeLineaAB) - end($VoltajeDeLineaAB));
               $Datos["VoltajeDeLineaBC"]          =   abs(reset($VoltajeDeLineaBC) - end($VoltajeDeLineaBC));
               $Datos["VoltajeDeLineaCA"]          =   abs(reset($VoltajeDeLineaCA) - end($VoltajeDeLineaCA));
               $Datos["VoltajeDeLineaPromedio"]    =   abs(reset($VoltajeDeLineaPromedio) - end($VoltajeDeLineaPromedio));
               $Datos["VoltajeA"]                  =   abs(reset($VoltajeA) - end($VoltajeA));
               $Datos["VoltajeB"]                  =   abs(reset($VoltajeB) - end($VoltajeB));
               $Datos["VoltajeC"]                  =   abs(reset($VoltajeC) - end($VoltajeC));
               $Datos["VoltajePromedio"]           =   abs(reset($VoltajePromedio) - end($VoltajePromedio));
               $Datos["FactorPotenciaA"]           =   abs(reset($FactorPotenciaA) - end($FactorPotenciaA));
               $Datos["FactorPotenciaB"]           =   abs(reset($FactorPotenciaB) - end($FactorPotenciaB));
               $Datos["FactorPotenciaC"]           =   abs(reset($FactorPotenciaC) - end($FactorPotenciaC));
               $Datos["FactorPotenciaTotal"]       =   abs(reset($FactorPotenciaTotal) - end($FactorPotenciaTotal));

            }


			return view("modals.modal", ["Instalacion" => $instalaciones, "Datos" => $Datos]);

    }

}
