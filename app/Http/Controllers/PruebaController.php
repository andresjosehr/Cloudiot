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

 

   return Excel::download(new UsersExport, 'FlujosDiarios.xlsx');


}



    public function ExportarPersonas(){

      $Personas[0]["Nombre"]    ="Jose Andres";
      $Personas[0]["Genero"]    = "Masculino";
      $Personas[0]["Edad"]      = "23";
      $Personas[0]["Ocupacion"] = "Programador";
      
      $Personas[1]["Nombre"]    = "Omar Jose";
      $Personas[1]["Genero"]    = "Mujer";
      $Personas[1]["Edad"]      = "17";
      $Personas[1]["Ocupacion"] = "Sin oficio";

      $VariableBonita = json_decode(json_encode($Personas));

      return $VariableBonita;

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