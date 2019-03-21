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

      $datos = DB::connection('telemetria')
                                    ->select("SELECT * FROM log_aasa  
                                                WHERE (mt_name='AASA--ION8650.EnerActIny' 
                                                OR mt_name='AASA--ION8650.EnerActRet' 
                                                OR mt_name='AASA--ION8650.EnerReactIny' 
                                                OR mt_name='AASA--ION8650.EnerReactRet')
                                                AND mt_time > DATE_SUB((SELECT mt_time FROM log_aasa WHERE (mt_name='AASA--ION8650.EnerActRet') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR) 
                                                ORDER BY mt_name, mt_time DESC;");


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