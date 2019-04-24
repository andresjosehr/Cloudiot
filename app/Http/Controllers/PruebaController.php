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

          return $Parametros= DB::connection("telemetria")
                                    ->select("SELECT * FROM (SELECT * FROM log_biofil04 ORDER BY mt_time DESC limit 50) T1
                                                                       WHERE  (mt_name='Biofiltro04--Consumo.TiempoRiego'
                                                                            OR mt_name='Biofiltro04--Consumo.TiempoReposo')
                                                                            GROUP BY mt_name");
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