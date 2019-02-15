<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Request;
use DB;

class PruebaController extends Controller{


    public function index(){


       $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VotajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.VoltajeLineaab') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time ASC");
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
                  if ($datos[$i]->mt_name=="AASA--ION8650.VotajeLineaca") {
                    $VoltajeLineaca_mt_value[$h]=$datos[$i]->mt_value;
                    $VoltajeLineaca_mt_time[$h]=$datos[$i]->mt_time;
                    $h++;
                  }
                  if ($datos[$i]->mt_name=="AASA--ION8650.VoltajeLineaPromedio") {
                    $VoltajeLineaPromedio_mt_value[$g]=$datos[$i]->mt_value;
                    $VoltajeLineaPromedio_mt_time[$g]=$datos[$i]->mt_time;
                    $g++;
                  }
                }

                for ($i=0; $i < count($VoltajeLineaab_mt_value) ; $i++) { 
                    echo $VoltajeLineaab_mt_time[$i];
                    echo "<br>";
                    echo $VoltajeLineaab_mt_value[$i]."---------------------------------AASA--ION8650.VoltajeLineaab";
                    echo "<br>";
                    echo $VoltajeLineabc_mt_value[$i]."---------------------------------AASA--ION8650.VoltajeLineabc";
                    echo "<br>";
                    echo $VoltajeLineaPromedio_mt_value[$i]."---------------------------------AASA--ION8650.VoltajeLineaPromedio";
                    echo "<br>";
                    echo "<br>";

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