<?php

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExcelController extends Controller
{

    public function ExcelFlujosDiarios(Request $Request){

  	   return Excel::download(new UsersExport, 'Datos.xlsx');

  	   ?><script>window.close();</script><?php

	}

	public function DatosRecopilados(){
		return $this->Datos;
	}

}


class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;


    public function collection()
    {

    	$mt_time = explode(",", $_GET["mt_time"]); 
    	$mt_value = explode(",", $_GET["mt_value"]);
      if (isset($_GET["mt_value_salida"])) {
        $mt_value_salida = explode(",", $_GET["mt_value_salida"]);
      } 

    	for ($i=0; $i <count($mt_time); $i++) { 
         for ($k=0; $k < 2 ; $k++) { 
           $Datos[$i]["mt_time"]=$mt_time[$i];
           $Datos[$i]["mt_value"]=$mt_value[$i];
           if (isset($_GET["mt_value_salida"])) {
             $Datos[$i]["mt_value_salida"]=$mt_value_salida[$i];
           }
         }
       }


       return collect($Datos);



       
    }

    public function headings(): array
    {
        return [
            'Fecha',
            $_GET['n1'],
            $_GET["n2"]
        ];
    }

}