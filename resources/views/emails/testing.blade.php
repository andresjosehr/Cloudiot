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
				<th style="min-width: 200px" align="left">Finning:</th>
				<th style="min-width: 200px" @if ($Datos["Finning"]=="Con error") style="color: red" @else style="color: green" @endif>{{$Datos["Finning"]}}</th>
				<th style="min-width: 200px">{{$Datos["FinningUltimaFecha"][0]->mt_time}}</th>
			</tr>

		</tbody>
	</table>









</body>
</html>