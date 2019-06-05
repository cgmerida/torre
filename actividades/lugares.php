<?php
require_once '../complementos/require.php';
$pagina='Control de Lugares';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" async></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/es.js' defer></script>

  <link rel="stylesheet" href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.css">
  <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js" defer></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css">
  <!-- DataTables JavaScript -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" defer></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" defer></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js" defer></script>

  <!-- fancy box  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js" defer></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title m-0" id="modal-title">Modal title</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="actividad" style="display: none;">
            <form name="actividad">
              <input type="hidden" name="id_lugar">
              <div class="form-group">
                <label for="fecha" class="form-control-label">Fecha inicio planificada: </label>
                <div class="input-group date" id="fecha" data-target-input="nearest">
                  <input placeholder="Fecha y hora de inicio" name="fecha" class="form-control datetimepicker-input" data-target="#fecha" readonly>
                  <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="fecha_fin" class="form-control-label">Fecha fin: </label>
                <div class="input-group date" id="fecha_fin" data-target-input="nearest">
                  <input placeholder="Fecha y hora de fin" name="fecha_fin" class="form-control datetimepicker-input" data-target="#fecha_fin" readonly>
                  <div class="input-group-append" data-target="#fecha_fin" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="fecha_real" class="form-control-label">Descripción: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-info-circle fa-fw"></i>
                  <input class="form-control " placeholder="Informacion de la actividad" id="descripcion" name="descripcion">
                </div>
              </div>
              <div class="form-group">
                <label for="fin_real" class="form-control-label">Oficina: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-building-o fa-fw"></i>
                  <select class="form-control" id="oficina" name="oficina">
                    <option value="" selected>Seleccione una opcion</option>
                    <option>Jardines</option>
                    <option>Educa</option>
                  </select> 
                </div>
              </div>
              <div class="form-group">
                <label for="respuesta" class="form-control-label">Sub-Oficina: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-home fa-fw"></i>
                  <select class="form-control" id="sub-oficina" name="sub-oficina">
                    <option value="" selected>Seleccione una opcion</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="respuesta" class="form-control-label">Programa: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-product-hunt fa-fw"></i>
                  <select class="form-control" id="programa" name="programa">
                    <option value="" selected>Seleccione una opcion</option>
                  </select>
                </div>
              </div>
            </form>
          </div>

          <div class="eliminar" style="display: none;">
            <form name="eliminar">
              <input type="hidden" name="id_lugar">
              <div class="form-group">
                <label for="eliminar" class="form-control-label">Escriba la palabra Eliminar: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-trash-o fa-fw"></i>
                  <input id="eliminar" name="eliminar" class="form-control" placeholder="Eliminar">
                </div>
              </div>
            </form>
          </div>

          <div class="clearfix"></div>
          <br>

        </div>
        <div class="modal-footer">
          <div class="mensaje-modal text-left"></div>
          <button type="button" class="btn btn-primary" id="guardar"><i class="fa fa-save fa-fw"></i> Guardar</button>
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

      <div class="jumbotron m-0">
        <h1 class="display-3 text-center">Búsqueda de lugares</h1>
        <center>
          <button class="btn btn-success btn-lg" id="buscar">
            Buscar <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </center>
      </div>

      <div class="content">
        <div class="container-fluid">
          <!-- CONTENIDO -->
          <form id="busqueda">

            <div class="row">
              <div class="col-md-3">
                <h4 class="m-0">Zona</h4>
                <select class="form-control"  tabindex="1" id="zona" name="zona" >
                  <option value="" selected hidden>Seleccione una zona</option>
                  <option>17</option>
                  <option>18</option>
                  <option>24</option>
                  <option>25</option>
                  <option>otra</option>
                </select>
              </div>

              <div class="col-md-3">
                <h4 class="m-0">Colonia</h4>
                <select class="form-control selectpicker" id="colonia" name="colonia" data-live-search='true' tabindex="2">
                  <option value="" selected>Seleccione Colonia</option>
                </select>
              </div>

              <div class="col-md-3">
                <h4 class="m-0">Dirección</h4>
                <input class="form-control" placeholder="Lugar de la actividad?" id="direccion" name="direccion" tabindex="3">
              </div>

              <div class="col-md-3">
                <h4 class="m-0">Nombre</h4>
                <input class="form-control" placeholder="Nombre del parque o Escuela" id="nombre" name="nombre" tabindex="4">
              </div>
            </div>
          </form>
          <hr>

          <div class="mensaje"></div>
          <div id="tablas"></div>

        </div><!-- /container-fluid -->
      </div><!-- /content -->
    </div><!-- /main-panel -->
  </div><!-- /wrapper -->
  <script type="text/javascript">

    $(document).ready(function(){
      $.extend( $.fn.dataTable.defaults, {
        responsive: true,
        "language": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Total registros _TOTAL_",
          "sInfoEmpty":      "No hay registros disponibles",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          },
          buttons: {
            colvis: 'Columnas',
            copyTitle: 'Copiado al cortapapeles',
            copySuccess: {
              _: '%d lineas copiadas',
              1: '1 linea copiada'
            }
          }
        }
      });

      $('select.form-control').css('color','#999');
      $('select.form-control').change(function() {
        $(this).css('color','#565656');
      });

      $('.selectpicker').selectpicker();
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.selectpicker').selectpicker('mobile');
      }
    });

    $('#zona').change(function(){
      if (this.value=='otra') {
        $('#colonia').prop('disabled', true).html('<option value="" selected>Sin Colonia</option>').selectpicker('refresh');
        return false;
      }
      $.post( "datos/colonias.php", { zona: this.value } )
      .done(function( data ) {
        $('#colonia').prop('disabled', false).html(data).selectpicker('refresh');
      });
    });
    $(document).ready(function(){

      $('#buscar').click(function() {
        if (!verificarForm('#zona, #colonia')) {return false;}
        $.post("datos/lugares.php", $('#busqueda').serialize())
        .done(function( data ) {
          $('#tablas').html(data);
          obtenerTablas();
          $('[data-toggle="tooltip"]').tooltip();
        });
      });

    });

    function verificarForm(form) {
      var x=true;
      $(form).not( $(".bootstrap-select :input") ).each(function() {
        if( !$(this).val() ){
          $(".mensaje").append("<div class='alert alert-danger fade show'>"+
            "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
            "<strong>Error!</strong> Ingrese " + $(this).attr('name') + ".</div>");
          $(".mensaje").show();
          x=false;
        }
        return x;
      });
      return x;
    }

    function obtenerTablas(){
      $('table.table').DataTable()
      .columns.adjust()
      .responsive.recalc();
    }

    function verActividades(id) {
      window.open("actividades.php?id="+id, '_blank');
    }

    function agregarActividad(id) {
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-primary");
      $('.modal-title').html('<i class="fa fa-fw fa-plus-circle"></i> Nueva Actividad');
      $('#guardar').removeClass().addClass("btn btn-primary");
      $('#modal').modal('show');
      $('.actividad').show();      
      $('.actividad input[name=id_lugar]').val(id);
    }
    function editarLugar(id) {
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-warning");
      $('.modal-title').html('<i class="fa fa-fw fa-pencil"></i> Editar');
      $('#guardar').removeClass().addClass("btn btn-warning");
      $('#modal').modal('show');
      $('.editar').show();
      $('.editar input[name=id_lugar]').val(id);
    }
    function eliminarLugar(id) {
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-danger");
      $('.modal-title').html('<i class="fa fa-fw fa-trash"></i> Eliminar');
      $('#guardar').removeClass().addClass("btn btn-danger");
      $('#modal').modal('show');
      $('.eliminar').show();
      $('.eliminar input[name=id_lugar]').val(id);
    }

    $('#modal').on('hidden.bs.modal', function (e) {
      $('.actividad, .editar, .eliminar').hide();
      $('#modal form').each(function() { this.reset() });
      $(".mensaje-modal").empty();
    });


    $(function() {

      $('#fecha').datetimepicker({
        format: 'YYYY/MM/DD HH:mm',
        locale: 'es',
        ignoreReadonly: true,
      });

      $('#fecha_fin').datetimepicker({
        useCurrent: false,
        format: 'YYYY/MM/DD HH:mm',
        locale: 'es',
        ignoreReadonly: true
      });

      $("#fecha").on("change.datetimepicker", function (e) {
        $('#fecha_fin').datetimepicker('minDate', e.date);
      });
      $("#fecha_fin").on("change.datetimepicker", function (e) {
        $('#fecha').datetimepicker('maxDate', e.date);
      });

    });

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


    $('#guardar').click(function(){
      var form = $("#modal form:visible");
      var formData = new FormData( form[0] );
      switch(form.attr('name')){
        case 'actividad':
        if(!verificarFormModal('form[name=actividad] input, form[name=actividad] select')){return 0;}
        $.ajax({
          url: "datos/modal-crear-actividad.php",
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(data){
          mensajes(data);
        });
        break;
        case 'editar':
        if(!verificarFormModal('form[name=editar] input, form[name=editar] select')){return 0;}
        $.ajax({
          url: "datos/editar.php",
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false
        })
        .done(function(data){
          mensajes(data);
        });
        break;
        case 'eliminar':
        if(!verificarFormModal('form[name=eliminar] input')){return 0;}
        if ($('form[name=eliminar] input[name=eliminar]').val() == 'Eliminar' ) {
          $.ajax({
            url: "datos/eliminar-lugar.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
          })
          .done(function(data){
            mensajes(data);
          });
        } else {
          mensajes("eliminar");
        }
        break;
      }
    });


    function verificarFormModal(form) {
      var x=true;
      $(form).not( $(".bootstrap-select :input") ).each(function() {
        if( !$(this).val() ){
          $(".mensaje-modal").append("<div class='alert alert-danger fade show'>"+
            "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
            "<strong>Error!</strong> Ingrese " + $(this).attr('name') + ".</div>");
          $(".mensaje-modal").show();
          x=false;
        }
        return x;
      });
      return x;
    }


    function mensajes(data) {
      if (data == "exito") {
        $("#buscar").trigger("click");
        $(".mensaje-modal").append("<div class='alert alert-success fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Exito!</strong> Se ingresaron los datos correctamente.</div>");
        $('#modal form').trigger("reset");
        setTimeout(function(){
          $('#modal').modal('hide');
        }, 1200);

      } else if (data == "falta") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Faltaron datos para la solicitud.</div>");
      } else if (data == "eliminar") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> No escribió la palabra correctamente.</div>");
      } else if (data == "nombre") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Archivo ya existente.</div>");
      } else if (data == "tamano") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Foto demasiado grande (MAX: 5MB).</div>");
      } else if (data == "tipo") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Tipo de archivo no permitido.</div>");
      } else if (data == "foto error") {
        $(".mensaje-modal").append("<div class='alert alert-danger fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Error!</strong> No se pudo subir la foto.</div>");
      } else if (data == "no existe") {
        $(".mensaje-modal").append("<div class='alert alert-danger fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Error!</strong> No se pudo borrar foto.</div>");
      } else {
        $(".mensaje-modal").append("<div class='alert alert-danger fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Error!</strong> Es probable que haya fallado el sistema."+
          "<p>"+ data +"</p></div>");
      }
    }
  </script>
</body>
</html>