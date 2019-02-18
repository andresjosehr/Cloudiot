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


      $Info= DB::connection("telemetria")
                                  ->select("(SELECT mt_name, mt_value, MAX(mt_time) AS mt_time FROM mt_aasa 
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
                                  

                                    

                                     echo $Datos["EnergiaActivaInyectada"]   =   $Info[0]->mt_value-$Info[1]->mt_value;
                                     echo "-----------------------".$Info[0]->mt_name."-----------------------".$Info[1]->mt_name;
                                     echo "<br>";


                                     echo $Datos["EnergiaActivaRetirada"]    =   $Info[2]->mt_value-$Info[3]->mt_value;
                                     echo "-----------------------".$Info[2]->mt_name."-----------------------".$Info[3]->mt_name;
                                     echo "<br>";



                                     echo $Datos["EnergíaReactivaInyectada"] =   $Info[4]->mt_value-$Info[5]->mt_value;
                                     echo "-----------------------".$Info[4]->mt_name."-----------------------".$Info[5]->mt_name;
                                     echo "<br>";


                                     echo $Datos["EnergíaReactivaRetirada"]  =   $Info[6]->mt_value-$Info[7]->mt_value;
                                     echo "-----------------------".$Info[6]->mt_name."-----------------------".$Info[7]->mt_name;
                                     echo "<br>";



                                     echo $Datos["FactorPotenciaA"]          =   $Info[8]->mt_value-$Info[9]->mt_value;
                                     echo "-----------------------".$Info[8]->mt_name."-----------------------".$Info[9]->mt_name;
                                     echo "<br>";


                                     echo $Datos["FactorPotenciaB"]          =   $Info[10]->mt_value-$Info[11]->mt_value;
                                     echo "-----------------------".$Info[10]->mt_name."-----------------------".$Info[11]->mt_name;
                                     echo "<br>";


                                     echo $Datos["FactorPotenciaC"]          =   $Info[12]->mt_value-$Info[13]->mt_value;
                                     echo "-----------------------".$Info[12]->mt_name."-----------------------".$Info[13]->mt_name;
                                     echo "<br>";


                                     echo $Datos["FactorPotenciaTotal"]      =   $Info[14]->mt_value-$Info[15]->mt_value;
                                     echo "-----------------------".$Info[14]->mt_name."-----------------------".$Info[15]->mt_name;
                                     echo "<br>";



                                     echo $Datos["VoltajeA"]                 =   $Info[16]->mt_value-$Info[17]->mt_value;
                                     echo "-----------------------".$Info[16]->mt_name."-----------------------".$Info[17]->mt_name;
                                     echo "<br>";


                                     echo $Datos["VoltajeB"]                 =   $Info[18]->mt_value-$Info[19]->mt_value;
                                     echo "-----------------------".$Info[18]->mt_name."-----------------------".$Info[19]->mt_name;
                                     echo "<br>";


                                     echo $Datos["VoltajeC"]                 =   $Info[20]->mt_value-$Info[21]->mt_value;
                                     echo "-----------------------".$Info[20]->mt_name."-----------------------".$Info[21]->mt_name;
                                     echo "<br>";




                                     echo $Datos["VoltajeDeLineaAB"]         =   $Info[23]->mt_value;
                                     echo "-----------------------".$Info[23]->mt_name."-----------------------".$Info[23]->mt_name;
                                     echo "<br>";


                                     echo $Datos["VoltajeDeLineaBC"]         =   $Info[25]->mt_value;
                                     echo "-----------------------".$Info[25]->mt_name."-----------------------".$Info[25]->mt_name;
                                     echo "<br>";


                                     echo $Datos["VoltajeDeLineaCA"]         =   $Info[27]->mt_value;
                                     echo "-----------------------".$Info[27]->mt_name."-----------------------".$Info[27]->mt_name;
                                     echo "<br>";


                                     echo $Datos["VoltajeDeLineaPromedio"]   =   $Info[29]->mt_value;
                                     echo "-----------------------".$Info[29]->mt_name."-----------------------".$Info[29]->mt_name;
                                     echo "<br>";


                                    
                                     echo $Datos["VoltajePromedio"]          =   $Info[30]->mt_value-$Info[31]->mt_value;
                                     echo "-----------------------".$Info[30]->mt_name."-----------------------".$Info[31]->mt_name;
                                     echo "<br>";



                                     echo $Datos["UltimaMedicion"]           =    $Info[31]->mt_time;
                                     echo "-----------------------".$Info[31]->mt_name."-----------------------".$Info[31]->mt_name;
                                     echo "<br>";



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