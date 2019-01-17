<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Log;

class VinaLuisFelipeController extends Controller{
    public function index(){

    	$id=$_POST['id'];
        $tabla_asociada=$_POST['tabla_asociada'];

    	$instalaciones = DB::table('instalaciones')
												->where("id", $id)
													->first();



    	 return view("modals.VinaLuisFelipe", ["Instalacion" => $instalaciones]);
    }

    public static function Calculos(Request $Request){

      $instalaciones = $_POST["instalacion"];

              $datos = DB::connection('telemetria')
                                  ->select("SELECT * FROM (SELECT * FROM $instalaciones[tabla_asociada] ORDER BY mt_time DESC) T1
                                                                       WHERE  (mt_name='Biofiltro02--Consumo.PH_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Entrada'
                                                                            OR mt_name='Biofiltro02--Consumo.PH_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.ORP_Salida'
                                                                            OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                                                            GROUP BY mt_name");
     

        ?><script>
          RPM("PH", "<?php echo $datos[0]->mt_value ?>", "gauge0", "rpm-0");
          RPM("PH", "<?php echo $datos[1]->mt_value ?>", "gauge1", "rpm-1");
          RPM("PH", "<?php echo $datos[2]->mt_value ?>", "gauge2", "rpm-2");
          RPM("PH", "<?php echo $datos[3]->mt_value ?>", "gauge3", "rpm-3");
          RPM("PH", "<?php echo $datos[4]->mt_value ?>", "gauge4", "rpm-4");
          RPM("PH", "<?php echo $datos[5]->mt_value ?>", "gauge5", "rpm-5");
        </script><?php




        $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.PH_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe1","myChart1", "<?php $mt_value ?>");
       </script><?php




       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.ORP_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe2","myChart2", "<?php $mt_value ?>");
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.Conductividad_Entrada' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe3","myChart3", "<?php $mt_value ?>");
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.PH_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe4","myChart4", "<?php $mt_value ?>");
       </script><?php




       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.ORP_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe5","myChart5", "<?php $mt_value ?>");
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("(SELECT * FROM  log_biofil02 
                                              WHERE mt_name='Biofiltro02--Consumo.Conductividad_Salida' 
                                                  ORDER BY mt_time DESC LIMIT 120) ORDER BY mt_time ASC;");

        for ($i=0; $i < count($datos); $i++) { 
            $mt_value[$i] =  $datos[$i]->mt_value;
        }

       ?><script>
         Graficos("chart-lfe6","myChart6", "<?php $mt_value ?>");
       </script><?php



       $datos = DB::connection('telemetria')
                                  ->select("SELECT * FROM (SELECT * FROM log_biofil02 ORDER BY mt_time DESC) T1
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
                                                                            GROUP BY mt_name");

        for ($i=0; $i <count($datos)/2 ; $i++) { 

          if ($datos[$i]->mt_value==0) {
            $Opertiva[$i]="No Opertiva";
          } else{
            $Opertiva[$i]="Opertiva";
          }
        }

        for ($i=5; $i <count($datos)/2 ; $i++) { 

          if ($datos[$i]->mt_value==0) {
            $ErrorBomba[$i]="No hay Error";
          } else{
            $ErrorBomba[$i]="Error";
          }
        }

        ?><script>
          Bombas("<?php $Operativa ?>","<?php $ErrorBomba ?>")
        </script><?php

        // return $Opertiva;
    
   }

}
