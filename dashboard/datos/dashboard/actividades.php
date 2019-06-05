<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

if(!isset($_GET['oficina']) || !isset($_GET['fecha']) ){exit("falta");}
$fecha = htmlspecialchars($_GET['fecha']);
$oficina = htmlspecialchars($_GET['oficina']);

$wheres=array();
if (!empty($_GET['sub'])) {
	$sub=htmlspecialchars($_GET['sub']);
	$wheres['sub']=$sub;
}
if (!empty($_GET['programa'])) {
	$programa=htmlspecialchars($_GET['programa']);
	$wheres['programa']=$programa;
}


$sql="";
if ($fecha == 'Todo') {
	$sql= "
	SELECT i.id_intervencion id, i.descripcion, i.respuesta, 
	CASE 
	WHEN i.fecha_realizado  IS NOT NULL THEN DATE_FORMAT(i.fecha_realizado, '%d/%m/%Y %r')
	ELSE DATE_FORMAT(i.planificacion_inicio, '%d/%m/%Y %r')
	END fecha,
	CASE
	WHEN i.fecha_terminado IS NOT NULL THEN DATE_FORMAT(i.fecha_terminado, '%d/%m/%Y %r')
	ELSE DATE_FORMAT(i.planificacion_fin, '%d/%m/%Y %r')
	END fin,
	i.programa, l.direccion, l.colonia, l.zona,
	l.lat, l.lng, l.mts, i.estatus
	FROM intervencion i, lugar l
	WHERE i.id_lugar = l.id_lugar AND i.oficina='{$oficina}'
	";
} else {
	$fecha = date("Y/m/d", mktime(0, 0, 0, $fecha, 1, date("Y")));
	$rango = intval($_GET['rango']);
	$tiempo = "i.planificacion_inicio BETWEEN '{$fecha}' AND DATE_ADD('{$fecha}', INTERVAL $rango MONTH) - INTERVAL 1 DAY";

	$sql= "
	SELECT i.id_intervencion id, i.descripcion, i.respuesta, 
	CASE 
	WHEN i.fecha_realizado  IS NOT NULL THEN DATE_FORMAT(i.fecha_realizado, '%d/%m/%Y %r')
	ELSE DATE_FORMAT(i.planificacion_inicio, '%d/%m/%Y %r')
	END fecha,
	CASE
	WHEN i.fecha_terminado IS NOT NULL THEN DATE_FORMAT(i.fecha_terminado, '%d/%m/%Y %r')
	ELSE DATE_FORMAT(i.planificacion_fin, '%d/%m/%Y %r')
	END fin,
	i.programa, l.direccion, l.colonia, l.zona,
	l.lat, l.lng, l.mts, i.estatus
	FROM intervencion i, lugar l
	WHERE i.id_lugar = l.id_lugar AND i.oficina='{$oficina}'
	AND {$tiempo}
	";
}

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
$actividades=array();
while ($fila = mysqli_fetch_assoc($result)) {
	$actividades[]=$fila;
}

header('Content-Type: application/json');
echo json_encode($actividades);

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
