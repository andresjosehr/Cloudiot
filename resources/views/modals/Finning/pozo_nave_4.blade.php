<h1 align='center' id='h1_3b6e_0'>Pozo Nave 4</h1>
<div id='div_3b6e_4'>
  <div align='center' style='margin: 0 auto; display: flex'>
    @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt=''> 
    @endif
    @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt=''> 
    @endif
    @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==1)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt=''> 
    @endif

    @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt=''> 
    @endif
    @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt=''> 
    @endif
    @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==1)
      <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt=''> 
    @endif

   </div>
</div>
<div id='div_3b6e_5'></div>
<div class='body table-responsive' align='center' style='margin-top:25px; max-height: 200px;overflow: auto;'>
    <table class='table sicut-table-bordered sicut-modal-table1 pozo_nave_table'>
      <thead></thead>
      <caption scope='row' class='sicut-tabla-titulo'>Pozo nave 4 <i class='fa fa-volume-up' onclick='$window.sound.play();$(this).pause()' style='cursor: pointer;display:none;color: red;margin-left: 20px;'></i></caption>
      <thead>
                              <th class='sicut-th'>Hrs</th>
                              <th class='sicut-th'>Bajo<br>E1</th>
                              <th class='sicut-th'>Alto<br>E1</th>
                              <th class='sicut-th'>Bajo<br>E2</th>
                              <th class='sicut-th'>Alto<br>E2</th>
      </thead>
      <tbody>
         @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class='sicut-th'>{{date_format(date_create($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_time), 'H:i') }}</th>

                                    <th class='sicut-th'>
                                      @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                        @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>


                                    <th class='sicut-th'>
                                       @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                      
                                    </th>

                                    <th class='sicut-th'>
                                       @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                      
                                    </th>
                              </tr>
                              @endfor
      </tbody>
  </table>
</div>