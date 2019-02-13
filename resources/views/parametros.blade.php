
    @include('header');

    @include('loader.index');

    @include('top_menu');

    @include('sidebar');

    <style>
      .noUi-base{
        margin-top: 6px;
      }

      .loading{
       width: 35px;
       height: 35px;
       border-radius:150px;
       border:6px solid #797979;
       border-top-color:rgba(0,0,0,0.3);
       box-sizing:border-box;
       position:absolute;
       top: 72px;
       left: 64%;
       margin-top:-80px;
       margin-left:-80px;
       animation:loading 1.2s linear infinite;
       -webkit-animation:loading 1.2s linear infinite;
       z-index: 1;
       display: none;
     }
     @keyframes loading{
       0%{transform:rotate(0deg)}
       100%{transform:rotate(360deg)}
     }
     @-webkit-keyframes loading{
       0%{-webkit-transform:rotate(0deg)}
       100%{-webkit-transform:rotate(360deg)}
     }
    </style>



    <section class="content mapa-content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Alarmas</h2>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix" style="margin-bottom: -16px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Configuracion de Parametros
                                <small>Configura los parametros</small>
                            </h2>
                            <h1 id="contenedor"></h1>
                        </div>
                        <div class="body">
                          <div class="row clearfix">
                            <div class="col-md-2">
                              Tiempo de Riego
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                              <div id="Riego" class="noUi-target noUi-ltr noUi-horizontal"></div>
                              <div style="padding-top: 10px">
                                <-----<b id="RiegoValor"></b><b> Minutos</b>----->
                              </div>
                            </div>
                            <div class="col-md-4">
                              <button onclick="RegistarRiego()" style="margin-top: -6px;" class="btn btn-primary btn-block boton1">Registrar</button>
                              <div class="loading loading1"></div>
                            </div>
                          </div>
                          <div class="row clearfix">
                            <div class="col-md-2">
                              Tiempo de Reposo
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                              <div id="Reposo" class="noUi-target noUi-ltr noUi-horizontal"></div>
                              <div style="padding-top: 10px">
                                <-----<b id="ReposoValor"></b><b> Minutos</b>----->
                              </div>
                            </div>
                            <div class="col-md-4">
                              <button onclick="RegistarReposo()" style="margin-top: -6px;" class="btn btn-primary btn-block boton2">Registrar</button>
                              <div class="loading loading2"></div>
                            </div>
                          </div>
                          <div class="row clearfix">
                            <div class="col-md-2">
                              Rango de PH
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                              <div id="slider" class="noUi-target noUi-ltr noUi-horizontal"></div>
                              <div style="padding-top: 10px">
                                <b id="BajoPH"></b><----------><b id="AltoPH"></b>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <button  onclick="RegistarRangoPH()" style="margin-top: -6px;" class="btn btn-primary btn-block boton3">Registrar</button>
                              <div class="loading loading3"></div>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>


      function RegistarRiego() {
        $(".boton1").css("display", "none");
        $(".loading1").css("display", "block");
       var MinutosRiego = $("#RiegoValor").text();


                var url = "<?php echo Request::root() ?>/InsertarParametroRiego";
                $("#contenedor").load(url, {Riego: MinutosRiego});


      }

      function RegistarReposo() {
        $(".boton2").css("display", "none");
        $(".loading2").css("display", "block");
       var MinutosReposo = $("#ReposoValor").text();


       var url = "<?php echo Request::root() ?>/InsertarParametroReposo";
       $("#contenedor").load(url, {Reposo: MinutosReposo});


      }


      function RegistarRangoPH() {

        $(".boton3").css("display", "none");
        $(".loading3").css("display", "block");

       var RangoPH_Inicio = $("#BajoPH").text();
       var RangoPH_Fin = $("#AltoPH").text();
        var url = "<?php echo Request::root() ?>/InsertarParametroRangoPH";
        $("#contenedor").load(url, {RangoPH_Ini: RangoPH_Inicio, RangoPH_Fini: RangoPH_Fin});

      }



     window.onload = function() {

       $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });


        var slider = document.getElementById('slider');

            noUiSlider.create(slider, {
                start: [6, 8],
                step: 0.1,
                connect: true,
                range: {
                    'min': 0,
                    'max': 14
                },
                format: wNumb({
                    decimals: 1
                })
            });

            var nodes = [
                document.getElementById("BajoPH"), // 0
                document.getElementById('AltoPH')  // 1
            ];

            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            slider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
                nodes[handle].innerHTML = values[handle];
            });







            var riego = document.getElementById('Riego');

            noUiSlider.create(riego, {
                start: 0,

                // Disable animation on value-setting,
                // so the sliders respond immediately.
                animate: false,
                step: 1,
                decimals: 0,
                range: {
                    min: 0,
                    max: 100
                },
                format: wNumb({
                    decimals: 0,
                    thousand: '.',
                })
            });

            riego.noUiSlider.on('update', function (values, handle) {
               document.getElementById('RiegoValor').innerHTML = values[handle];
            });












            var reposo = document.getElementById('Reposo');

            noUiSlider.create(reposo, {
                start: 0,

                // Disable animation on value-setting,
                // so the sliders respond immediately.
                animate: false,
                step: 1,
                decimals: 0,
                range: {
                    min: 0,
                    max: 100
                },
                format: wNumb({
                    decimals: 0,
                    thousand: '.',
                })
            });

            reposo.noUiSlider.on('update', function (values, handle) {
               document.getElementById('ReposoValor').innerHTML = values[handle];
            });



        }


           
    </script>


    @include("footer");