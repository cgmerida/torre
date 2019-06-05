<?php
require_once '../complementos/require.php';
$pagina='Dashboard Educa';
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
              <div class="card text-white bg-info">
                <div class="card-header">
                  <h4 class="card-title" id="titulo">Indicador Educa</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-list-alt fa-3x"></i></div>
                  <div><h2 class="card-title" id="indicador"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-info">
                <div class="card-header">
                  <h4 class="card-title">Asistencia</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-users fa-3x"></i></div>
                  <div><h2 class="card-title" id="asistencia"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-info">
                <div class="card-header">
                  <h4 class="card-title">Control de Calidad</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-thumbs-up fa-3x"></i></div>
                  <div><h2 class="card-title" id="calidad"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card text-white bg-info">
                <div class="card-header">
                  <h4 class="card-title">Programación</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-clock-o fa-3x"></i></div>
                  <div><h2 class="card-title" id="progra"></h2></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="offset-md-1 col-md-5">
              <div class="card text-white bg-secondary">
                <div class="card-header">
                  <h4 class="card-title">Total de Actividades</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-list-alt fa-3x"></i></div>
                  <div><h2 class="card-title" id="actividades"></h2></div>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="card text-white bg-secondary">
                <div class="card-header">
                  <h4 class="card-title">Asistentes</h4>
                </div>
                <div class="card-body" style="display: inherit;">
                  <div class="ml-4 mr-5 card-text"><i class="fa fa-users fa-3x"></i></div>
                  <div><h2 class="card-title" id="asistentes"></h2></div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">

            <div class="col-md-3">
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

            <div class="col-md-3">
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

            <div class="col-md-3">
              <div class="form-group">
                <label>Sub-Oficina</label>
                <select class="form-control" id="sub-oficina">
                  <option value="">Seleccione una opcion</option>
                  <option>Ambiente Limpio</option>
                  <option>Rostro Humano</option>
                </select> 
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Programa</label>
                <select class="form-control" id="programa">
                  <option value="" selected>Seleccione una opcion</option>
                </select> 
              </div>
            </div>

          </div>

          <div class="row mb-3">
            <button class="offset-sm-4 col-sm-4 btn btn-lg btn-primary" onclick="actualizarProgra();">
              <i class="fa fa-circle-o-notch fa-fw"></i> Actualizar Programación
            </button>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Mapa de Actividades</h4>
                  <div class="card-category mb-3">
                    Agendados: <span id="agendados"></span><br>
                    Realizados: <span id="realizados"></span><br>
                    Total: <span id="total"></span><br>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <select id="mapa-select" class="form-control">
                        <option hidden>Todo</option>
                        <option>Agendado</option>
                        <option>Realizado</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <strong class="mr-5">Marcadores:</strong><input type="checkbox" class="js-switch marcadores">
                    </div>
                    <div class="col-md-3">
                      <strong class="mr-5">Calor:</strong><input type="checkbox" checked class="js-switch calor">
                    </div>
                    <div class="col-md-3">
                      <strong class="mr-5">Calor 2017:</strong><input type="checkbox" class="js-switch historico">
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="mapa-actividades" style="height: 70vh;"></div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-8">
              <div class="card ">
                <div class="card-header">
                  <h4 class="card-title">Asistencia Mensual</h4>
                </div>
                <div class="card-body">
                  <div id="asistencia-mensual"></div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">Asistencia por genero</h4>
                </div>
                <div class="card-body ">
                  <div id="asistencia-genero" class="ct-chart"></div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Grafica de Actividades</h4>
                </div>
                <div class="card-body">
                  <div id="actividades-chart"></div>
                </div>
              </div>
            </div>
          </div>


        </div><!-- Contenedor -->
      </div>
    </div>
  </div>
  <script type="text/javascript">
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
      var switchery = new Switchery(html, {size: 'small'});
    });

    $(document).ready(function(){
      indicadores();
      mapaActividades();
      asistenciaMensual();
      actividadesGeneral();

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
        indicadores();
        mapaActividades();
      });

      $('#sub-oficina').change(function(){
        indicadores();
        mapaActividades();
        $.post( "datos/programas.php", { oficina: 'Educa', sub: this.value } )
        .done(function( data ) {
          $('#programa').html(data);
        });
      });

      $('#programa').change(function(){
        indicadores();
        mapaActividades();
      });

    });

    function indicadores() {
      var parametros={
        rango: $("#rango").val(),
        fecha: $("#fecha").val(),
        oficina: "Educa",
        sub: $("#sub-oficina").val(),
        programa: $("#programa").val()
      };

      $.getJSON('datos/dashboard/indicadores.php', parametros, function(data) {

        var asistencia =Math.round( (parseInt( data['asistentes']*100 ) ) / data['meta'] );
        var indicador = ( (asistencia *.4) + (data['calidad']*.5) + (data['progra']*.1) );
        $("#indicador").html(Math.round(indicador) + "%");
        $("#asistencia").html( asistencia + "%");
        $("#calidad").html(Math.round(data['calidad'])+ "%");
        $("#progra").html(Math.round(data['progra'])+ "%");
        $("#actividades").html( (data['realizadas'] || 0) + ' de ' + (data['actividades'] || 0) );
        $("#asistentes").html(data['asistentes'] + ' de ' + data['meta']);

      });
    }

    function asistenciaMensual() {
      $.getJSON('datos/dashboard/asistencia-mensual.php', function(data) {
        Highcharts.chart('asistencia-mensual', {
          chart: {
            type: 'column',
            margin: 50
          },
          title: {
            text: null
          },
          credits: {
            enabled: false
          },
          xAxis: {
            type: 'category'
          },
          yAxis: {
            title: {
              text: 'Cantidad de asistentes'
            }
          },
          legend: {
            enabled: false
          },
          plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y}',
                style: {
                  textShadow: 'none'
                }
              }
            },
            column: {
              depth: 25
            }
          },
          navigation: {
            buttonOptions: {
              enabled: false
            }
          },

          responsive: {
            rules: [{
              condition: {
                maxWidth: 500
              },
              chartOptions: {
                legend: {
                  align: 'center',
                  verticalAlign: 'bottom',
                  layout: 'horizontal'
                },
                yAxis: {
                  labels: {
                    align: 'left',
                    x: 0,
                    y: -5
                  },
                  title: {
                    text: null
                  }
                },
                subtitle: {
                  text: null
                },
                credits: {
                  enabled: false
                }
              }
            }]
          },
          series: [{
            name: 'Asistencia',
            data: data
          }]
        });
      }); 
    }

    function actualizarProgra(){
      $('#sub-oficina, #programa').prop('selectedIndex', 0);
      $('#programa').html('<option value="" selected>Seleccione una opcion</option>');
      fecha = $("#fecha").val();
      $('#progra').text("...");
      $.post( "datos/dashboard/programacion.php" , {fecha: fecha})
      .done(function( data ) {
        console.log(data);
        indicadores();
      });
    }

    function mapaActividades(){
      if (!$('input.calor').is(':checked')) {
        $('input.calor').trigger("click");
      }
      if ($('input.marcadores').is(':checked')) {
        $('input.marcadores').trigger("click");
      }

      var parametros={
        rango: $("#rango").val(),
        fecha: $("#fecha").val(),
        oficina: "Educa",
        sub: $("#sub-oficina").val(),
        programa: $("#programa").val()
      };

      var gmarkers=Array(), map=null, agendados=0;
      var heatmap;
      var center=new google.maps.LatLng(14.647938597231168,-90.42314529418945);
      $.getJSON('datos/dashboard/actividades.php', parametros, function(lugares) {
        map = new google.maps.Map(document.getElementById("mapa-actividades"),{
          center: center,
          zoom:12,
          disableDefaultUI:true,
          zoomControl: true,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.RIGHT_TOP
          },
          mapTypeId:google.maps.MapTypeId.ROADMAP
        });

        var controlDiv = document.createElement('DIV');
        controlDiv.className = "btn btn-info mt-2 p-2";
        controlDiv.innerHTML = '<h6><b>Pantalla completa</b></h6>';
        google.maps.event.addDomListener(controlDiv, 'click', completa);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(controlDiv);
        
        var areaNorte = new google.maps.KmlLayer({
          url: 'https://sites.google.com/site/mapabaseregencia/home/LimitesRN.kml?attredirects=0&d=1',
          map:map,
          preserveViewport:true,
          suppressInfoWindows: true
        });

        var oms = new OverlappingMarkerSpiderfier(map, {markersWontMove: true, markersWontHide: false});

        var iw = new google.maps.InfoWindow({
          maxWidth: 500
        });
        google.maps.event.addListener(iw,'closeclick', function(){
          $("#ver-fotos").empty();
        });

        oms.addListener('click', function(marker, event) {
          iw.setContent(marker.desc);
          iw.open(map, marker);
        });

        oms.addListener('spiderfy', function(markers) {
          iw.close();
        });

        for (var i = 0; i < lugares.length; i++) {
          if (lugares[i]['estatus']=='Agendado') {
            agendados++;
          }
          var html= "<p><strong>Actividad: </strong> " + lugares[i]['programa'] + "</p>";
          html +=   "<p><strong>Dirección: </strong> " + lugares[i]['direccion'] + ", " + lugares[i]['colonia'] + ", Zona " + lugares[i]['zona'] + "</p>";
          html +=   "<p><strong>Fecha: </strong> Del " + lugares[i]['fecha'] + " al " + lugares[i]['fin'] + "</p>";
          html +=   "<p><strong>Descripcion: </strong> " + lugares[i]['descripcion'] + "</p>";
          html +=   "<p><strong>Estatus: </strong> " + lugares[i]['estatus'] + "</p>";
          if (lugares[i]['respuesta']) {
            html += "<p><strong>Respuesta: </strong> " + lugares[i]['respuesta'] + "</p>";
          }
          if (lugares[i]['mts']) {
            html += '<p><strong>Metros: </strong> ' + lugares[i]['mts'] + 'mts</p>';
          }
          html += "<p><div id='ver-fotos'></div></p>";
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lugares[i]['lat'], lugares[i]['lng']),
            offset: '0',
            icon: setImg(lugares[i]['estatus']),
            title: lugares[i]['programa'],
            map: map
          });
          marker.id = lugares[i]['id'];
          marker.desc = html;
          marker.estatus = lugares[i]['estatus'];
          marker.setVisible(false);
          marker.setAnimation(google.maps.Animation.DROP);
          oms.addMarker(marker);
          gmarkers.push(marker);
          google.maps.event.addListener(marker, 'click', fotos);
        }
        var heatmapData = [];
        for (var i = lugares.length - 1; i >= 0; i--) {
          heatmapData.push(new google.maps.LatLng(lugares[i]['lat'], lugares[i]['lng']));
        }
        if (!heatmap) {
          heatmap = new google.maps.visualization.HeatmapLayer({
            data: heatmapData
          });
        }
        mapa2017(map);
        heatmap.setMap(map);
        heatmapData = [];
        $("#agendados").html(agendados);
        $("#realizados").html(lugares.length - agendados);
        $("#total").html(lugares.length);
      });


      function completa(argument) {
        if(this.innerHTML == '<h6><b>Pantalla completa</b></h6>'){
          this.innerHTML = '<h6><b>Salir</b></h6>';
          $("#mapa-actividades").css("position", 'fixed').
          css('top', 0).
          css('left', 0).
          css("width", '100%').
          css("height", '100%').
          css("z-index", 10000);
          google.maps.event.trigger(map, 'resize');

        } else {
          this.innerHTML = '<h6><b>Pantalla completa</b></h6>';
          $("#mapa-actividades").css("position", 'relative').
          css('top', 0).
          css("width", "auto").
          css("height", "70vh");
          google.maps.event.trigger(map, 'resize');
        }
      }

      $('input.marcadores').change(function(){
        $('#mapa-select')[0].selectedIndex=0;
        for (var i = 0; i < gmarkers.length; i++) {
          gmarkers[i].setVisible(this.checked);
        }
      });

      $('input.calor').change(function(){
        if (heatmap.getMap() != null) {
          heatmap.setMap(null);
        } else {
          heatmap.setMap(map);
        }
      });

      $('#mapa-select').change(function(){
        for (var i = 0; i < gmarkers.length; i++) {
          gmarkers[i].setVisible(false);
          if (gmarkers[i].estatus==this.value) {
            gmarkers[i].setVisible(true);
          }
        }
      });

    }

    function mapa2017(mapa){
      var heatmap;
      $.getJSON('datos/dashboard/actividades2017.php', function(lugares) {
        var heatmapData = [];
        for (var i = lugares.length - 1; i >= 0; i--) {
          heatmapData.push(new google.maps.LatLng(lugares[i]['lat'], lugares[i]['lng']));
        }
        if (!heatmap) {
          heatmap = new google.maps.visualization.HeatmapLayer({
            data: heatmapData
          });
        }
      });

      $('input.historico').change(function(){
        if (heatmap.getMap() != null) {
          heatmap.setMap(null);
        } else {
          heatmap.setMap(mapa);
        }
      });

    }

    function fotos(){
      marker = this;
      $.post( "datos/ver-fotos.php", { id: marker.id } )
      .done(function( data ) {
        $('#ver-fotos').html(data);
        $('#ver-fotos a').each(function( index ) {
          $( this ).attr('data-caption', $(this).html() );
        });
        $('#btn-fotos').click(function(){
          $('#ver-fotos a').first().trigger("click");
        });

        $('[data-fancybox="fotos"]').fancybox({
          buttons : [
          'slideShow',
          'fullScreen',
          'thumbs',
          'download',
          'zoom',
          'close'
          ]
        });

      });
    }

    function setImg(estatus) {
      color = "";
      switch(estatus){
        case 'Agendado':
        color = "007bff";
        break;
        case 'Realizado':
        color = "28a745";
        break;
        default:
        color = "dc3545";
        break;
      }
      return "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|" + color;
    }

    function actividadesGeneral(){
      $.getJSON('datos/dashboard/actividades-grafica.php', {oficina: 'Educa'}, function(data) {
        Highcharts.chart('actividades-chart', {
          chart: {
            type: 'column',
            margin: 50,
            events: {
              drilldown: function (e) {
                console.log("hola");
                if (!e.seriesOptions) {
                  var chart = this;
                  chart.showLoading('Cargando información..');
                  $.post("datos/dashboard/actividades-mensual-grafica.php", { 
                    oficina: e.point.name
                  })
                  .done(function(drill) {
                    if(drill == 'falta'){
                      alert('Faltan los datos');
                    }
                    chart.hideLoading();
                    chart.addSeriesAsDrilldown(e.point, drill);
                  });
                }
              }
            }
          },
          title: {
            text: null
          },
          credits: {
            enabled: false
          },
          xAxis: {
            type: 'category'
          },
          yAxis: {
            title: {
              text: 'Cantidad de actividades'
            }
          },
          legend: {
            enabled: false
          },
          plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y}',
                style: {
                  textShadow: 'none'
                }
              }
            },
            column: {
              depth: 25
            }
          },
          navigation: {
            buttonOptions: {
              enabled: false
            }
          },

          responsive: {
            rules: [{
              condition: {
                maxWidth: 500
              },
              chartOptions: {
                legend: {
                  align: 'center',
                  verticalAlign: 'bottom',
                  layout: 'horizontal'
                },
                yAxis: {
                  labels: {
                    align: 'left',
                    x: 0,
                    y: -5
                  },
                  title: {
                    text: null
                  }
                },
                subtitle: {
                  text: null
                },
                credits: {
                  enabled: false
                }
              }
            }]
          },
          series: [{
            name: 'Actividades',
            data: data
          }]
        });
      }); 
    }
  </script>
</body>
</html>