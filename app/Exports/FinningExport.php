<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Finning;

class FinningExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Finning = Finning::where('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba601')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba602')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba603')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba604')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba605')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba606')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba607')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.ErrorBomba608')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.InundacionSala1')
						->orWhere('mt_name', '=', 'Dinamometro--Consumo.InundacionSala2')

						->groupBy('mt_time', 'mt_name')
						->orderBy('mt_time', 'DESC')
						->groupBy('mt_name', 'mt_time')
						->limit("10")
						->get();

		$i=0;
		foreach ($Finning as $Dato) {
			if ($Dato->mt_name=='Dinamometro--Consumo.ErrorBomba602' && $Dato->mt_value==1) {
				$DatosFinning[$i]['->mt_value']='Error';
			}

			if ($Dato->mt_name=='Dinamometro--Consumo.ErrorBomba602' && $Dato->mt_value==0) {
				$DatosFinning[$i]->mt_value='Ok';
			}

			if ($Dato->mt_name!='Dinamometro--Consumo.ErrorBomba602' && $Dato->mt_value==1) {
				$DatosFinning[$i]->mt_value='Error';
			}
			if ($Dato->mt_name!='Dinamometro--Consumo.ErrorBomba602' && $Dato->mt_value==0) {
				$DatosFinning[$i]->mt_value='Ok';
			}


			$i++;
		}

		print_r($Finning);
		die();



						// 'Dinamometro--Consumo.ErrorBomba601' 0
						// 'Dinamometro--Consumo.ErrorBomba602' 1
						// 'Dinamometro--Consumo.ErrorBomba603' 0
						// 'Dinamometro--Consumo.ErrorBomba604' 0
						// 'Dinamometro--Consumo.ErrorBomba605' 0
						// 'Dinamometro--Consumo.ErrorBomba606' 0
						// 'Dinamometro--Consumo.ErrorBomba607' 0
						// 'Dinamometro--Consumo.ErrorBomba608' 0
						// 'Dinamometro--Consumo.InundacionSala1' 0
						// 'Dinamometro--Consumo.InundacionSala2' 0


						// 'PlantaAgua--Consumo.FallaBomba1001'			1
      //                   'PlantaAgua--Consumo.FallaBomba1002'			0
      //                   'PlantaAgua--Consumo.FallaBomba1011'			0
      //                   'PlantaAgua--Consumo.FallaBomba1012'			0
      //                   'PlantaAgua--Consumo.NivelBajoTK100'			0
      //                   'PlantaAgua--Consumo.NivelAltoAltoTK100'		0
      //                   'PlantaAgua--Consumo.NivelBajoTK101'			1
      //                   'PlantaAgua--Consumo.NivelAltoAltoTK101'		1
		}
}