@php
	if (count($Datos["PlantaAgua15"])<count($Datos["Dinamometro15"])) $Mayor=count($Datos["Dinamometro15"])-1; else $Mayor=count($Datos["PlantaAgua15"])-1;
@endphp
<table border="1">
  <tr align="center">
    <td>Fecha Hora</td>
    <td>Nivel Bajo</td>
    <td>Nivel Alto pozo</td>
    <td>Nivel Alto</td>
    <td>Nivel Alto TK</td>

    <td>Bom 1</td>
    <td>Bom 2</td>
    <td>Bom 3</td>
    <td>Bom 4</td>
    <td>Nivel Alto TK-100</td>
    <td>Nivel Alto TK-101</td>
    <td>Nivel Bajo TK-100</td>
    <td>Nivel Bajo TK-101</td>
    
    <td>Bomba 601</td>
    <td>Bomba 602</td>
    <td>Bomba 603</td>
    <td>Bomba 604</td>
    <td>Bomba 605</td>
    <td>Bomba 606</td>
    <td>Bomba 607</td>
    <td>Bomba 608</td>
    <td>Inunundacion Sala 1</td>
    <td>Inunundacion Sala 2</td>
  </tr>
  <tbody>

    @php $j=0; $h=0; @endphp
    @for ($i = 0; $i < $Mayor; $i++)
        <tr>
          
          @if (!isset($Datos["Dinamometro15"][$i+$h+9])) @php break; @endphp @endif

          <td>{{$Datos["Dinamometro15"][$i+$h]->mt_time}}</td>
          <td>Ok</td>
          <td>Ok</td>
          <td>Ok</td>
          <td>Ok</td>

          @if (isset($Datos["PlantaAgua15"][$i+$j+7]))
            <td>@if ($Datos["PlantaAgua15"][$i+$j]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+1]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+2]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+3]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+4]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+5]->mt_value==0) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+6]->mt_value==1) Ok @else Error @endif</td>
            <td>@if ($Datos["PlantaAgua15"][$i+$j+7]->mt_value==1) Ok @else Error @endif</td>
            @php $j=$j+7; @endphp
          @endif




          @if (isset($Datos["Dinamometro15"][$i+$h+9]))
            <td>@if ($Datos["Dinamometro15"][$i+$h]->mt_name==0) Ok @else Error @endif  </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+1]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+2]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+3]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+4]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+5]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+6]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+7]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+8]->mt_name==0) Ok @else Error @endif </td>
            <td>@if ($Datos["Dinamometro15"][$i+$h+9]->mt_name==0) Ok @else Error @endif </td>
            @php $h=$h+9; @endphp
          @else
          @endif

        </tr>
    @endfor
  </tbody>
</table>