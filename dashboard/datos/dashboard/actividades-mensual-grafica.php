<?php
require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

if(!isset($_POST['oficina']) ){exit("falta");}
$oficina=htmlspecialchars($_POST['oficina']);

date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'spanish');

$sql="
SELECT  DATE_FORMAT(planificacion_inicio,'%b %Y') as name, COUNT(*)y
FROM intervencion
WHERE oficina = '{$oficina}'
GROUP BY DATE_FORMAT(planificacion_inicio,'%b %Y')
ORDER BY MONTH(planificacion_inicio) ASC;
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
	$value->name = strftime("%B %Y", strtotime($value->name));
	$value->y = (int)$value->y;
}
$rows['data'] = $rows;
$rows['id'] = $oficina;

header('Content-Type: application/json');
print json_encode($rows);

mysqli_free_result( $query);
mysqli_close($mysqli);
?>