<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if(!isset($_POST['id_lugar']) ){exit("falta");}
$id=$_POST['id_lugar'];

$sql= "DELETE FROM lugar WHERE id_lugar=?;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'i', $id);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );

echo "exito";
?>
