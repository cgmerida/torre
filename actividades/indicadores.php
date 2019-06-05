<?php
require_once '../complementos/require.php';
$pagina='Indicadores';
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

</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center text-white bg-primary">
          <h2 class="modal-title m-0" id="modal-title"><i class="fa fa-fw fa-pencil"></i> Editar</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="indicadores">
            <input type="hidden" name="id_indicador">

            <div class="form-group">
              <label for="respuesta" class="form-control-label">Indicador: </label>
              <div class="inner-addon left-addon">
                <i class="fa fa-list fa-fw"></i>
                <select class="form-control" name="indicador">
                  <option hidden="" value="">Ingrese indicador</option>
                  <option>Asistencia</option>
                  <option>Calidad</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label for="valor" class="form-control-label">Valor: </label>
              <div class="inner-addon left-addon">
                <i class="fa fa-database fa-fw"></i>
                <input id="valor" name="valor" class="form-control" placeholder="Valor">
              </div>
            </div>

          </form>
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
        <h1 class="display-3 text-center">Creación de indicadores</h1>
        <center>
          <button class="btn btn-info btn-lg" id="buscar">
            Buscar <i class="fa fa-search fa-fw" aria-hidden="true"></i>
          </button>
          <button class="btn btn-success btn-lg" id="crear">
            Crear <i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i>
          </button>
        </center>
      </div>

      <div class="content">
        <div class="container-fluid">
          <!-- CONTENIDO -->

          <div class="col-md-12">

            <form id="creacion">
              <div class="row">
                <div class="col-md-4">
                  <h4 class="m-0">Mes</h4>
                  <div class="input-group date" id="fecha-control" data-target-input="nearest">
                    <input placeholder="Mes del indicador" name="fecha" tabindex="7" class="form-control datetimepicker-input" data-target="#fecha-control" readonly>
                    <div class="input-group-append" data-target="#fecha-control" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <h4 class="m-0">Programa</h4>
                  <select tabindex="4" class="form-control" id="programa" name="programa">
                    <option value="" selected hidden>Seleccione programa</option>
                    <?php
                    require "../complementos/conexion.php";

                    $sql = 'SELECT oficina, programa FROM estructura;';

                    $query=mysqli_query($mysqli, $sql);
                    if( $query === false ) {
                      die( print_r( mysqli_error($mysqli), true));
                    }

                    $grupos=array();
                    while ($fila = mysqli_fetch_assoc($query)) {
                      $grupos[$fila['oficina']][]=$fila['programa'];
                    }
                    foreach ($grupos as $key => $values){
                      echo '<optgroup label='.$key.'>';
                      foreach ($values as $value){
                        echo '<option>'.$value.'</option>';
                      }
                      echo '</optgroup>';
                    }

                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <h4 class="m-0">Meta</h4>
                  <input type="text" name="meta" class="form-control" placeholder="Ingrese la meta de la asistencia">
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

      indicadores();
    });

    $(function() {
      $('#fecha-control').datetimepicker({
        format: 'YYYY/MM',
        ignoreReadonly: true,
        locale: 'es'
      });
    });

    function indicadores() {
      $.post("datos/indicadores/indicadores.php", $('#creacion').serialize())
      .done(function(data){
        $('#tablas').html(data);
        obtenerTablas();
      });
    }

    function agregarIndicador(id){
      $('#indicadores input[name=id_indicador]').val(id);
      $('#modal').modal('show');
    }

    $('#buscar').click(function() {
      if (!verificarForm('input[name=fecha]')) {return false;}
      indicadores();
    });

    $('#crear').click(function() {
      if (!verificarForm('#creacion input')) {return false;}
      $.post("datos/indicadores/crear-indicadores.php", $('#creacion').serialize())
      .done(function( data ) {
        mensajes(data);
      });
    });

    $('#guardar').click(function() {
      if (!verificarFormModal('#indicadores input, #indicadores select')) {return false;}
      $.post("datos/indicadores/crear-indicadores.php", $('#indicadores').serialize())
      .done(function( data ) {
        mensajesModal(data);
      });
    });

    function obtenerTablas(){
      $('table.table').DataTable()
      .columns.adjust()
      .responsive.recalc();
    }

    $('#modal').on('hidden.bs.modal', function (e) {
      $('#modal form').each(function() { this.reset() });
      $(".mensaje-modal").empty();
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
          $(".mensaje").show();
          x=false;
        }
        return x;
      });
      return x;
    }

    function mensajes(data) {
      if (data == "exito") {
        $(".mensaje").append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Exito!</strong> Se ingresaron los datos correctamente.</div>");
        $('form').trigger("reset");
        indicadores();
      } else if (data == "falta") {
        $(".mensaje").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Faltaron datos para la solicitud.</div>");
      } else if (data == "duplicado") {
        $(".mensaje").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Los indicadores para ese programa ya fueron creados.</div>");
      } else {
        $(".mensaje").append("<div class='alert alert-danger fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Error!</strong> Es probable que haya fallado el sistema.</div>");
        console.log(data);
      }
    }

    function mensajesModal(data) {
      if (data == "exito") {
        $(".mensaje-modal").append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Exito!</strong> Se ingresaron los datos correctamente.</div>");
        $('.modal form').trigger("reset");
        indicadores();
        setTimeout(function(){
          $('#modal').modal('hide');
        }, 1200);
      } else if (data == "falta") {
        $(".mensaje-modal").append("<div class='alert alert-warning fade show'>"+
          "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
          "<strong>Aviso!</strong> Faltaron datos para la solicitud.</div>");
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