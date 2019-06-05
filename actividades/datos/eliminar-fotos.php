<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if(!isset($_POST['id']) ){exit("falta");}
$id=$_POST['id'];

$sql= "SELECT extension FROM foto WHERE id_foto=?;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'i', $id);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
mysqli_stmt_bind_result($query, $extension);
mysqli_stmt_fetch($query);

$carpeta = "../fotos/";
$archivo = $carpeta.$id.".".$extension;

mysqli_stmt_close( $query);

$sql= "DELETE FROM foto WHERE id_foto=?;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'i', $id);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}

if (file_exists($archivo)) {
	unlink( $archivo);
} else {
	exit('no existe');
}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );

echo "exito";
?>
