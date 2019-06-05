<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if(!isset($_POST['id']) ){exit("falta");}
$id=$_POST['id'];

$carpeta = "../actividades/fotos/";
$sql= 'SELECT id_foto, extension, nombre, descripcion, tipo FROM foto WHERE id_intervencion=?
ORDER BY FIELD(tipo, "Antes", "Proceso", "Despues", "");';

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'i', $id);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
mysqli_stmt_bind_result($query, $id_foto, $extension, $nombre, $descripcion, $tipo);

mysqli_stmt_store_result($query);

if(mysqli_stmt_num_rows($query)>0){
	?>
	<button class="btn btn-primary btn-lg btn-block" id="btn-fotos"><i class="fa fa-fw fa-camera-retro"></i> Ver Fotos</button>
	<?php
	while (mysqli_stmt_fetch($query)) {
		?>
		<a href=<?=$carpeta.$id_foto.".".$extension;?> data-fancybox="fotos" style="display: none;">
			<div class="row">
				<div class="col-md-2">
					<strong>Tipo: </strong><?=($tipo)? $tipo : 'Ninguno';?>
				</div>
				<div class="col-md-4">
					<strong>Nombre: </strong><?=$nombre;?>
				</div>
				<div class="col-md-4">
					<strong>Descripción: </strong><?=$descripcion;?>
				</div>
				<div class="col-md-2">
					<button value=<?=$id_foto;?> class="btn btn-danger" onclick="eliminarFoto(this.value);" ><i class="fa fa-trash fa-fw"></i> Eliminar</button>
				</div>
			</div>
		</a>
		<?php
	}
}


mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
