<div class='row'>
                     <h1 align='center' id='h1_3b6e_1'>Planta Agua</h1>
                     <div class='col-md-1'></div>
                     <div class='col-md-10' align='center'>
                      <div class='row'>
                        <div class='col-md-6'>
                        @if ($Datos['Reloj1'][0]->mt_value==25) <img style='width: 95px' id='img_3b6e_3' src='{{ asset('images/tanque_ancho0.png') }}' alt=''> @endif
                        @if ($Datos['Reloj1'][0]->mt_value==50) <img style='width: 95px' id='img_3b6e_4' src='{{ asset('images/tanque_ancho1.png') }}' alt=''> @endif
                        @if ($Datos['Reloj1'][0]->mt_value==75) <img style='width: 95px' id='img_3b6e_5' src='{{ asset('images/tanque_ancho11png') }}' alt=''> @endif
                        <div class='row' id='div_3b6e_6'>
                           <div class='col-md-6' align='center'>
                              <img src='{{Request::root()}}/images/bomba2.png' width='20%' alt='' @if ($Datos['PlantaAgua'][0]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif>
                           </div>
                           <div class='col-md-6' align='center'>
                              <img src='{{Request::root()}}/images/bomba2.png' width='20%' alt='' @if ($Datos['PlantaAgua'][1]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif>
                           </div>
                        </div>

                        </div>
                        <div class='col-md-6'>
                          @if ($Datos['Reloj2'][0]->mt_value==25) <img style='width: 95px' id='img_3b6e_6' src='{{ asset('images/tanque_ancho0.png') }}' alt=''> @endif
                          @if ($Datos['Reloj2'][0]->mt_value==50) <img style='width: 95px' id='img_3b6e_7' src='{{ asset('images/tanque_ancho1.png') }}' alt=''> @endif
                          @if ($Datos['Reloj2'][0]->mt_value==75) <img style='width: 95px' id='img_3b6e_8' src='{{ asset('images/tanque_ancho11png') }}' alt=''> @endif
                        <div class='row' id='div_3b6e_7'>
                           <div class='col-md-6' align='center'>
                              <img src='{{Request::root()}}/images/bomba2.png' width='20%' alt='' @if ($Datos['PlantaAgua'][2]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif>
                           </div>
                           <div class='col-md-6' align='center'>
                              <img src='{{Request::root()}}/images/bomba2.png' width='20%' alt='' @if ($Datos['PlantaAgua'][3]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif>
                           </div>
                        </div>

                        </div>
                      </div>
                      <div class='body table-responsive' align='center' style='margin-top:25px; max-height: 200px'>
                          <table class='table sicut-table-bordered sicut-modal-table1 pozo_nave_table'>
                            <thead>
                              <th class='sicut-th'>Hrs</th>
                              <th class='sicut-th'>Tq. 1</th>
                              <th class='sicut-th'>Tq. 2</th>
                              <th class='sicut-th'>B. 1001</th>
                              <th class='sicut-th'>B. 1002</th>
                              <th class='sicut-th'>B. 1011</th>
                              <th class='sicut-th'>B. 1011</th>
                            </thead>
                            <caption scope='row' class='sicut-tabla-titulo'>Planta Agua <i class='fa fa-volume-up' style='cursor: pointer;display:none;color: red;margin-left: 20px;'></i></caption>
                            <tbody style='overflow: auto;'>
                              @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class='sicut-th'>{{date_format(date_create($Datos['PlantaAguaTabla']['BajoTK100'][$i]->mt_time), 'H:i') }}</th>
                                    <th class='sicut-th'>
                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK100'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK100'][$i]->mt_value)==0 )
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @endif

                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK100'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK100'][$i]->mt_value)==1 )
                                        <i class='material-icons'  style='color: orange;font-size: 15px;'>warning</i>
                                      @endif

                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK100'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK100'][$i]->mt_value)==2 )
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif

                                    </th>
                                    <th class='sicut-th'>
                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK101'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK101'][$i]->mt_value)==0 )
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @endif

                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK101'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK101'][$i]->mt_value)==1 )
                                        <i class='material-icons'  style='color: orange;font-size: 15px;'>warning</i>
                                      @endif

                                      @if ( ($Datos['PlantaAguaTabla']['BajoTK101'][$i]->mt_value)+($Datos['PlantaAguaTabla']['AltoTK101'][$i]->mt_value)==2 )
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif

                                    </th>


                                    <th class='sicut-th'>
                                      @if ($Datos['PlantaAguaTabla']['Bomba1001'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['PlantaAguaTabla']['Bomba1002'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['PlantaAguaTabla']['Bomba1011'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['PlantaAguaTabla']['Bomba1012'][$i]->mt_value==0)
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
                     </div>
                     <div class='col-md-1'></div>
                  </div>

