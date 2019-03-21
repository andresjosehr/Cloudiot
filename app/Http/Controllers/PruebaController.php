<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Request;
use DB;
use Auth;

class PruebaController extends Controller{


    public function index(){

      $DatosDiarios = DB::connection("telemetria")
                      ->select("SELECT
                                  mt_name,
                                  SUM(mt_value) AS mt_value, COUNT(*) Registros,
                                  mt_time
                                   FROM log_biofil02 
                                     WHERE (mt_name='Biofiltro02--Consumo.Conductividad_Entrada' OR mt_name='Biofiltro02--Consumo.Conductividad_Salida')
                                           AND mt_time > DATE_SUB((SELECT mt_time FROM log_biofil02 WHERE mt_name='Biofiltro02--Consumo.Conductividad_Salida' ORDER BY mt_time DESC LIMIT 1), INTERVAL 7 DAY)
                                             GROUP BY mt_name, DAY(mt_time)
                                               ORDER BY mt_name, mt_time ASC");

        
          $k=0;
          $j=0;
          for ($i=0; $i <count($DatosDiarios) ; $i++) { 
            
            
            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Entrada") {
              $mt_value_entrada[$k]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros)/100, 0, "", "");
              $mt_time[$k]=date_format(date_create($DatosDiarios[$i]->mt_time), 'm-d');
              echo $Epa = $DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros;
              echo "<br>";
              echo $Epa= number_format($Epa, 0, "", "");
              echo "<br>";
              echo $Epa=$Epa/100;
              echo "<br>";
              echo "<br>";
              $k++;
            }

            if ($DatosDiarios[$i]->mt_name=="Biofiltro02--Consumo.Conductividad_Salida") {
              $mt_value_salida[$j]=number_format(($DatosDiarios[$i]->mt_value/$DatosDiarios[$i]->Registros)/100, 0, "", "");
              $j++;
            }

          }   

  }
}

class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

       $mt_time = explode(",", $_GET["mt_time"]);
       $mt_value = explode(",", $_GET["mt_value"]);


       for ($i=0; $i <count($mt_time) ; $i++) { 
         for ($k=0; $k < 2 ; $k++) { 
           $Datos[$i]["mt_time"]=$mt_time[$i];
           $Datos[$i]["mt_value"]=$mt_value[$i];
         }
       }

       return collect($Datos);



        // return collect([
        //     [
        //         'name' => $_GET["Valriable"],
        //         'surname' => 'Korop',
        //         'email' => 'povilas@laraveldaily.com',
        //         'twitter' => '@povilaskorop'
        //     ],
        //     [
        //         'name' => 'Taylor',
        //         'surname' => 'Otwell',
        //         'email' => 'taylor@laravel.com',
        //         'twitter' => '@taylorotwell'
        //     ]
        // ]);
    }

    public function headings(): array
    {
        return [
            'mt_value',
            'mt_time',
        ];
    }

}