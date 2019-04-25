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

      $Horas=24;
        $Condition = "AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.FactorPotenciaTotal') ORDER BY mt_time DESC LIMIT 1), INTERVAL $Horas HOUR)";

          $PotenciaTotal = DB::connection('telemetria')
                                    ->select("SELECT mt_time, mt_value FROM log_aasa  
                                                WHERE (mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                $Condition
                                                ORDER BY mt_name, mt_time ASC;");

          $i=0;
            foreach ($PotenciaTotal as $key => $value) {
              foreach ($value as $key2 => $value2) {
                if ($key2=="mt_value") {
                  if ($i!=0 && $i!=count($PotenciaTotal)-1) {
                    $DatoPotenciaTotal[$i]=$value2-$PotenciaTotal[$i+1]->mt_value;
                    $FechaPotenciaTotal[$i]=$PotenciaTotal[$i-1]->mt_time;
                    $i++;
                  }else{
                    $i++;
                  }
                }
              }
            }
            return $DatoPotenciaTotal;
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