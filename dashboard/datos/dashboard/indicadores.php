<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

if(!isset($_GET['oficina']) ){exit("falta");}
$oficina=htmlspecialchars($_GET['oficina']);
$fecha = date("Y/m/d", mktime(0, 0, 0, $_GET['fecha'], 1, date("Y")));

$wheres=array();
$text = '';
if ( !empty($_GET['sub']) ) {
	$sub=htmlspecialchars($_GET['sub']);
	$wheres['e.sub']=$sub;
	$text = " AND sub = '{$sub}' ";

	if ( !empty($_GET['programa']) ) {
		$programa=htmlspecialchars($_GET['programa']);
		$wheres['e.programa']=$programa;
		$text .= " AND programa = '{$programa}' ";
	}
}

$rango = intval($_GET['rango']);
$tiempo = "fecha BETWEEN '{$fecha}' AND DATE_ADD('{$fecha}', INTERVAL {$rango} MONTH) - INTERVAL 1 DAY";
$tiempo2 = "it.planificacion_inicio BETWEEN '{$fecha}' AND DATE_ADD('{$fecha}', INTERVAL {$rango} MONTH) - INTERVAL 1 DAY";

$sql='';
if ($oficina == 'Educa') {
	$sql= "
	SELECT a.realizadas, a.actividades, IFNULL(SUM(i.meta), 0)meta, IFNULL(SUM(i.asistencia), 0)asistentes,
	IFNULL(AVG(i.calidad), 0)calidad, IFNULL(AVG(i.programacion), 0)progra
	FROM indicadores i, estructura e
	RIGHT JOIN
	(
	SELECT it.oficina, 
	SUM( CASE WHEN it.estatus = 'Realizado' THEN 1 END)realizadas,
	COUNT(it.id_intervencion)actividades
	FROM intervencion it
	WHERE $tiempo2
	AND it.oficina = '{$oficina}' $text
	)a ON e.oficina = a.oficina
	WHERE i.programa = e.programa AND $tiempo
	AND e.oficina='{$oficina}'
	";
} else if ($oficina == 'Jardines') {
	$sql = "
	SELECT a.realizadas, a.actividades, (10000 * {$rango})meta, IFNULL(a.asistentes, 0)asistentes,
	IFNULL(AVG(i.calidad), 0)calidad, IFNULL(AVG(i.programacion), 0)progra
	FROM indicadores i, estructura e
	RIGHT JOIN
	(
	SELECT it.oficina, 
	SUM( CASE WHEN it.estatus = 'Realizado' THEN 1 END)realizadas,
	COUNT(it.id_intervencion)actividades,
	SUM( CASE WHEN it.estatus = 'Realizado' THEN l.mts END)asistentes
	FROM intervencion it
	LEFT JOIN lugar l ON it.id_lugar = l.id_lugar
	WHERE $tiempo2
	AND it.oficina = '{$oficina}' $text
	)a ON e.oficina = a.oficina
	WHERE i.programa = e.programa AND $tiempo
	AND e.oficina='{$oficina}'
	";
}

$sql.=" AND ";
if (count($wheres) != 0){
	foreach ($wheres as $columna => $valor){ $sql .= "{$columna}='{$valor}' AND ";}
}
$sql.="1=1;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
$result = mysqli_stmt_get_result($query);

$data=null;
while ($fila = mysqli_fetch_assoc($result)) {
	$data=$fila;
}

header('Content-Type: application/json');
echo json_encode($data);

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
