<table border="1">
{{-- 	<tr>
		<td>reg. kWh Fecha</td>
		<td>reg. kWh Inyectada</td>
		<td>reg. kWh Retirada</td>
		<td></td>
		<td>reg. kVAR Fecha</td>
		<td>reg. kVAR Inyectada</td>
		<td>reg. kVAR Retirada</td>
		<td></td>
		<td>Potencia (kW) Fecha</td>
		<td>Potencia Inyectada</td>
		<td>Potencia Retirada</td>
		<td></td>
		<td>Voltaje Lineas Fecha</td>
		<td>Voltaje a</td>
		<td>Voltaje b</td>
		<td>Voltaje c</td>
		<td>Voltaje promedio</td>
		<td></td>
		<td>Voltaje de Fases</td>
		<td>Voltaje AB</td>
		<td>Voltaje BC</td>
		<td>Voltaje CD</td>
		<td>Voltaje Promedio</td>
		<td></td>
		<td>Factor de potencia Fecha</td>
		<td>FP Inyectada</td>
	</tr> --}}
	@foreach ($Datos as $key => $Grafico)
			@foreach ($Grafico as $key2 => $Elemento)
				<tr>
						<td>{{$key2}}</td>
						@foreach ($Elemento	 as $value)
							<td>{{$value}}</td>
						@endforeach
				</tr>
			@endforeach
			<tr>
					<td>	</td>
				</tr>

	@endforeach
</table>


