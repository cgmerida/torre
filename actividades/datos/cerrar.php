<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if (!isset($_POST['fecha']) || !isset($_POST['fecha_fin']) || !isset($_POST['respuesta']) || !isset($_POST['id_intervencion'])) {
	exit("falta");
}
$id=$_POST['id_intervencion'];
$sql= "UPDATE intervencion SET fecha_realizado=?, fecha_terminado=?, respuesta=?, estatus=? WHERE id_intervencion=?";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

$fecha_realizado=date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$fecha_terminado=date('Y-m-d H:i:s', strtotime($_POST['fecha_fin']));
$respuesta=$_POST['respuesta'];
$estatus='Realizado';

mysqli_stmt_bind_param($query, 'ssssi', $fecha_realizado, $fecha_terminado, $respuesta, $estatus, $id);
if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>