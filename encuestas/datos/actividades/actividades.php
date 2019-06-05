<?php
require '../../../complementos/conexion.php';

if(!isset($_POST['fecha']) ){exit("falta");}
$fecha=date('Y/m/d', strtotime($_POST['fecha']));

$sql= '
SELECT  a.id_intervencion, CONCAT(l.nombre, " ", l.direccion, ", Colonia ", l.colonia, ", Zona ", l.zona)as direccion,
l.nombre, a.descripcion, a.estatus,
(CASE 
	WHEN a.programa="Dispensario Movil" THEN (SELECT COUNT(*) FROM calidad_dispensario c WHERE c.id_intervencion = a.id_intervencion)
	WHEN a.programa IN ("Cuenta Cuentos", "Valija Viajera") THEN (SELECT COUNT(*) FROM calidad_cuentos c WHERE c.id_intervencion = a.id_intervencion)
	WHEN a.programa="Mantenimiento" THEN (SELECT COUNT(*) FROM calidad_mantenimiento c WHERE c.id_intervencion = a.id_intervencion)
--
ELSE 0 END)encuestas
FROM intervencion a, lugar l
WHERE a.id_lugar = l.id_lugar AND DATE_FORMAT(a.planificacion_inicio, "%Y/%m/%d")=?
AND a.oficina=? AND a.programa=?;
';


$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}
mysqli_stmt_bind_param($query, 'sss', $fecha, $_POST['oficina'], $_POST['programa']);
$nombre=$_POST['programa'];


if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
$result = mysqli_stmt_get_result($query);
?>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
	<div class="card">
		<div class="header text-center text-white bg-primary">
			<h3><i class="fa fa-user-circle-o fa-fw"></i> <?=$nombre;?></h3>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Direccion</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Estatus</th>
						<th>Encuestas</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($fila = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?=$fila['id_intervencion']; ?></td>
							<td><?=$fila['direccion']; ?></td>
							<td><?=$fila['nombre']; ?></td>
							<td><?=$fila['descripcion']; ?></td>
							<td><?=$fila['estatus'] ?></td>
							<td><?=$fila['encuestas'] ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="Acciones">
									<button class="btn btn-primary" onclick="agregarEncuesta(this.value)" value=<?=$fila['id_intervencion'] ?> data-toggle="tooltip" title="Encuestas">
										<i class="fa fa-fw fa-comments"></i>
									</button>
								</div>
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
mysqli_close( $mysqli );
?>