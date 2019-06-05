<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'spanish');

if(empty($_POST['fecha']) ){
	$fecha = date("Y/m/d");
} else {
	$fecha = htmlspecialchars($_POST['fecha']."/1");
}

$wheres=array();
if (!empty($_POST['programa'])) {
	$programa=htmlspecialchars($_POST['programa']);
	$wheres['programa']=$programa;
}

$sql= "
SELECT id_indicador, DATE_FORMAT(fecha,'%b %Y')mes, programa, meta, IFNULL(asistencia, 0)asistencia, IFNULL(calidad, 'Pendiente')calidad, IFNULL(programacion, 'Pendiente')progra
FROM indicadores WHERE MONTH(fecha)=MONTH('{$fecha}')
";

$sql.=" AND ";
if (count($wheres) != 0){
	foreach ($wheres as $columna => $valor){ $sql .= "{$columna}='{$valor}' AND ";}
}
$sql.=" 1=1;";

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
			<h3><i class="fa fa-compass fa-fw"></i> Indicadores </h3>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Mes</th>
						<th>Programa</th>
						<th>Meta de asistencia</th>
						<th>Asistencia</th>
						<th>Control de Calidad</th>
						<th>Programación</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($fila = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td><?=ucwords(strftime("%B %Y", strtotime($fila['mes']))); ?></td>
							<td><?=$fila['programa']; ?></td>
							<td><?=$fila['meta']; ?></td>
							<td><?=$fila['asistencia']; ?></td>
							<td><?=$fila['calidad']; ?></td>
							<td><?=$fila['progra']; ?></td>
							<td>
								<button class="btn btn-primary" onclick="agregarIndicador(this.value)" value=<?=$fila['id_indicador'] ?> data-toggle="tooltip" title="Agregar">
									<i class="fa fa-fw fa-plus"></i>
								</button>
							</td>
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
<?php
mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
