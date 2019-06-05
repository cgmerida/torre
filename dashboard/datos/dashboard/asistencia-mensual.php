<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'spanish');

$sql="
SELECT DATE_FORMAT(fecha,'%b %Y') as name, SUM(asistencia) AS y 
FROM indicadores
GROUP BY DATE_FORMAT(fecha,'%b %Y')
ORDER BY fecha ASC;
";

$query=mysqli_query($mysqli, $sql);

if( $query === false ) {
	die( print_r( mysqli_error($mysqli), true));
}

$rows = array();
while($row = mysqli_fetch_object($query)) {
	$rows[]= $row;
}
foreach ($rows as $value) {
	$value->y = (int)$value->y;
	$value->drilldown = $value->name;
	$value->name = strftime("%B %Y", strtotime($value->name));
}

header('Content-Type: application/json');
print json_encode($rows);

mysqli_free_result( $query);
mysqli_close($mysqli);
?>