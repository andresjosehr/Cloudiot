<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<h2>Informa de instalaciones en CloudIot:</h2>


	<table>
		<tbody>
			<tr>
				<th style="min-width: 200px" align="left">Instalacion</th>
				<th style="min-width: 200px">Estado</th>
				<th style="min-width: 200px">Ultimo dato recibido</th>
			</tr>	

			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>

			<tr>
				<th style="min-width: 200px" align="left">Sicut Ignis (Aasa):</th>
				<th style="min-width: 200px" @if ($Datos["SicutIgnis"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["SicutIgnis"]}}</th>
				<th style="min-width: 200px">{{$Datos["SicutIgnisUltimaFecha"][0]->mt_time}}</th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">Viña Luis Felipe:</th>
				<th style="min-width: 200px" @if ($Datos["VinaLuisFelipe"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["VinaLuisFelipe"]}}</th>
				<th style="min-width: 200px">{{$Datos["VinaLuisFelipeUltimaFecha"][0]->mt_time}}</th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">San Javier:</th>
				<th style="min-width: 200px" @if ($Datos["SanJavier"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["SanJavier"]}}</th>
				<th style="min-width: 200px">{{$Datos["SanJavierUltimaFecha"][0]->mt_time}}</th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">El Maitenal:</th>
				<th style="min-width: 200px" @if ($Datos["Maitenal"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["Maitenal"]}}</th>
				<th style="min-width: 200px">{{$Datos["MaitenalUltimaFecha"][0]->mt_time}}</th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">PozoNave4:</th>
				<th style="min-width: 200px" @if ($Datos["PozoNave4"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["PozoNave4"]}}</th>
				<th style="min-width: 200px"></th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">PlantaAgua:</th>
				<th style="min-width: 200px" @if ($Datos["PlantaAgua"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["PlantaAgua"]}}</th>
				<th style="min-width: 200px">{{$Datos["PlantaAguaUltimaFecha"][0]->mt_time}}</th>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
				<th style="min-width: 200px" align="left">Dinamometro:</th>
				<th style="min-width: 200px" @if ($Datos["Dinamometro"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["Dinamometro"]}}</th>
				<th style="min-width: 200px">{{$Datos["DinamometroUltimaFecha"][0]->mt_time}}</th>
			</tr>


			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>


			<tr>
				<th style="min-width: 200px" align="left">OBRA OB-0501-24:</th>
				<th style="min-width: 200px">Sin Error</th>
				<th style="min-width: 200px">{{$Datos["OBRA_OB-0501-24UltimaFecha"][0]->mt_time}}</th>
			</tr>

			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>

			<tr>
				<th style="min-width: 200px" align="left">OBRA OB-0501-23:</th>
				<th style="min-width: 200px">Sin Error</th>
				<th style="min-width: 200px">{{$Datos["OBRA_OB-0501-23UltimaFecha"][0]->mt_time}}</th>
			</tr>

		</tbody>
	</table>









</body>
</html>