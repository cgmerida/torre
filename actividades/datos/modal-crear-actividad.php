<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if( !isset($_POST['id_lugar']) || !isset($_POST['fecha']) || !isset($_POST['fecha_fin']) || !isset($_POST['descripcion']) || !isset($_POST['oficina']) || !isset($_POST['sub-oficina']) || !isset($_POST['programa']) ){
	exit("falta") ;
}
// AGREGAR INTERVENCION
$sql= "INSERT INTO intervencion(id_lugar, fecha_creacion, planificacion_inicio, planificacion_fin, descripcion, oficina, sub, programa, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

$id_lugar=$_POST['id_lugar'];
$fecha_creacion=date('Y-m-d');
$planificacion_inicio=date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$planificacion_fin=date('Y-m-d H:i:s', strtotime($_POST['fecha_fin']));
$descripcion=$_POST['descripcion'];
$oficina=$_POST['oficina'];
$sub=$_POST['sub-oficina'];
$programa=$_POST['programa'];
$estatus='Agendado';

mysqli_stmt_bind_param($query, 'issssssss', $id_lugar, $fecha_creacion, $planificacion_inicio, $planificacion_fin, $descripcion, $oficina, $sub, $programa, $estatus);
if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}
mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>
