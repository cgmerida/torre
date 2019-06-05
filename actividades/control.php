<?php
require_once '../complementos/require.php';
$pagina='Control de Actividades';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/es.js'></script>

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

          <div class="foto" style="display: none;">
            <form  name="fotos" enctype="multipart/form-data">
              <input type="hidden" name="id_intervencion">


              <div class="form-group">
                <label for="foto" class="form-control-label">Foto: </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <label class="btn btn-outline-primary">
                      Buscar Foto<input type="file" id="foto" name="foto" class="d-none" accept="image/*">
                    </label>
                  </div>
                  <input type="text" class="form-control" placeholder="Seleccione una foto" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="form-control-label">Nombre: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-address-book-o fa-fw"></i>
                  <input id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                </div>
              </div>


              <div class="form-group">
                <label for="descripcion" class="form-control-label">Descripcion: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-id-card-o fa-fw"></i>
                  <input id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion la foto">
                </div>
              </div>

              <div class="form-group">
                <label for="tipo" class="form-control-label">Tipo:</label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-list fa-fw"></i>
                  <select class="form-control" id="tipo" name="tipo">
                    <option value="" hidden>Seleccione un tipo</option>
                    <option value="">Ninguno</option>
                    <option>Antes</option>
                    <option>Proceso</option>
                    <option>Despues</option>
                  </select>
                </div>
              </div>  

            </form>
            <div id="ver-fotos"></div>
          </div>

          <div class="editar" style="display: none;">
            <form name="editar">
            </form>
          </div>
          <div class="cerrar" style="display: none;">
            <form name="cerrar">
              <input type="hidden" name="id_intervencion">
              <div class="form-group">
                <label for="fecha_real" class="form-control-label">Fecha: </label>
                <div class="input-group date" id="fecha_real" data-target-input="nearest">
                  <input placeholder="Fecha y hora de inicio" name="fecha" class="form-control datetimepicker-input" data-target="#fecha_real" readonly>
                  <div class="input-group-append" data-target="#fecha_real" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="fin_real" class="form-control-label">Fecha fin: </label>
                <div class="input-group date" id="fin_real" data-target-input="nearest">
                  <input placeholder="Fecha y hora de fin" name="fecha_fin" class="form-control datetimepicker-input" data-target="#fin_real" readonly>
                  <div class="input-group-append" data-target="#fin_real" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>

              </div>
              <div class="form-group">
                <label for="respuesta" class="form-control-label">Respuesta: </label>
                <div class="inner-addon left-addon">
                  <i class="fa fa-info-circle fa-fw"></i>
                  <input id="respuesta" name="respuesta" class="form-control" placeholder="respuesta">
                </div>
              </div>
            </form>
          </div>

          <div class="eliminar" style="display: none;">
            <form name="eliminar">
              <input type="hidden" name="id_intervencion">
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
        <h1 class="display-3 text-center">Búsqueda de actividades</h1>
        <center>
          <button class="btn btn-success btn-lg" id="buscar">
            Buscar <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </center>
      </div>

      <div class="content">
        <div class="container-fluid">
          <!-- CONTENIDO -->


          <div class="col-md-12">

            <form id="busqueda">
              <div class="row">
                <div class="col-md-3">
                  <h4 class="m-0">Fecha</h4>
                  <div class="input-group date" id="fecha-control" data-target-input="nearest">
                    <input placeholder="Fecha de la actividad" name="fecha" tabindex="7" class="form-control datetimepicker-input" data-target="#fecha-control" readonly>
                    <div class="input-group-append" data-target="#fecha-control" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <h4 class="m-0">Oficina</h4>
                  <select tabindex="2" class="form-control" id="oficina" name="oficina">
                    <option value="" selected hidden>Seleccione una oficina</option>
                    <option>Jardines</option>
                    <option>Educa</option>
                  </select> 
                </div>
                <div class="col-md-3">
                  <h4 class="m-0">Sub-oficina</h4>
                  <select tabindex="3" class="form-control" id="sub-oficina" name="sub-oficina">
                    <option value="" selected hidden>Seleccione oficina</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <h4 class="m-0">Programa</h4>
                  <select tabindex="4" class="form-control" id="programa" name="programa">
                    <option value="" selected hidden>Seleccione programa</option>
                  </select>
                </div>
              </form>
            </div>
          </div>
          <hr>
          <div class="mensaje"></div>
          <div id="tablas"></div>
          <div class="clearfix"></div>
          <br><br>
          <br><br>
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
    });

    $(function() {

      $('#fecha-control').datetimepicker({
        format: 'YYYY/MM/DD',
        ignoreReadonly: true,
        locale: 'es'
      });

      $('#fecha_real').datetimepicker({
        format: 'YYYY/MM/DD HH:mm',
        ignoreReadonly: true,
        locale: 'es'
      });
      $('#fin_real').datetimepicker({
        useCurrent: false,
        format: 'YYYY/MM/DD HH:mm',
        ignoreReadonly: true,
        locale: 'es'
      });
      $("#fecha_real").on("change.datetimepicker", function (e) {
        $('#fin_real').datetimepicker('minDate', e.date);
      });
      $("#fin_real").on("change.datetimepicker", function (e) {
        $('#fecha_real').datetimepicker('maxDate', e.date);
      });

    });

    $('#oficina').change(function(){
      var opciones='<option value="" selected hidden>Seleccione sub oficina</option><option>Jardines</option>';
      if (this.value=='Educa') {
        var opciones='<option value="" selected hidden>Seleccione sub oficina</option><option>Ambiente Limpio</option><option>Rostro Humano</option>';
      }
      $('#sub-oficina').html(opciones);
      $('#programa').html("<option value='' selected hidden>Seleccione programa</option>");
    });

    $('#sub-oficina').change(function(){
      $.post( "datos/programas.php", { oficina: $('#oficina').val(), sub: this.value } )
      .done(function( data ) {
        $('#programa').html(data);
      });
    });

    $('#buscar').click(function() {
      if (!verificarForm('#busqueda input')) {return false;}
      $.post("datos/actividades.php", $('#busqueda').serialize())
      .done(function( data ) {
        $('#tablas').html(data);
        obtenerTablas();
        $('[data-toggle="tooltip"]').tooltip();
      });
    });

    function verificarForm(form) {
      var x=true;
      $(form).not( $(".bootstrap-select :input") ).each(function() {
        if( !$(this).val() ){
          $(".mensaje").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'
            +'<strong>Error!</strong> Ingrese ' + $(this).attr('name') + '.'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span></button></div>');
          $(".mensaje").show();
          x=false;
        }
        return x;
      });
      return x;
    }
    function verificarFormModal(form) {
      var x=true;
      $(form).not( $(".bootstrap-select :input") ).each(function() {
        if( !$(this).val() ){
          $(".mensaje-modal").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'
            +'<strong>Error!</strong> Ingrese ' + $(this).attr('name') + '.'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span></button></div>');
          $(".mensaje-modal").show();
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

    function func_foto(id){
      $.post( "datos/ver-fotos.php", { id: id } )
      .done(function( data ) {
        $('#ver-fotos').append(data);
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
          // 'share',
          'download',
          'zoom',
          'close'
          ]
        });

      });
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-primary");
      $('.modal-title').html('<i class="fa fa-fw fa-file-image-o"></i> Agregar Fotos');
      $('#guardar').removeClass().addClass("btn btn-primary");
      $('#modal').modal('show');
      $('.foto').show();
      $('.foto input[name=id_intervencion]').val(id);
    }
    function func_editar(id){
      $.post( "datos/modal-editar.php", { id: id } )
      .done(function( data ) {
        $('form[name=editar]').html(data);
        $('.selectpicker').selectpicker('show');
      });
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-warning");
      $('.modal-title').html('<i class="fa fa-fw fa-pencil"></i> Editar');
      $('#guardar').removeClass().addClass("btn btn-warning");
      $('#modal').modal('show');
      $('.editar').show();
    }
    function func_cerrar(id){
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-success");
      $('.modal-title').html('<i class="fa fa-fw fa-check"></i> Cerrar');
      $('#guardar').removeClass().addClass("btn btn-success");
      $('#modal').modal('show');
      $('.cerrar').show();
      $('.cerrar input[name=id_intervencion]').val(id);
    }
    function func_eliminar(id){
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-danger");
      $('.modal-title').html('<i class="fa fa-fw fa-trash"></i> Eliminar');
      $('#guardar').removeClass().addClass("btn btn-danger");
      $('#modal').modal('show');
      $('.eliminar').show();
      $('.eliminar input[name=id_intervencion]').val(id);
    }
    function eliminarFoto(id){
      var r = confirm("¿Desea borrar la foto?");
      if (r == true) {
        $.post( "datos/eliminar-fotos.php", { id: id } )
        .done(function( response ){
          $('.fancybox-button--close').click();
          mensajes(response);
        });
      }
    }

    function colonias(valor) {
      $.post( "datos/colonias.php", { zona: valor } )
      .done(function( data ) {
        $('#colonia').prop('disabled', false).html(data).selectpicker('refresh');
      });
    }


    $('#modal').on('hidden.bs.modal', function (e) {
      $('.foto, .editar, .cerrar, .eliminar').hide();
      $('.span-cam').html('<i class="fa fa-camera fa-fw fa-lg"></i> Seleccione una foto');
      $('#modal form').each(function() { this.reset() });
      $(".mensaje-modal, #ver-fotos").empty();
    });

    $('#guardar').click(function(){
      var form = $("#modal form:visible");
      var formData = new FormData( form[0] );
      switch(form.attr('name')){
        case 'fotos':
        if(!verificarFormModal('form[name=fotos] input')){return 0;}
        $.ajax({
          url: "datos/fotos.php",
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
        case 'cerrar':
        if(!verificarFormModal('form[name=cerrar] input')){return 0;}
        $.ajax({
          url: "datos/cerrar.php",
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
            url: "datos/eliminar-evento.php",
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
    function mensajes(data) {
      if (data == "exito") {
        $("#buscar").trigger("click");
        $(".mensaje-modal").append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
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
          "<strong>Error!</strong> Es probable que haya fallado el sistema.</div>");
        console.log(data);
      }
    }
  </script>
</body>
</html>