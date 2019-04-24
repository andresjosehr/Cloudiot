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
                  // echo "$key2";
                  // echo "<br>";
                  // echo "$value2";
                  // echo "<br>";
                  // echo "<br>";
              }
            }


             return $FechaFlujo;
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