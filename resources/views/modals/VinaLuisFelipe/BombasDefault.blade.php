<div class="col-md-6 vina-listar-bombas" id="ListarBombas">
            <h4 align="left" class="vina-title-table">Flujos</h4>
            <div class="body table-responsive">
                <table class="table vina-table table-striped">
                    <thead>
                        <tr>
                            <th class="vina-th1">Fecha
            </div>
            </th>
            <th class="vina-th1">Min&nbsp;Op.</th>
            <th class="vina-th1">m3</th>
            <th class="vina-th1">Bombas</th>
            </tr>
            </thead>
            @if ($ImprimirBombas==true)
            <tbody align="center">
                @php $i=0; @endphp @foreach ($Bombas as $Bomba)
                <tr>
                    <td>
                        <?php echo date_format(date_create($Bomba["FechaInicio"]), 'm-d H:i'); ?>
                    </td>
                    <td>{{ $Bomba["MinutosOperativa"] }}</td>
                    <td>{{ $Bomba["Flujo"] }}</td>
                    <td>
                        @if ($Bomba["NumeroDeBomba"][1]==1)
                        <i class="material-icons vina-btn-bomba">add_circle</i> @endif @if ($Bomba["NumeroDeBomba"][1]==0)
                        <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i> @endif @if ($Bomba["NumeroDeBomba"][2]==1)
                        <i class="material-icons vina-btn-bomba">add_circle</i> @endif @if ($Bomba["NumeroDeBomba"][2]==0)
                        <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i> @endif @if ($Bomba["NumeroDeBomba"][3]==1)
                        <i class="material-icons vina-btn-bomba">add_circle</i> @endif @if ($Bomba["NumeroDeBomba"][3]==0)
                        <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i> @endif
                    </td>
                </tr>
                @php $i++; @endphp @endforeach
            </tbody>
            @endif
            </table>
            @if ($ImprimirBombas==false)
            <div>
                <p>Sin datos de Bombas activas en las ultimas 3 horas</p>
                <p>Haga click para obetener datos en una fecha de mayor rango</p>
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <h4 align="left" class="vina-alarmas-title">Alarmas</h4>
        <div class="body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha / Hora</th>
                        <th>Obs</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i
                    < 10 ; $i++) <tr>
                        <td></td>
                        <td></td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>

