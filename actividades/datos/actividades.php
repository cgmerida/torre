<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';

if(!isset($_POST['fecha']) ){exit("falta");}
$fecha=date('Y/m/d', strtotime($_POST['fecha']));

$sql= '
SELECT  a.id_intervencion, CONCAT(l.direccion, ", Colonia ", l.colonia, ", Zona ", l.zona)as direccion, l.nombre, a.descripcion, a.programa, a.estatus
FROM intervencion a, lugar l
WHERE a.id_lugar = l.id_lugar AND DATE_FORMAT(a.planificacion_inicio, "%Y/%m/%d")=?;
';

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 's', $fecha); 
$nombre="Fecha de creación: ".date('d/m/Y', strtotime($fecha) );
if (!empty($_POST['oficina'])) {
	$sql= '
	SELECT  a.id_intervencion, CONCAT(l.direccion, ", Colonia ", l.colonia, ", Zona ", l.zona)as direccion, l.nombre, a.descripcion, a.programa, a.estatus
	FROM intervencion a, lugar l
	WHERE a.id_lugar = l.id_lugar AND DATE_FORMAT(a.planificacion_inicio, "%Y/%m/%d")=?
	AND a.oficina=?;';


	$query = mysqli_prepare($mysqli, $sql);
	if ( !$query ) {
		die( 'Error en query: '.mysqli_error($mysqli) );
	}
	mysqli_stmt_bind_param($query, 'ss', $fecha, $_POST['oficina']);
	$nombre=$_POST['oficina'];

	if (!empty($_POST['sub-oficina'])) {
		$sql= '
		SELECT  a.id_intervencion, CONCAT(l.direccion, ", Colonia ", l.colonia, ", Zona ", l.zona)as direccion, l.nombre, a.descripcion, a.programa, a.estatus
		FROM intervencion a, lugar l
		WHERE a.id_lugar = l.id_lugar AND DATE_FORMAT(a.planificacion_inicio, "%Y/%m/%d")=?
		AND a.oficina=? AND a.sub=?; ';


		$query = mysqli_prepare($mysqli, $sql);
		if ( !$query ) {
			die( 'Error en query: '.mysqli_error($mysqli) );
		}

		mysqli_stmt_bind_param($query, 'sss', $fecha, $_POST['oficina'], $_POST['sub-oficina']);
		$nombre=$_POST['sub-oficina'];


		if (!empty($_POST['programa'])) {
			$sql= '
			SELECT  a.id_intervencion, CONCAT(l.direccion, ", Colonia ", l.colonia, ", Zona ", l.zona)as direccion, l.nombre, a.descripcion, a.programa, a.estatus
			FROM intervencion a, lugar l
			WHERE a.id_lugar = l.id_lugar AND DATE_FORMAT(a.planificacion_inicio, "%Y/%m/%d")=?
			AND a.oficina=? AND a.sub=? AND a.programa=?; ';


			$query = mysqli_prepare($mysqli, $sql);
			if ( !$query ) {
				die( 'Error en query: '.mysqli_error($mysqli) );
			}
			mysqli_stmt_bind_param($query, 'ssss', $fecha, $_POST['oficina'], $_POST['sub-oficina'], $_POST['programa']);
			$nombre=$_POST['programa'];
		}

	}

}


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
						<th>Programa</th>
						<th>Estatus</th>
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
							<td><?=$fila['programa']; ?></td>
							<td><?=$fila['estatus']; ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="Acciones">
									<button class="btn btn-primary" onclick="func_foto(this.value)" value=<?=$fila['id_intervencion'] ?> data-toggle="tooltip" title="Fotos">
										<i class="fa fa-fw fa-file-image-o"></i>
									</button>
									<button class="btn btn-warning" onclick="func_editar(this.value)" value=<?=$fila['id_intervencion'] ?> data-toggle="tooltip" title="Editar">
										<i class="fa fa-fw fa-pencil"></i>
									</button>
									<?php
									if ($fila['estatus']=="Agendado") {
										?>
										<button class="btn btn-success" onclick="func_cerrar(this.value)" value=<?=$fila['id_intervencion'] ?> data-toggle="tooltip" title="Cerrar">
											<i class="fa fa-fw fa-check"></i>
										</button>
										<?php
									}
									?>
									<button class="btn btn-danger" onclick="func_eliminar(this.value)" value=<?=$fila['id_intervencion'] ?> data-toggle="tooltip" title="Eliminar">
										<i class="fa fa-fw fa-trash"></i>
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
