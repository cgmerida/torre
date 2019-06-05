<?php
require_once '../complementos/require.php';
$pagina='Agenda';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/es.js'></script>

  <!-- FULL CALENDAR -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="http://use.fontawesome.com/releases/v5.0.6/css/all.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>

  <!-- fancy box  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js" defer></script>

</head>
<style type="text/css">
  .fc-event{cursor: pointer;}
  .fc-center{text-transform: capitalize;}
</style>
<body>
  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-white">
          <h2 class="modal-title m-0" id="modal-title">Modal title</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="contenido"></div>
          <div id="ver-fotos"></div>
          <div class="clearfix"></div>
          <br>

        </div>
        <div class="modal-footer">
          <div class="mensaje-modal text-left"></div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close fa-fw"></i>Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina el Modal -->

  <div class="wrapper">
    <?php include_once '../pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once '../pagina/navbar.php'; ?>
      <div class="content">
        <div class="container-fluid">

          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label>Oficina</label>
                <select class="form-control" tabindex="10" id="oficina" name="oficina">
                  <option value="" selected>Seleccione una opcion</option>
                  <option>Jardines</option>
                  <option>Educa</option>
                </select> 
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Sub-Oficina</label>
                <select class="form-control" tabindex="11" id="sub-oficina" name="sub-oficina">
                  <option value="" hidden>Seleccione una opcion</option>
                </select> 
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Programa</label>
                <select class="form-control" tabindex="12" id="programa" name="programa">
                  <option value="" selected>Seleccione una opcion</option>
                </select> 
              </div>
            </div>

            <div class="col-md-3">
              <div class="row justify-content-center mt-4">
                <button class="btn btn-success" id="filtro"><i class="fa fa-filter fa-fw"></i> Filtrar</button>
              </div>
            </div>

          </div>
          <div class="row">
            <div id="calendario" class="col-md-12"></div>
          </div>

        </div><!-- Contenedor -->
      </div>
    </div>
  </div>
  <script type="text/javascript">

    $(document).ready(function(){
      CrearCalendario();


      $('#oficina').change(function(){
        var opciones='<option value="" selected>Seleccione sub oficina</option><option>Jardines</option>';
        if (this.value=='Educa') {
          var opciones='<option value="" selected>Seleccione sub oficina</option><option>Ambiente Limpio</option><option>Rostro Humano</option>';
        }
        $('#sub-oficina').html(opciones)
      });

      $('#sub-oficina').change(function(){
        $.post( "datos/programas.php", { oficina: $('#oficina').val(), sub: this.value } )
        .done(function( data ) {
          $('#programa').html(data);
        }); 
      });

      $('#filtro').click(function() {

        var events = {
          url: 'datos/agenda/actividades.php',
          type: 'POST',
          data: {
            oficina: $('#oficina').val(),
            sub: $('#sub-oficina').val(),
            programa: $('#programa').val()
          }
        }

        $('#calendario').fullCalendar('removeEventSource', events);
        $('#calendario').fullCalendar('addEventSource', events);
        $('#calendario').fullCalendar('refetchEvents');
      });


    });

    function CrearCalendario() {
      $('#calendario').fullCalendar({
        events: {
          url: 'datos/agenda/actividades.php',
          type: 'POST'
        },
        themeSystem: 'bootstrap4',
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month, listMonth, listWeek'
        },
        minTime: '08:00:00',
        maxTime: '17:00:00',
        locale: 'es',
        eventLimit: true, 
        weekends: false,
        eventClick: function(evento) {
          $('.modal-header').css('background-color', evento.color);
          $('.modal-title').html('<i class="fa fa-fw fa-info"></i> ' + evento.programa);
          var html= "<p><strong>Actividad: </strong> " + evento.title + "</p>";
          html +=   "<p><strong>Dirección: </strong> " + evento.direccion + "</p>";
          html +=   "<p><strong>Fecha: </strong> Del " + evento.start.format('DD/MM/YYYY hh:mm:s a')
          + " al " + evento.end.format('DD/MM/YYYY hh:mm:s a') + "</p>";
          html +=   "<p><strong>Descripcion: </strong> " + evento.descripcion + "</p>";
          html +=   "<p><strong>Estatus: </strong> " + evento.estatus + "</p>";
          if (evento.respuesta) {
            html += "<p><strong>Respuesta: </strong> " + evento.respuesta + "</p>";
          }
          if (evento.mts) {
            html += '<p><strong>Metros: </strong> ' + evento.mts + 'mts</p>';
          }
          $('#contenido').html(html);
          fotos(evento.id);
          $('#modal').modal('show');
        },
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives'
      });
      $(".fc-listMonth-button").text("Agenda Mes");
    };


    $('#modal').on('hidden.bs.modal', function (e) {
      $(".mensaje-modal, #ver-fotos").empty();
    });

    function fotos(id){
      $.post( "../actividades/datos/ver-fotos.php", { id: id } )
      .done(function( data ) {
        $('#ver-fotos').html(data);
        $('#ver-fotos a').each(function( index ) {
          $( this ).attr('data-caption', $(this).html() );
          $( this ).attr('href', "../actividades/" + $( this ).attr('href') );
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
    };

  </script>
</body>
</html>