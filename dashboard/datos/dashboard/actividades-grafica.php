<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

if(!isset($_GET['oficina']) ){exit("falta");}
$oficina=htmlspecialchars($_GET['oficina']);

date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'spanish');

$sql="
SELECT COUNT(*)y FROM intervencion WHERE oficina = '{$oficina}';
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
	$value->name = $oficina;
	$value->drilldown = $oficina;
}

header('Content-Type: application/json');
print json_encode($rows);

mysqli_free_result( $query);
mysqli_close($mysqli);
?>