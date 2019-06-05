<?php
require '../../../complementos/conexion.php';

if(!isset($_POST['rango']) || !isset($_POST['fecha']) ){exit("falta");}

// $oficina=htmlspecialchars($_POST['oficina']);
$fecha = date("Y/m/d", mktime(0, 0, 0, $_POST['fecha'], 1, date("Y")));
$rango = intval($_POST['rango']);


$sql= "
SELECT

(((SUM(cd.preg3) + SUM(cd.preg4)+ SUM(cd.preg6)
+ SUM(cd.preg8) + SUM(cd.preg11)+ SUM(cd.preg12))/(20))*100)/COUNT(cd.id_calidad) 'dispensario-movil',

(CASE WHEN i.programa = 'Cuenta Cuentos'
  THEN ( (((SUM(cc.preg1) + SUM(cc.preg3)+ SUM(cc.preg5)
+ SUM(cc.preg7) + SUM(cc.preg10)+ SUM(cc.preg12))/(10))*100)/COUNT(cc.id_calidad) )
END) 'cuenta-cuentos',

(CASE WHEN i.programa = 'Valija Viajera'
  THEN ( (((SUM(cc.preg1) + SUM(cc.preg3)+ SUM(cc.preg5)
+ SUM(cc.preg7) + SUM(cc.preg10)+ SUM(cc.preg12))/(10))*100)/COUNT(cc.id_calidad) )
END) 'valija-viajera',

(((SUM(cm.preg3) + SUM(cm.preg7)+ SUM(cm.preg9)
+ SUM(cm.preg11) + SUM(cm.preg12)+ SUM(cm.preg14))/(20))*100)/COUNT(cm.id_intervencion) 'mantenimiento'

FROM intervencion i
LEFT JOIN calidad_dispensario cd ON cd.id_intervencion = i.id_intervencion
LEFT JOIN calidad_cuentos cc on i.id_intervencion = cc.id_intervencion
LEFT JOIN calidad_mantenimiento cm ON i.id_intervencion = cm.id_intervencion
WHERE planificacion_inicio BETWEEN '{$fecha}' AND DATE_ADD('{$fecha}', INTERVAL {$rango} MONTH) - INTERVAL 1 DAY
GROUP BY i.programa
;
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
	foreach ($fila as $key => $value) {
		if (!is_null($value)) {
			$actividades[$key]=round( floatval($value), 2);
		}
	}
}

header('Content-Type: application/json');
echo json_encode($actividades);

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
