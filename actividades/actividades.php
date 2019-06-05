<?php
require_once '../complementos/require.php';
$pagina='Actividades';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>

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

  <div class="wrapper">
    <?php include_once '../pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once '../pagina/navbar.php'; ?>

      <div class="jumbotron m-0">
        <h2 class="display-3 text-center">Actividades</h2>
      </div>

      <div class="content">
        <div class="container-fluid">
          <!-- CONTENIDO -->
          <input type="hidden" id="lugar" value=<?=$_GET['id'];?> >
          <div id="tablas">
            <?php
            require '../complementos/activo.php';
            require '../complementos/conexion.php';

            $lugar = $_GET['id'];
            $sql= "
            SELECT a.id_intervencion, CONCAT(l.direccion, ', Colonia ', l.colonia, ', Zona ', l.zona)as direccion,
            a.descripcion, a.programa, a.estatus,
            CASE 
            WHEN a.fecha_realizado IS NOT NULL THEN a.fecha_realizado
            ELSE a.planificacion_inicio
            END inicio,
            CASE
            WHEN a.fecha_terminado IS NOT NULL THEN a.fecha_terminado
            ELSE a.planificacion_fin
            END fin
            FROM intervencion a, lugar l
            WHERE a.id_lugar = l.id_lugar AND l.id_lugar={$lugar} ;
            ";

            $query = mysqli_prepare($mysqli, $sql);
            if ( !$query ) {
              die( 'Error en query: '.mysqli_error($mysqli) );
            }

            if( mysqli_stmt_execute($query) === false) {
              exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
            }

            $result = mysqli_stmt_get_result($query);
            ?>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
              <div class="card">
                <div class="header text-center text-white bg-primary">
                  <h3><i class="fa fa-user-circle-o fa-fw"></i> Actividades</h3>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Direccion</th>
                        <th>Descripcion</th>
                        <th>Programa</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      while ($fila = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                          <td><?=$fila['id_intervencion']; ?></td>
                          <td><?=$fila['inicio']; ?></td>
                          <td><?=$fila['fin']; ?></td>
                          <td><?=$fila['direccion']; ?></td>
                          <td><?=$fila['descripcion']; ?></td>
                          <td><?=$fila['programa']; ?></td>
                          <td><?=$fila['estatus']; ?></td>
                        </tr>
                        <?php
                      }
                      mysqli_free_result($result);
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /container-fluid -->
      </div><!-- /content -->
    </div><!-- /main-panel -->
  </div><!-- /wrapper -->
  <script type="text/javascript">

    $(document).ready(function(){
      tablasEsp();
      obtenerTablas();
    });

    function obtenerTablas(){
      $('table.table').DataTable()
      .columns.adjust()
      .responsive.recalc();
    }

    function tablasEsp() {
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
    }
  </script>
</body>
</html>