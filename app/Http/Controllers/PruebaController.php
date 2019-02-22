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


$Info= DB::connection("telemetria")
                                  ->select("(SELECT mt_name, mt_value, MAX(mt_time) AS mt_time FROM log_aasa 
                                                                     WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                         OR mt_name='AASA--ION8650.EnerActRet'
                                                                         OR mt_name='AASA--ION8650.EnerReactIny'
                                                                         OR mt_name='AASA--ION8650.EnerReactRet'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaab'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaca'
                                                                         OR mt_name='AASA--ION8650.VoltajeLineaPromedio'
                                                                         OR mt_name='AASA--ION8650.Voltajea'
                                                                         OR mt_name='AASA--ION8650.Voltajeb'
                                                                         OR mt_name='AASA--ION8650.Voltajec'
                                                                         OR mt_name='AASA--ION8650.VoltajePromedio'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaa'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                         OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                         GROUP BY mt_time, mt_name ORDER BY mt_time DESC LIMIT 32) ORDER BY mt_name, mt_time");
                                  return $Info;

                                    

                                     // $Datos["EnergiaActivaInyectada"]   =   $Info[1]->mt_value-$Info[0]->mt_value;
                                     // $Datos["EnergiaActivaRetirada"]    =   $Info[3]->mt_value-$Info[2]->mt_value;

                                     // $Datos["EnergíaReactivaInyectada"] =   $Info[5]->mt_value-$Info[4]->mt_value;
                                     // $Datos["EnergíaReactivaRetirada"]  =   $Info[7]->mt_value-$Info[6]->mt_value;

                                     // $Datos["FactorPotenciaA"]          =   number_format($Info[9]->mt_value/10000, 2, ",", "");
                                     // $Datos["FactorPotenciaB"]          =   number_format($Info[11]->mt_value/10000, 2, ",", "");
                                     // $Datos["FactorPotenciaC"]          =   number_format($Info[13]->mt_value/10000, 2, ",", "");
                                     // $Datos["FactorPotenciaTotal"]      =   number_format($Info[15]->mt_value/10000, 2, ",", "");

                                     // $Datos["VoltajeA"]                 =   $Info[17]->mt_value;
                                     // $Datos["VoltajeB"]                 =   $Info[19]->mt_value;
                                     // $Datos["VoltajeC"]                 =   $Info[21]->mt_value;


                                     // $Datos["VoltajeDeLineaAB"]         =   $Info[23]->mt_value;
                                     // $Datos["VoltajeDeLineaBC"]         =   $Info[25]->mt_value;
                                     // $Datos["VoltajeDeLineaCA"]         =   $Info[27]->mt_value;
                                     // $Datos["VoltajeDeLineaPromedio"]   =   $Info[29]->mt_value;
                                    
                                     // $Datos["VoltajePromedio"]          =   $Info[31]->mt_value;

                                     // $Datos["UltimaMedicion"]           =   $Info[31]->mt_time;
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