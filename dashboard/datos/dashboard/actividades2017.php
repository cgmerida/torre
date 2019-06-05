<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

$sql="
SELECT latitud lat, longitud lng
FROM tb_actividades WHERE dependencia = 'Salud' AND descripcion = 'Dispensario Movil';
";

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
