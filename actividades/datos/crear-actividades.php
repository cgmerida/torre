<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';

$mysqli->autocommit(FALSE);
date_default_timezone_set('America/Guatemala');
if( !isset($_POST['id_usuario']) || !isset($_POST['zona']) || !isset($_POST['direccion']) || !isset($_POST['lat']) || !isset($_POST['lng']) || !isset($_POST['fecha']) || !isset($_POST['fecha_fin']) || !isset($_POST['descripcion']) || !isset($_POST['oficina']) || !isset($_POST['sub-oficina']) || !isset($_POST['programa']) ){
	exit("falta") ;
}
$zona=$_POST['zona'];
$colonia=(!isset($_POST['colonia']))? null: $_POST['colonia'];
$direccion=$_POST['direccion'];
$nombre=$_POST['nombre'];
$mts=($_POST['metros']==0)? null: $_POST['metros'];
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$id_usuario=$_POST['id_usuario'];

$sql= "INSERT INTO lugar(zona, colonia, direccion, nombre, mts, lat, lng, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

mysqli_stmt_bind_param($query, 'isssiddi', $zona, $colonia, $direccion, $nombre, $mts, $lat, $lng, $id_usuario);
if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}
$id_lugar = mysqli_insert_id($mysqli);
mysqli_stmt_close( $query);

// AGREGAR INTERVENCION
$sql= "INSERT INTO intervencion(id_lugar, fecha_creacion, planificacion_inicio, planificacion_fin, descripcion, oficina, sub, programa, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	$mysqli->rollback();
	exit( 'Error en query: '.mysqli_error($mysqli) );
}

$fecha_creacion=date('Y-m-d');
$planificacion_inicio=date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$planificacion_fin=date('Y-m-d H:i:s', strtotime($_POST['fecha_fin']));
$descripcion=$_POST['descripcion'];
$oficina=$_POST['oficina'];
$sub=$_POST['sub-oficina'];
$programa=$_POST['programa'];
$estatus='Agendado';

mysqli_stmt_bind_param($query, 'issssssss', $id_lugar, $fecha_creacion, $planificacion_inicio, $planificacion_fin, $descripcion, $oficina, $sub, $programa, $estatus);
if( mysqli_stmt_execute($query) === false) {
	$mysqli->rollback();
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
$mysqli->commit();
mysqli_stmt_close( $query);


mysqli_close( $mysqli );
exit("exito");
?>
