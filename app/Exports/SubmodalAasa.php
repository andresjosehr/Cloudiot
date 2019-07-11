<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Finning;
use DB;


class SubmodalAasa implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

    	if (explode("/",request()->url())[count(explode( "/", request()->url() ))-1]==1) {
    		$Dat=self::Grafico1();
    	}
    	if (explode("/",request()->url())[count(explode( "/", request()->url() ))-1]==2) {
    		$Dat=self::Grafico2();
    	}
    	if (explode("/",request()->url())[count(explode( "/", request()->url() ))-1]==3) {
    		$Dat=self::Grafico3();
    	}
    	if (explode("/",request()->url())[count(explode( "/", request()->url() ))-1]==4) {
    		$Dat=self::Grafico4();
    	}
    	if (explode("/",request()->url())[count(explode( "/", request()->url() ))-1]==5) {
    		$Dat=self::Grafico5();
    	}

    	return view("exports.Aasa.Submodalaasa",["Datos" => $Dat]);
    }







   		 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	////////////////
    	////////////////
    	////////////////
    	//////////////// Grafico 1
    	////////////////
    	////////////////
    	////////////////
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Grafico1()
    {

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


        // $Datos["Cabecera"][0]="Fecha y Hora";
        // $Datos["Cabecera"][1]="Inyectada";
        // $Datos["Cabecera"][2]="Retirada";

		$regkWh["FechayHora"]                = $EnergiaActivaRetirada_mt_time;
		$regkWh["EnergiaActivaInyectada"] = $EnergiaActivaInyectada_mt_value;
		$regkWh["EnergiaActivaRetirada"]  = $EnergiaActivaRetirada_mt_value;

        $Datos["regkWh"]=$regkWh;
        return $Datos;




    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////
    ////////////////
    ////////////////
    //////////////// Grafico 2
    ////////////////
    ////////////////
    ////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Grafico2()
    {
    		if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerReactIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_mt_time_index) FORCE INDEX (log_aasa_mt_time_index) WHERE (mt_name='AASA--ION8650.EnerReactIny' 
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

        $regkVAR['FechayHora']=$EnergiaReactivaInyectada_mt_time;
        $regkVAR['EnergiaReactivaInyectada']=$EnergiaReactivaInyectada_mt_value;
        $regkVAR['EnergiaReactivaRetirada']=$EnergiaReactivaRetirada_mt_value;
       	$Datos["regkVAR"]=$regkVAR;	
       	return  $Datos;

    }
    public function Grafico3()
    {
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	////////////////
    	////////////////
    	////////////////
    	//////////////// Grafico 3
    	////////////////
    	////////////////
    	////////////////
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




            if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }


        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_mt_time_index) FORCE INDEX (log_aasa_mt_time_index)
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

        $PotenciakW['FechayHora']=$EnergiaActivaInyectada_mt_time;
        $PotenciakW['EnergiaReactivaInyectada']=$EnergiaActivaInyectada_mt_value;
        $PotenciakW['EnergiaReactivaRetirada']=$EnergiaActivaRetirada_mt_value;
       	$Datos["PotenciakW"]=$PotenciakW;	
       	return  $Datos;
    }
    public function Grafico4()
    {
    	 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	////////////////
    	////////////////
    	////////////////
    	//////////////// Grafico 4
    	////////////////
    	////////////////
    	////////////////
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




     if (isset($Request->Inicio) && isset($Request->Final)) {
        $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
      } else{
        $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

      }



            $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_mt_time_index) FORCE INDEX (log_aasa_mt_time_index) WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
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


                $VoltajeLineas["FechayHora"]=$VoltajeLineaab_mt_time;
                $VoltajeLineas["VoltajeLineaab"]=$VoltajeLineaab_mt_value;
                $VoltajeLineas["VoltajeLineabc"]=$VoltajeLineabc_mt_value;
                $VoltajeLineas["VoltajeLineaca"]=$VoltajeLineaca_mt_value;
                $VoltajeLineas["VoltajeLineaPromedio"]=$VoltajeLineaPromedio_mt_value;
                $Datos["VoltajeLineas"]=$VoltajeLineas;
                return  $Datos;
    }
    public function Grafico5()
    {
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	////////////////
    	////////////////
    	////////////////
    	//////////////// Grafico 5
    	////////////////
    	////////////////
    	////////////////
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


            

                  if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.Voltajea') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }


        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_mt_time_index) FORCE INDEX (log_aasa_mt_time_index) WHERE (mt_name='AASA--ION8650.Voltajea'
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

                $VoltajeFases["FechayHora"]=$Voltajea_mt_time;
                $VoltajeFases["Voltajea"]=$Voltajea_mt_value;
                $VoltajeFases["Voltajeb"]=$Voltajeb_mt_value;
                $VoltajeFases["Voltajec"]=$Voltajec_mt_value;
                $VoltajeFases["VoltajePromedio"]=$VoltajePromedio_mt_value;
                $Datos["VoltajeFases"]=$VoltajeFases;
                return $Datos;
    }
    public function Grafico6()
    {
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    	////////////////
    	////////////////
    	////////////////
    	//////////////// Grafico 6
    	////////////////
    	////////////////
    	////////////////
    	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



                 if (isset($Request->Inicio) && isset($Request->Final)) {
          $Condition = "AND mt_time > '$Request->Inicio' AND mt_time < '".date("Y-m-d",strtotime($Request->Final."+ 1 days"))."'";
        } else{
          $Horas=24;
          $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

        }

        $datos = DB::connection('telemetria')
                                      ->select("SELECT * FROM log_aasa FORCE INDEX (log_aasa_mt_time_index) FORCE INDEX (log_aasa_mt_time_index) 
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
                // $FactorPotencia=["mt_time"]=$EnerActIny_time;
                $FactorPotencia["FPiny"]=$FPiny;
                $Datos["FactorPotencia"]=$FactorPotencia;
                return  $Datos;

    }



    	




       



      	




      	
}
