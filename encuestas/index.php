<?php
require_once '../complementos/require.php';
$pagina='Encuestas';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/es.js'></script>

  <link rel="stylesheet" href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.css">
  <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js" defer></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-es_ES.js" defer></script>

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
        <h1 class="display-3 text-center">Encuestas</h1>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header text-center text-white bg-primary">
              <h2 class="modal-title m-0" id="modal-title"><i class="fa fa-fw fa-pencil"></i> Editar</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="dispensario-movil" style="display: none;">
                <form name="dispensario-movil">
                  <input type="hidden" name="id_intervencion">

                  <div class="form-group">
                    <label for="edad" class="form-control-label">Edad: </label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-user fa-fw"></i>
                      <input type="number" id="edad" name="edad" class="form-control" placeholder="Edad">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="sexo" class="form-control-label">Sexo: </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input type="radio" name="sexo" value="Masculino">
                          Masculino
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input type="radio" name="sexo" value="Femenino">
                          Femenino
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg1" class="form-control-label">1. ¿Se enteró o conoce de la jornada médica del Dispensario Movil que se realizó en su barrio o Colonia? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="si">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="no">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg2" class="form-control-label">2. ¿Que institución es la que promueve los Dispensarios Moviles para que atiendan a los vecinos de su barrio o colonia?  </label>
                    <div class="row">
                      <div class="col-md-5">
                        <label>
                          <input name="preg2" type="radio" value="La Municipalidad de Guatemala" onclick="$('input[name=preg2-otro]').attr('disabled', false).val('');">
                          La Municipalidad de Guatemala
                        </label>
                      </div>
                      <div class="col-md-2">
                        <label>
                          <input name="preg2" type="radio" value="Otro" onclick="$('input[name=preg2-otro]').attr('disabled', false);">
                          Otro
                        </label>
                      </div>
                      <div class="col-md-5">
                        <div class="inner-addon left-addon">
                          <i class="fa fa-building fa-fw"></i>
                          <input name="preg2-otro" class="form-control opcional" placeholder="Otro:" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg3" class="form-control-label">3. ¿Usted o alguien de su familia recibió los servicios del Dispensario Movil de la Municipalidad de Guatemala?</label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg4" class="form-control-label">4. ¿Cuál es su grado de satisfacción con la jornada medica del Dispensario Movil de la Municipalidad de Guatemala?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg4">
                        <option value="" hidden>Seleccione un grado de satisfacción</option>
                        <option value=5>Muy Satisfecho</option>
                        <option value=4>Satisfecho</option>
                        <option value=2>Poco Satisfecho</option>
                        <option value=0>Nada Satisfecho</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg5" class="form-control-label">5. ¿Por qué opina así?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg5" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg6" class="form-control-label">6. Si usted tuviera que calificar el servicio medico que le brindaron los Doctores del Dispensario Movil, ¿Cómo lo calificaría?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg6">
                        <option value="" hidden>Seleccione una calificación</option>
                        <option value=6>Buena</option>
                        <option value=3>Regular</option>
                        <option value=0>Mala</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg7" class="form-control-label">7. ¿Por qué la califica así?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg7" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg8" class="form-control-label">8. ¿Cómo califica la amabilidad y atención de los médicos que le atendieron en el Dispensario Movil?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg8">
                        <option value="" hidden>Seleccione una calificación</option>
                        <option value=5>Buena</option>
                        <option value=3>Regular</option>
                        <option value=0>Mala</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg9" class="form-control-label">9. ¿Por qué la califica así?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg9" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg10" class="form-control-label">10. ¿Cómo se entero que el Dispensario Movil llegaría a su barrio o colonia?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg10">
                        <option value="" hidden>Seleccione un medio</option>
                        <option>Volantes</option>
                        <option>Afiches</option>
                        <option>Llamadas</option>
                        <option>Altavoz</option>
                        <option>Vecinos</option>
                        <option>Otro</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg11" class="form-control-label">11. ¿El personal que llegó del Dispensario se encontraba debidamente identificado?</label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg11" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg11" type="radio" value="0">
                          No
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg11" type="radio" value="0">
                          No le puse atención
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg12" class="form-control-label">12. ¿Cómo califica esta actividad que realiza el Dispensario Movil en su barrio o colonia par aprevenir enfermedades?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg12">
                        <option value="" hidden>Seleccione una calificación</option>
                        <option value=2>Buena</option>
                        <option value=1>Regular</option>
                        <option value=0>Mala</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg13" class="form-control-label">13. ¿Por qué opina así?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg13" class="form-control opcional">
                    </div>
                  </div>
                  <hr>

                </form>
              </div>

              <div class="cuenta-cuentos"  style="display: none;">
                <form name="cuenta-cuentos">
                  <input type="hidden" name="id_intervencion">

                  <div class="form-group">
                    <label for="director" class="form-control-label">Nombre del Director</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-male fa-fw"></i>
                      <input type="text" name="director" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telefono" class="form-control-label">Telefono del Director</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-mobile fa-fw"></i>
                      <input type="number" name="telefono" class="form-control" min="8" max="8">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg1" class="form-control-label">1. ¿Se realizó la actividad? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg2" class="form-control-label">2. ¿Por qué <b>NO</b> se realizo la actividad?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg2" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg3" class="form-control-label">3. ¿Se realizó la actividad en la fecha planificada? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg4" class="form-control-label">4. ¿Por qué <b>NO</b> se realizo la actividad en la fecha planificada?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg4" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg5" class="form-control-label">5. ¿Se realizó la actividad en el horario establecido? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg5" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg5" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg6" class="form-control-label">6. ¿Por qué <b>NO</b> se realizo la actividad en el horario establecido?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg6" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg7" class="form-control-label">7. ¿Se generó el listado de asistencia de alumnos a la actividad? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg7" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg7" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg8" class="form-control-label">8. ¿Por qué <b>NO</b> Se generó el listado de asistencia de alumnos a la actividad?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg8" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg9" class="form-control-label">9. ¿Cúal es la meta establecida de aistencia de alumnos?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list-ol fa-fw"></i>
                      <input type="number" name="preg9" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg10" class="form-control-label">10. ¿Se llego a la meta establecida de alumnos? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg10" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg10" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg11" class="form-control-label">11. ¿Por qué <b>NO</b> se llego a la meta establecida de alumnos?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg11" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg12" class="form-control-label">12. ¿Cuantas personas asistieron a la actividad?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg12">
                        <option value="" hidden>Seleccione cantidad de asistentes</option>
                        <option value=0>0 a 5 personas</option>
                        <option value=2>6 a 10 personas</option>
                        <option value=3>11 a 15 personas</option>
                        <option value=4>16 a 25 personas</option>
                        <option value=5>Más de 25</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg13" class="form-control-label">13. ¿Se ingresaron fotografías de la actividad al sistema para su control? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg13" type="radio" value="Si">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg13" type="radio" value="No">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg14" class="form-control-label">14. ¿Por qué <b>NO</b> se ingresaron fotografías de la actividad al sistema?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg14" class="form-control opcional">
                    </div>
                  </div>
                  <hr>

                </form>
              </div>

              <div class="mantenimiento" style="display: none;">
                <form name="mantenimiento">
                  <input type="hidden" name="id_intervencion">
                  <hr>
                  <div class="form-group">
                    <label for="preg1" class="form-control-label">1. ¿Se realizó la actividad en la fecha establecida? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="Si">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg1" type="radio" value="No">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg2" class="form-control-label">2. ¿Por qué <b>NO</b> se realizo la actividad en la fecha establecida?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg2" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg3" class="form-control-label">3. ¿Se completo el área verde en el sector? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="4">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg3" type="radio" value="2">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg4" class="form-control-label">4. ¿Por qué <b>NO</b> se completo el área verde en el sector?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg4" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg5" class="form-control-label">5. ¿Cúales fueron las actividades necesarias para dar mantenimiento en el sector?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control selectpicker opcional" name="preg5[]" multiple title="Seleccione los trabajos" data-selected-text-format="count > 3" data-live-search=true>
                        <?php 
                        require '../complementos/conexion.php';

                        $sql= "
                        SELECT id, proceso 
                        FROM trabajos_jardines;
                        ";

                        $query = mysqli_prepare($mysqli, $sql);
                        if ( !$query ) {
                          die( 'Error en query: '.mysqli_error($mysqli) );
                        }

                        if( mysqli_stmt_execute($query) === false) {
                          exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
                        }

                        $result = mysqli_stmt_get_result($query);
                        while ($fila = mysqli_fetch_assoc($result)) {
                          ?>
                          <option value=<?=$fila['id'];?> ><?=$fila['proceso'];?></option>
                          <?php
                        }
                        mysqli_stmt_close( $query);
                        mysqli_free_result($result);
                        ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg6" class="form-control-label">6. ¿Cúales fueron las plantas necesarias para dar mantenimiento en el sector?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control selectpicker opcional" name="preg6[]" multiple title="Seleccione las plantas" data-selected-text-format="count > 3" live-search=true>
                        <?php 

                        $sql= "
                        SELECT id_planta, planta 
                        FROM plantas;
                        ";

                        $query = mysqli_prepare($mysqli, $sql);
                        if ( !$query ) {
                          die( 'Error en query: '.mysqli_error($mysqli) );
                        }

                        if( mysqli_stmt_execute($query) === false) {
                          exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
                        }

                        $result = mysqli_stmt_get_result($query);
                        while ($fila = mysqli_fetch_assoc($result)) {
                          ?>
                          <option value=<?=$fila['id_planta'];?> ><?=$fila['planta'];?></option>
                          <?php
                        }
                        mysqli_stmt_close( $query);
                        mysqli_free_result($result);
                        mysqli_close( $mysqli );
                        ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg7" class="form-control-label">7. ¿Se recibio todo el apoyo de material y plantas necesarias para el mantenimiento?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg7">
                        <option value="" hidden>Seleccione una respuesta</option>
                        <option value=5>Se recibio todo el material y plantas</option>
                        <option value=3>Solo se recibió las plantas</option>
                        <option value=3>Solo se recibió el material</option>
                        <option value=0>No se recibó ningun apoyo</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg8" class="form-control-label">8. ¿Por qué <b>NO</b> se recibio todo el apoyo de material y plantas necesarias para el mantenimiento?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg8" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg9" class="form-control-label">9. ¿Se realizo de forma eficiente la reproducción de plantas? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg9" type="radio" value="4">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg9" type="radio" value="2">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg10" class="form-control-label">10. ¿Por qué <b>NO</b> se realizo de forma eficiente la reproducción de plantas?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg10" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg11" class="form-control-label">11. ¿Cúal es la calificación del impacto visual?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-list fa-fw"></i>
                      <select class="form-control" name="preg11">
                        <option value="" hidden>Seleccione una respuesta</option>
                        <option value=5>Excelente</option>
                        <option value=4>Bueno</option>
                        <option value=3>Regular</option>
                        <option value=2>Malo</option>
                        <option value=1>Muy Malo</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg12" class="form-control-label">12. ¿Se obtuvieron fotografías del antes y del despues de la actividad? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg12" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg12" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg13" class="form-control-label">13. ¿Por qué <b>NO</b> se obtuvieron fotografías del antes y del despues de la actividad?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg13" class="form-control opcional">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                  <label for="preg14" class="form-control-label">14. ¿Se colocó imagen MUNICIPAL en el lugar? </label>
                    <div class="row">
                      <div class="col-md-4">
                        <label>
                          <input name="preg14" type="radio" value="1">
                          Si
                        </label>
                      </div>
                      <div class="col-md-4">
                        <label>
                          <input name="preg14" type="radio" value="0">
                          No
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="preg15" class="form-control-label">15. ¿Por qué <b>NO</b> se colocó imagen MUNICIPAL en el lugar?</label>
                    <div class="inner-addon left-addon">
                      <i class="fa fa-question fa-fw"></i>
                      <input type="text" name="preg15" class="form-control opcional">
                    </div>
                  </div>
                  <hr>

                </form>
              </div>

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

      <div class="content">
        <div class="container-fluid">
          <!-- CONTENIDO -->

          <div class="col-md-12">

            <form id="busqueda">
              <div class="row">
                <div class="col-md-4">
                  <h4 class="m-0">Fecha</h4>
                  <div class="input-group date" id="fecha-control" data-target-input="nearest">
                    <input placeholder="Fecha" name="fecha" tabindex="1" class="form-control datetimepicker-input" data-target="#fecha-control" readonly>
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
                    foreach ($grupos as $oficina => $programas){
                      echo '<optgroup label='.$oficina.'>';
                      foreach ($programas as $programa){
                        echo '<option>'.$programa.'</option>';
                      }
                      echo '</optgroup>';
                    }

                    ?>
                  </select>
                </div>

              </form>
            </div>
          </div>
          <center>
            <button class="btn btn-info mt-2" id="buscar">
              Buscar <i class="fa fa-search fa-fw" aria-hidden="true"></i>
            </button>
          </center>
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
  
    $(function() {
      $('#fecha-control').datetimepicker({
        format: 'YYYY/MM/DD',
        ignoreReadonly: true,
        locale: 'es'
      });
    });

    $('#buscar').click(function() {
      if (!verificarForm('#busqueda :input')) {return false;}
      var formData = $('#busqueda').serializeArray();
      var oficina = $('#programa :selected').closest('optgroup').attr('label');
      formData.push({ name: "oficina", value: oficina });
      $.post("datos/actividades/actividades.php", formData)
      .done(function(data){
        $('#tablas').html(data);
        obtenerTablas();
      });
    });

    function agregarEncuesta(id) {
      var programa = $('#programa').val().replace(/ /g, "-").toLowerCase();
      programa = (programa=="valija-viajera")? "cuenta-cuentos": programa;
      $('.modal-header').removeClass().addClass("modal-header text-center text-white bg-primary");
      $('.modal-title').html('<i class="fa fa-fw fa-comments"></i> Encuesta');
      $('#guardar').removeClass().addClass("btn btn-primary");
      $('#modal').modal('show');
      $('.' + programa).show();
      $('.' + programa + ' input[name=id_intervencion]').val(id);
    }

    
    $('#guardar').click(function(){
      var form = $("#modal form:visible");
      var formData = new FormData( form[0] );

      if(!verificarFormModal("#modal form:visible :input")){return 0;}
      $.ajax({
        url: "datos/encuestas/"+form.attr('name')+".php",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(data){
        mensajesModal(data);
      });

    });


    $('#modal').on('hidden.bs.modal', function (e) {
      $('.modal-body > div').hide();
      $(".selectpicker").val('default').selectpicker("refresh");
      $('#modal form').each(function() { this.reset() });
      $(".mensaje-modal").empty();
    });

    function obtenerTablas(){
      $('table.table').DataTable()
      .columns.adjust()
      .responsive.recalc();
      $('[data-toggle="tooltip"]').tooltip();
    }



    function verificarForm(form) {
      var x=true;
      $(form).not( $(".bootstrap-select :input, .opcional") ).each(function() {
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

      $(form).not( $(".bootstrap-select :input, .opcional") ).each(function() {
        if( !$(this).val() || (this.type === 'radio' && $('input[name='+this.name+']:checked').length == "0") ){
          $(".mensaje-modal").append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'
            +'<strong>Error!</strong> Ingrese ' + $(this).attr('name') + '.'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span></button></div>');
          $(".mensaje").show();
          console.error($(this));
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