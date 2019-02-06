<?php

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExcelController extends Controller
{

    public function ExcelFlujosDiarios(Request $Request){

  	   return Excel::download(new UsersExport, 'FlujosDiarios.xlsx');

  	   ?><script>window.close();</script><?php

	}

	public function DatosRecopilados(){
		return $this->Datos;
	}

}


class UsersExport implements FromCollection, WithHeadings
{
    use Exportable;


    public function collection()
    {

    	$mt_time = explode(",", $_GET["mt_time"]); 
    	$mt_value = explode(",", $_GET["mt_value"]);

    	for ($i=0; $i <count($mt_time); $i++) { 
         for ($k=0; $k < 2 ; $k++) { 
           $Datos[$i]["mt_time"]=$mt_time[$i];
           $Datos[$i]["mt_value"]=$mt_value[$i];
         }
       }


       return collect($Datos);



       
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Flujo',
        ];
    }

}