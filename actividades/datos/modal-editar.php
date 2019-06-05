<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
header("Content-Type: text/html; charset=utf-8");

if ( !isset($_POST['id']) ) {exit("error");}

$sql="
SELECT  a.id_intervencion, l.direccion, l.colonia, l.zona, a.descripcion
FROM intervencion a, lugar l
WHERE a.id_lugar = l.id_lugar AND a.id_intervencion=?;
";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {die( 'Error en query: '.mysqli_error($mysqli) );}

mysqli_stmt_bind_param($query, 'i', $_POST['id']);

if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}
$result = mysqli_stmt_get_result($query);
while($row = mysqli_fetch_object($result)) {
  ?>

  <input type="hidden" name="id_intervencion" value=<?=$row->id_intervencion;?> >

  <div class="form-group">
    <label for="zona" class="form-control-label">Zona: </label>
    <div class="inner-addon left-addon">
      <i class="fa fa-globe fa-fw"></i>
      <select id="zona" onchange="this.name='zona';colonias(this.value);" class="form-control" >
        <option hidden selected><?=$row->zona;?></option>
        <option>17</option>
        <option>18</option>
        <option>24</option>
        <option>25</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="colonia" class="form-control-label">Colonia: </label>
    <div class="inner-addon left-addon">
      <i class="fa fa-map-marker fa-fw"></i>
      <select id="colonia" onchange="this.name='colonia';" class="form-control selectpicker"  data-live-search='true'>
        <option hidden selected><?=$row->colonia;?></option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="direccion" class="form-control-label">Dirección: </label>
    <div class="inner-addon left-addon">
      <i class="fa fa-street-view fa-fw"></i>
      <input id="direccion" onchange="this.name='direccion';" readonly onfocus="this.readOnly='';" onblur="this.readOnly='readonly';" class="form-control" value="<?=$row->direccion;?>">
    </div>
  </div>

  <div class="form-group">
    <label for="descripcion" class="form-control-label">Descripción: </label>
    <div class="inner-addon left-addon">
      <i class="fa fa-list-ol fa-fw"></i>
      <input id="descripcion" onchange="this.name='descripcion';" readonly onfocus="this.readOnly='';" onblur="this.readOnly='readonly';" class="form-control" value="<?=$row->descripcion;?>">
    </div>
  </div>

  <?php
}
mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
