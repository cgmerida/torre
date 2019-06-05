<?php
require_once '../complementos/require.php';
$pagina='Ingreso de Actividades';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '../pagina/header.php';?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js" async></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCH5jx8cbDO-sfqwcYUO8l-_qk-cfJ8jg" defer></script>
  <script src="../dist/js/mapasIngreso.js" defer></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/es.js' defer></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  
  <!-- Latest compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"> -->
  <!-- Latest compiled and minified JavaScript -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-es_ES.min.js"></script> -->

  <script type="text/javascript" src="js/ingreso-actividades.js" defer></script>

  <link rel="stylesheet" href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.css">
  <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js" defer></script>
</head>

<body>

  <div class="modal fade" id="myMapModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 0; margin: 0;">
          <div id="googleMap" style="width: 100%;min-height: 70vh;height: 100%;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="posicion" data-dismiss="modal">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper">
    <?php include_once '../pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once '../pagina/navbar.php'; ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Ingresar</h4>
                </div>
                <div class="card-body">

                  <form>
                    <input type="hidden" id="id_usuario" name="id_usuario" value=<?=$userid;?> >
                    <div class="row">
                      <div class="col-md-3 pr-1">
                        <div class="form-group">
                          <label for="zona">Zona</label>
                          <select class="form-control" tabindex="1" id="zona" name="zona">
                            <option value="" selected hidden>Seleccione una zona</option>
                            <option>17</option>
                            <option>18</option>
                            <option>24</option>
                            <option>25</option>
                            <option>otra</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label>Colonia</label><br> 
                          <select class="selectpicker" id="colonia" name="colonia" data-live-search='true' tabindex="2" title="Seleccione Colonia">
                          </select>
                        </div>
                      </div>
                      <div class="col-md-5 pl-1">
                        <div class="form-group">
                          <label for="direccion">Dirección</label>
                          <input class="form-control" placeholder="Lugar de la actividad?" id="direccion" name="direccion" tabindex="3">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5 pr-1">
                        <div class="form-group">
                          <label for="nombre">Nombre (opcional)</label>
                          <input class="optional form-control" id="nombre" name="nombre" tabindex="4" placeholder="Nombre del parque o Escuela" >
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>Metros (Jardines)</label>
                          <input class="optional form-control" type="number" id="metros" name="metros" tabindex="5"  placeholder="Metros Cuadrados del Area" >
                        </div>
                      </div>
                      <div class="col-md-3 pl-1">
                        <div class="form-group">
                          <label for="ubicacion" tabindex="6"> Ubicación</label><br>
                          <button type="button" id="ubicacion" class="btn btn-info" data-toggle="modal" data-target="#myMapModal" onclick="openMap();">
                            <i class="fa fa-map-marker fa-fw"></i>Ingrese ubicación
                          </button>
                          <input type="hidden" id="lat" name="lat">
                          <input type="hidden" id="lng" name="lng">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Fecha inicio planificada</label>

                          <div class="input-group date" id="fecha" data-target-input="nearest">
                            <input placeholder="Fecha y hora de inicio"  name="fecha" tabindex="7" class="form-control datetimepicker-input" data-target="#fecha" readonly>
                            <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Fecha fin planificada</label>
                          <div class="input-group date" id="fecha_fin" data-target-input="nearest">
                            <input placeholder="Fecha y hora de fin" name="fecha_fin" tabindex="8" class="form-control datetimepicker-input" data-target="#fecha_fin" readonly>
                            <div class="input-group-append" data-target="#fecha_fin" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Descripción</label>
                          <input id="descripcion" name="descripcion" tabindex="9"  class="form-control" placeholder="Informacion de la actividad" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Oficina</label>
                          <select class="form-control" tabindex="10" id="oficina" name="oficina">
                            <option value="" selected>Seleccione una opcion</option>
                            <option>Jardines</option>
                            <option>Educa</option>
                          </select> 
                        </div>
                      </div>
                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label>Sub-Oficina</label>
                          <select class="form-control" tabindex="11" id="sub-oficina" name="sub-oficina">
                            <option value="" hidden>Seleccione una opcion</option>
                          </select> 
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>Programa</label>
                          <select class="form-control" tabindex="12" id="programa" name="programa">
                            <option value="" selected>Seleccione una opcion</option>
                          </select> 
                        </div>
                      </div>
                    </div>
                  </form>

                  <button type="submit" class="btn btn-primary pull-right mb-4" id="guardar">
                    <i class="fa fa-save fa-fw"></i> Guardar
                  </button>
                  <div class="clearfix"></div>
                  <div class="mensaje" style="display:none;"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /container-frluid -->
    </div>
  </div>
</body>
</html>