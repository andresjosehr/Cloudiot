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
                                    ->select("SELECT * FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny'
                                                                        OR mt_name='AASA--ION8650.EnerActRet'
                                                                        OR mt_name='AASA--ION8650.EnerReactIny'
                                                                        OR mt_name='AASA--ION8650.EnerReactRet'
                                                                        OR mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineaab'
                                                                        OR mt_name='AASA--ION8650.VoltajeLineabc'
                                                                        OR mt_name='AASA--ION8650.VotajeLineaca'
                                                                        OR mt_name='AASA--ION8650.Voltajea'
                                                                        OR mt_name='AASA--ION8650.Voltajeb'
                                                                        OR mt_name='AASA--ION8650.Voltajec'
                                                                        OR mt_name='AASA--ION8650.VoltajePromedio'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciaa'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciab'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciac'
                                                                        OR mt_name='AASA--ION8650.FactorPotenciaTotal')
                                                                        AND mt_time > DATE_SUB((SELECT mt_time FROM mt_aasa WHERE (mt_name='AASA--ION8650.EnerActIny') ORDER BY mt_time DESC LIMIT 1), INTERVAL 24 HOUR)
                                                                        ORDER BY mt_name, mt_time DESC ");

        var_dump($datos);

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