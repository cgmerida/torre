<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';

if(!isset($_POST['zona']) || !isset($_POST['colonia']) ){exit("falta");}
$zona=$_POST['zona'];$colonia=$_POST['colonia'];

$sql= '
SELECT l.id_lugar, l.zona, l.colonia, l.direccion,
l.nombre, l.mts, COUNT( i.id_intervencion)actividades
FROM lugar l LEFT JOIN intervencion i ON l.id_lugar = i.id_lugar
WHERE l.zona=? AND l.colonia=?
GROUP BY l.id_lugar;
';

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'is', $zona, $colonia); 
$nombre="Colonia ".$colonia.", Zona ".$zona;

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
						<th>Zona</th>
						<th>Colonia</th>
						<th>Dirección</th>
						<th>Nombre</th>
						<th>Metros</th>
						<th>Actividades</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php

					while ($fila = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?=$fila['id_lugar']; ?></td>
							<td><?=$fila['zona']; ?></td>
							<td><?=$fila['colonia']; ?></td>
							<td><?=$fila['direccion']; ?></td>
							<td><?=$fila['nombre']; ?></td>
							<td><?=$fila['mts']; ?></td>
							<td><?=$fila['actividades']; ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="Acciones">
									<button class="btn btn-secondary" onclick="verActividades(this.value)" value=<?=$fila['id_lugar'] ?> data-toggle="tooltip" title="ver actividades">
										<i class="fa fa-fw fa-eye"></i>
									</button>
									<button class="btn btn-primary" onclick="agregarActividad(this.value)" value=<?=$fila['id_lugar'] ?> data-toggle="tooltip" title="Nueva Actividad">
										<i class="fa fa-fw fa-plus-circle"></i>
									</button>
									<button class="btn btn-warning" onclick="editarLugar(this.value)" value=<?=$fila['id_lugar'] ?> data-toggle="tooltip" title="Editar">
										<i class="fa fa-fw fa-pencil"></i>
									</button>
									<button class="btn btn-danger" onclick="eliminarLugar(this.value)" value=<?=$fila['id_lugar'] ?> data-toggle="tooltip" title="Eliminar">
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
