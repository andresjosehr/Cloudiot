
                  <h1 align='center' id='h1_3b6e_2'>Dinamometro</h1>
                  <div class='row'>
                     <div class='col-md-2 bombas_dinamometro' style='padding-left: 0px !important;padding-right: 0px !important' align='center'>
                        <p id='p_3b6e_0'>Bom 601</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][0]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                        <p id='p_3b6e_1'>Bom 602</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][1]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                     </div>
                     <div class='col-md-2 bombas_dinamometro' style='padding-left: 0px !important;padding-right: 0px !important' align='center'>
                        <p id='p_3b6e_2'>Bom 603</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][2]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                        <p id='p_3b6e_3'>Bom 604</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][3]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                     </div>
                     <div class='col-md-2 bombas_dinamometro' style='padding-left: 0px !important;padding-right: 0px !important' align='center'>
                        <p id='p_3b6e_4'>Bom 605</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][4]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                        <p id='p_3b6e_5'>Bom 606</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][5]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                     </div>
                     <div class='col-md-2 bombas_dinamometro' style='padding-left: 0px !important;padding-right: 0px !important' align='center'>
                        <p id='p_3b6e_6'>Bom 607</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][6]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                        <p id='p_3b6e_7'>Bom 608</p>
                        <img src='{{Request::root()}}/images/bomba2.png' width='35%' alt='' @if ($Datos['Dinamometro'][7]->mt_value==0) style='filter: hue-rotate(128deg)' @else style='filter: hue-rotate(327deg)' @endif><br><br>
                     </div>
                     <div class='col-md-4' align='center'>
                        <ul id='ul_3b6e_0'>
                           @if ($Datos['Dinamometro'][8]->mt_value==0) <img style='width: 65px' id='img_3b6e_9' src='{{ asset('images/tanque_dina0.png') }}' alt=''> @else <img style='width: 65px' id='img_3b6e_10' src='{{ asset('images/tanque_dina1.png') }}' alt=''> @endif
                           @if ($Datos['Dinamometro'][9]->mt_value==0) <img style='width: 65px' id='img_3b6e_11' src='{{ asset('images/tanque_dina0.png') }}' alt=''> @else <img style='width: 65px' id='img_3b6e_12' src='{{ asset('images/tanque_dina1.png') }}' alt=''> @endif
                        </ul>
                     </div>
                  </div>
                  <div class='body table-responsive' align='center' style='max-height: 200px'>
                          <table class='table sicut-table-bordered sicut-modal-table1 pozo_nave_table'>
                            <thead>
                              <th class='sicut-th'>Hrs</th>
                              <th class='sicut-th'>B.601</th>
                              <th class='sicut-th'>B.602</th>
                              <th class='sicut-th'>B.603</th>
                              <th class='sicut-th'>B.604</th>
                              <th class='sicut-th'>B.605</th>
                              <th class='sicut-th'>B.606</th>
                              <th class='sicut-th'>B.607</th>
                              <th class='sicut-th'>B.608</th>
                              <th class='sicut-th'>Sl 1</th>
                              <th class='sicut-th'>Sl 2</th>
                            </thead>
                            <caption scope='row' class='sicut-tabla-titulo'>Dinamometro <i class='fa fa-volume-up' style='cursor: pointer;display:none;color: red;margin-left: 20px;'></i></caption>
                            <tbody style='overflow: auto;'>
                              @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class='sicut-th'>{{date_format(date_create($Datos['DinamometroTabla']['ErrorBomba601'][$i]->mt_time), 'H:i') }}</th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba601'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba602'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba603'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba604'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba605'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba606'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba607'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['ErrorBomba608'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>

                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['InundacionSala1'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                      @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                      @if ($Datos['DinamometroTabla']['InundacionSala2'][$i]->mt_value==0)
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

                      