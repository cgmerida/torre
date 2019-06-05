<?php
require_once '../complementos/require.php';
$pagina='Dashboard Control de Calidad';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
  require_once '../pagina/header.php';
  ?>

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <link rel=stylesheet type=text/css href=/torre/dist/css/chartist-plugin-tooltip.css>
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js" defer></script>
  <script src=/torre/dist/js/chartist-plugin-tooltip.min.js defer></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>


  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCH5jx8cbDO-sfqwcYUO8l-_qk-cfJ8jg&libraries=visualization"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>


  <!-- fancy box  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js" defer></script>

</head>

<body>
  <div class="wrapper">
    <?php include_once '../pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once '../pagina/navbar.php'; ?>
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-3">
              <div class="card text-white bg-primary">
                <div class="card-header">
                  <h4 class="card-title" id="titulo">Dispensario Movil</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-bus fa-3x"></i></div>
                  <div><h2 class="card-title" id="dispensario-movil"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-primary">
                <div class="card-header">
                  <h4 class="card-title">Cuenta Cuentos</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-book fa-3x"></i></div>
                  <div><h2 class="card-title" id="cuenta-cuentos"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-primary">
                <div class="card-header">
                  <h4 class="card-title">Valija Viajera</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-suitcase fa-3x"></i></div>
                  <div><h2 class="card-title" id="valija-viajera"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-primary">
                <div class="card-header">
                  <h4 class="card-title">Mantenimiento</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-leaf fa-3x"></i></div>
                  <div><h2 class="card-title" id="mantenimiento"></h2></div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">

            <div class="col-md-4 offset-md-2">
              <div class="form-group">
                <label>Rango</label>
                <select class="form-control" id="rango">
                  <option selected value="1">Mensual</option>
                  <option value="3">Trimestral</option>
                  <option value="6">Semestral</option>
                  <option value="12">Anual</option>
                </select> 
              </div>
            </div>

            <div class="col-md-4 offset-md-1">
              <div class="form-group">
                <label>Fecha</label>
                <select class="form-control" id="fecha">
                  <?php
                  $meses = array('Enero' => 1, 'Febrero' => 2, 'Marzo' => 3, 'Abril' => 4, 'Mayo' => 5, 'Junio' => 6, 'Julio' => 7, 'Agosto' => 8, 'Septiembre' => 9, 'Octubre' => 10, 'Noviembre' => 11, 'Diciembre' => 12);
                  foreach ($meses as $nombre => $valor) {
                    if ( $valor == date('n') ) {
                      echo "<option selected value=$valor>$nombre</option>";
                    } else {
                      echo "<option value=$valor>$nombre</option>";
                    }
                  }
                  ?>
                </select> 
              </div>
            </div>
          </div>

        </div><!-- Contenedor -->
      </div>
    </div>
  </div>
  <script type="text/javascript">

    $(document).ready(function(){
      encuestas();

      $("#rango").change(function(){
        var meses, html = "<option selected hidden>Seleccionar</option>", rango = parseInt(this.value);
        meses = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        for (i = 0; i < meses.length; i = i + rango ) {
          if (rango == 1) {
            html += "<option value=" + (i+1) + ">" + meses[i] + "</option>";
          } else {
            html += "<option value=" + (i+1) + ">" + meses[i] + " - " + meses[ (i + rango) - 1] + "</option>";
          }
        }
        $("#fecha").html(html);
      });

      $("#fecha").change(function(){
        encuestas();
      });

    });

    function encuestas() {
      $('#dispensario-movil, #cuenta-cuentos, #valija-viajera, #mantenimiento').html('Cargando..');
      var parametros={
        rango: $("#rango").val(),
        fecha: $("#fecha").val()
        // oficina: "Educa",
        // sub: $("#sub-oficina").val(),
        // programa: $("#programa").val()
      };
      $.post("datos/encuestas/resultados.php", parametros)
      .done(function(data){

        $('#dispensario-movil, #cuenta-cuentos, #valija-viajera, #mantenimiento').html('--');
        $.each( data, function( key, value ) {
          $('#' + key).html( value + '%');
        });
      });
    }
  </script>
</body>
</html>