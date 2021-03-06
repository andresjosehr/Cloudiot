<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


use Illuminate\Http\Request;
use DB;
use Auth;

class MaitenalController extends Controller
{
    public function index(){

      $FlujoTotal = DB::connection("telemetria")->table("log_biofil04")->where("mt_name", "Biofiltro04--Consumo.Flujo")->orderby("mt_time", "desc")->first();

    	return view("modals.Maitenal.Maitenal", ["UltimaMedicion" => DB::connection("telemetria")->table("log_biofil04")->orderby("mt_time", "desc")->first(), "FlujoTotal" => $FlujoTotal]);
    }



     public function MostrarBombas(){
      $datos= DB::connection("telemetria")
                        ->select("SELECT DATE_FORMAT(mt_time, '%Y-%m-%d %H:%i') as mt_time, mt_name, mt_value FROM log_biofil04 WHERE (mt_name='Biofiltro04--Consumo.EstadoBomba1'
                                                                 OR mt_name='Biofiltro04--Consumo.EstadoBomba2'
                                                                 OR mt_name='Biofiltro04--Consumo.Flujo')
                                                                 AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE (mt_name='Biofiltro04--Consumo.EstadoBomba1' OR mt_name='Biofiltro04--Consumo.EstadoBomba2') AND mt_value<>0 ORDER BY mt_time DESC LIMIT 1), INTERVAL 3 HOUR)
                                                                 ORDER BY mt_name ASC, mt_time ASC");
          $Determinante="No hay nada papa";

          


                        
       $j=0;
       $k=0;
       $h=0;
       $g=0;
       for ($i=0; $i <count($datos); $i++) {

        if ($datos[$i]->mt_name=="Biofiltro04--Consumo.EstadoBomba1" || $datos[$i]->mt_name=="Biofiltro04--Consumo.EstadoBomba2" || $datos[$i]->mt_name=="Biofiltro02--Consumo.EstadoBomba3") {

            if ($datos[$i]->mt_value!="0") {

              $BombaActiva[$k][$j]["mt_name"] =   $datos[$i]->mt_name;
              $BombaActiva[$k][$j]["value"]   =   $datos[$i]->mt_value;
              $BombaActiva[$k][$j]["mt_time"] =   $datos[$i]->mt_time;
              $Tiempo[$k][$j]                 =   $datos[$i]->mt_time;

              $j++;
              $h++;

            }
            if ($datos[$i]->mt_value=="0") {
              $j=0;
            }
            if ($i!=0) {
              if ($datos[$i]->mt_value=="0" && $datos[$i-1]->mt_value=="1") {
                $k++;
              } 
            }   
       }  else{
        $Flujo[$g]["mt_name"]=$datos[$i]->mt_name;
        $Flujo[$g]["mt_time"]=$datos[$i]->mt_time;
        $Flujo[$g]["mt_value"]=$datos[$i]->mt_value;

        $FlujoEpa[$datos[$i]->mt_time]=$datos[$i]->mt_value;
        $g++;
      }
    
    } 

    
    if ($h!=0) {
      


       if (isset($BombaActiva)) {
         
                for ($i=0; $i <count($BombaActiva); $i++) { 
                    $FechaInicio[$i]                          =  reset($Tiempo[$i]);
                    $FechaFin[$i]["date"]  =  end($Tiempo[$i]);
                    $BombasOperativas[$i]["FechaInicio"]      =  reset($Tiempo[$i]);
                    $BombasOperativas[$i]["FechaFin"]         =  end($Tiempo[$i]);
                    $BombasOperativas[$i]["MinutosOperativa"] =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
                    $BombasOperativas[$i]["Bomba"]            =  $BombaActiva[$i][0]["mt_name"];
                    $MinutosOperativa[$i]                     =  count(array_map("unserialize", array_unique(array_map("serialize", $BombaActiva[$i]))));
                    $Bomba[$i]                                =  $BombaActiva[$i][0]["mt_name"];  
                }



                $i=0;
                foreach ($FechaFin as $key => $part) {
                     $sort[$i] = strtotime($part["date"]);
                     $i++;
                }
                array_multisort($sort, SORT_DESC, $FechaFin);
                for ($i=0; $i <count($FechaFin); $i++) { 
                  $FechaFin_[$i]=$FechaFin[$i]["date"];
                }
                unset($FechaFin);
                $FechaFin_=array_count_values($FechaFin_);

                $i=0;
                foreach ($FechaFin_ as $key => $value) {
                 $FechaFin[$i]=$key;
                 $i++;
                }


                for ($i=0; $i <count($FechaFin) ; $i++) { 
                  if ($i < count($FechaFin)-1) {
                      $BombasOperativas[$i]["Flujo"]=$FlujoEpa[$FechaFin[$i]]-$FlujoEpa[$FechaFin[$i+1]];
                    }
                }
                $BombasOperativas[count($FechaFin)-1]["Flujo"]=0;
                $valores = array_count_values($FechaInicio);
                $FechaInicio_=array_unique($FechaInicio);


                $k=0;
                for ($i=0; $i < count($FechaInicio); $i++) { 

                  if (array_key_exists($i, $FechaInicio_)) {

                    $Fecha_Inicio[$k]=$FechaInicio_[$i];
                    $Minutos_Operativa[$k]=$MinutosOperativa[$i];
                    $k++;
                  }
                }

                $k=0;
                for ($i=0; $i < count($valores); $i++) { 
                  
                  $Fila[$i]["FechaInicio"]      =$Fecha_Inicio[$i];
                  $Fila[$i]["MinutosOperativa"] =$Minutos_Operativa[$i];
                  $Fila[$i]["Bombas"]           =$valores[$FechaInicio[$i]];
                  // $Fila[$i]["Flujo"]      =$BombasOperativas[$i]["Flujo"];
                  
                  $Fila[$i]["NumeroDeBomba"][1] = 0;
                  $Fila[$i]["NumeroDeBomba"][2] = 0;

                  if ($Fila[$i]["Bombas"]==1) {

                    $Fila[$i]["NumeroDeBomba"][$Bomba[$i][32]]=1;

                  }  
                  if ($Fila[$i]["Bombas"]==2 || $Fila[$i]["Bombas"]==3){

                    $MasDeUnaBomba[$k]=$i;
                    $k++;

                  }

                }

             }

             // return $Fila;
             // die();

             if (isset($MasDeUnaBomba)) {
              for ($i=0; $i <count($MasDeUnaBomba) ; $i++) { 
                foreach ($BombasOperativas as $key => $val) {
                      if ($val['FechaInicio'] === $Fila[$MasDeUnaBomba[$i]]["FechaInicio"]) {
                            if ($val["Bomba"][32]==1) {
                               $Fila[$MasDeUnaBomba[$i]]["NumeroDeBomba"][1]=1;
                            }
                            if ($val["Bomba"][32]==2) {
                               $Fila[$MasDeUnaBomba[$i]]["NumeroDeBomba"][2]=1;
                            }
                     }
                 }
              }

              }


              if (isset($MasDeUnaBomba)) {

                $columns = array_column($Fila, 'FechaInicio');
                array_multisort($columns, SORT_DESC, $Fila);

              } else{
                // $Fila=null;
              }

              for ($i=0; $i < count($valores); $i++) { 
                $Fila[$i]["Flujo"]=$BombasOperativas[$i]["Flujo"];
              }
              unset($Fila[count($Fila)-1]);
              $ImprimirBombas=true;
          } else{
            $ImprimirBombas=false;
            $Fila=null;
          }

            return view("modals.Maitenal.BombasDefault", ["Bombas" => $Fila, "ImprimirBombas" => $ImprimirBombas]);
    }

    public function MaitenalGrafico(){
       $Flujo=DB::connection("telemetria")->select("SELECT mt_value, mt_time FROM log_biofil04 WHERE mt_name='Biofiltro04--Consumo.Flujo'
AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE (mt_name='Biofiltro04--Consumo.Flujo') AND mt_value<>0 ORDER BY mt_time DESC LIMIT 1), INTERVAL 3 HOUR)");

          $i=0;
            foreach ($Flujo as $key => $value) {
              foreach ($value as $key2 => $value2) {
                if ($key2=="mt_value") {
                  if ($i!=0) {
                    $DatoFlujo[$i]=$value2-$Flujo[$i-1]->mt_value;
                    $FechaFlujo[$i]=$Flujo[$i-1]->mt_time;
                    $i++;
                  }else{
                    $i++;
                  }
                }
              }
            }

            return view("modals.Maitenal.GraficoFlujo", ["mt_value" => $DatoFlujo, "mt_time" => $FechaFlujo]);
    }

    public function MaitenalParametros(){
      $Parametros= DB::connection("telemetria")
                                    ->select("SELECT * FROM (SELECT * FROM log_biofil04 ORDER BY mt_time DESC limit 50) T1
                                                                       WHERE  (mt_name='Biofiltro04--Consumo.TiempoRiego'
                                                                            OR mt_name='Biofiltro04--Consumo.TiempoReposo')
                                                                            GROUP BY mt_name");


      return view("modals.Maitenal.Parametros", ["Parametros" => $Parametros, "Rolito" => DB::table("instalaciones_asignadas")->select("rol")->where("id_usuario", Auth::user()->id)->where("id_instalacion", "2")->first()]);
    }


    public function MaitenalFlujoDiario(){
      $PrimerosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil04 
                                                WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                      AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE mt_name='Biofiltro04--Consumo.Flujo' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil04 
                                                  WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil04 WHERE mt_name='Biofiltro04--Consumo.Flujo' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras) ; $i++) { 
          $GraficoBarras[$i]["mt_time"]=$SegundosDatosBarras[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j')) {
            $GraficoBarras[$i]["mt_value"]=0;
          } else{
            $GraficoBarras[$i]["mt_value"]=$SegundosDatosBarras[$i]->mt_value-$PrimerosDatosBarras[$k]->mt_value;
            $k++;
          }
        }


     

        return view("modals.Maitenal.FlujoDiario", ["GraficoBarras" => $GraficoBarras]);


    }

      public function GraficarFlujoPersonalizadoMaitenal(Request $Request){


        $Request->merge(["FechaFin" => date("Y-m-d", strtotime($Request->FechaFin."+ 1 days"))]);
        

        $PrimerosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                             mt_name,
                                             MIN(mt_value) AS mt_value,
                                             MIN(mt_time) AS mt_time
                                              FROM log_biofil04 
                                                WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                      AND mt_time > '".$Request->FechaInicio."'
                                                      AND mt_time < '".$Request->FechaFin."'
                                                      AND mt_value<>0
                                                        GROUP BY DAY(mt_time) 
                                                          ORDER BY mt_time ASC");


        $SegundosDatosBarras = DB::connection("telemetria")
                                  ->select("SELECT
                                               mt_name,
                                               MAX(mt_value) AS mt_value,
                                               MAX(mt_time) AS mt_time
                                                FROM log_biofil04 
                                                  WHERE mt_name='Biofiltro04--Consumo.Flujo' 
                                                        AND mt_time > '".$Request->FechaInicio."'
                                                          AND mt_time < '".$Request->FechaFin."'
                                                          GROUP BY DAY(mt_time) 
                                                            ORDER BY mt_time ASC");
        $k=0;
        for ($i=0; $i <count($SegundosDatosBarras) ; $i++) { 
          $GraficoBarras[$i]["mt_time"]=$SegundosDatosBarras[$i]->mt_time;

          if (date_format(date_create($PrimerosDatosBarras[$k]->mt_time), 'm-j')!=date_format(date_create($SegundosDatosBarras[$i]->mt_time), 'm-j')) {
            $GraficoBarras[$i]["mt_value"]=0;
          } else{
            $GraficoBarras[$i]["mt_value"]=$SegundosDatosBarras[$i]->mt_value-$PrimerosDatosBarras[$k]->mt_value;
            $k++;
          }
        }
        return view("modals.Maitenal.FlujoDiario", ["GraficoBarras" => $GraficoBarras]);
    }



    public function DescargarExcelFlujoMaitenal(Request $Request)
    {
      return Excel::download(new UsersExport, "Datos.xlsx");
    }
}





class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function collection(){

      if ($_GET['tipo']=="MaitenalFlujoDiario") {
        return collect(self::RecopDatFlujoDiario());
      }



       
    }

    public function headings(): array
    {
      
        return self::RecopHeader();
    }









public function RecopHeader()
{

  if ($_GET['tipo']=="MaitenalFlujoDiario") {

        $hed =[
          "Dia",
          "Valor",
        ];
  }

  return $hed;
}




public function RecopDatFlujoDiario(){


            $mt_time    = explode(",", $_GET['mt_time']);
            $mt_value   = explode(",", $_GET['mt_value']);

            for ($i=0; $i <count($mt_value); $i++) { 
               $Datos[$i]["mt_time"]=$mt_time[$i];
               $Datos[$i]["mt_value"]=$mt_value[$i];
           }


           return $Datos;
}



}
