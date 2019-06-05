<?php
require '../../../complementos/conexion.php';
$programas = Array("Valija Viajera", "Reforestando la primavera", "Proyectos Insigne", "Producción", "Parques recuperados", "Parques nuevos", "Mantenimiento", "Manos a la Obra Innovacion", "Manos a la Obra Express", "Dispensario Movil", "Cuenta Cuentos", "Apoyo Manos a la Obra");
if (!isset( $_POST['fecha'] )) {
	exit("falta");
}
$mes = date("Y/m/d", mktime(0, 0, 0, $_POST['fecha'], 1, date("Y")));
foreach ($programas as $programa) {
	$sql="";

	if ( $mes == date("Y/m/d", mktime(0, 0, 0, date("m"), 1, date("Y"))) ) {
		$sql="
		SELECT
		((SELECT COUNT(*) FROM intervencion
		WHERE planificacion_inicio between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() - INTERVAL 1 DAY
		AND programa='{$programa}' AND estatus='Realizado')*100)
		/(SELECT COUNT(*) FROM intervencion
		WHERE planificacion_inicio between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() - INTERVAL 1 DAY
		AND programa='{$programa}')
		AS programacion;
		";
	} else {
		$sql="
		SELECT
		((SELECT COUNT(*) FROM intervencion
		WHERE MONTH(planificacion_inicio) = MONTH('{$mes}')
		AND programa='{$programa}' AND estatus='Realizado')*100)
		/(SELECT COUNT(*) FROM intervencion
		WHERE MONTH(planificacion_inicio) = MONTH('{$mes}')
		AND programa='{$programa}')
		AS programacion;
		";
	}

	$query=mysqli_query($mysqli, $sql);

	if( $query === false ) {
		die( print_r( mysqli_error($mysqli), true));
	}

	$programacion = mysqli_fetch_object($query);

	if ($programacion->programacion!=null) {
		$sql2="
		UPDATE indicadores SET programacion = ($programacion->programacion)
		WHERE programa='{$programa}' AND MONTH(fecha) = MONTH('{$mes}');
		";

		$query2=mysqli_query($mysqli, $sql2);

		if( $query2 === false ) {
			die( print_r( mysqli_error($mysqli), true));
		}
		echo $programa.": ".$programacion->programacion."<br>";
	}
}

mysqli_free_result( $query);
mysqli_close($mysqli);
?>