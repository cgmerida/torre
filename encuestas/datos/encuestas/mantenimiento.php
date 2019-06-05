<?php
require '../../../complementos/conexion.php';

if ( !isset($_POST['id_intervencion']) ) {
	exit("falta");
}
$id_intervencion=intval( htmlspecialchars($_POST['id_intervencion']) );


$preg1=strtolower( htmlspecialchars($_POST['preg1']) );
$preg2=strtolower( htmlspecialchars($_POST['preg2']) );
$preg3=intval( htmlspecialchars($_POST['preg3']) );
$preg4=strtolower( htmlspecialchars($_POST['preg4']) );


$preg5 = isset($_POST['preg5']) ? intval( count($_POST['preg5']) ): 0;
if (isset($_POST['preg5'])) {
	foreach ($_POST['preg5'] as $trabajo) {
		$trabajo = intval( htmlspecialchars($trabajo) );
		$sql="
		INSERT INTO trabajos_por_actividad(id_trabajo, id_intervencion) VALUES ( {$trabajo}, {$id_intervencion});
		";
		$query = mysqli_prepare($mysqli, $sql);
		if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

		if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

		mysqli_stmt_close( $query);
	}

}

$preg6 = isset($_POST['preg6']) ? intval( count($_POST['preg6']) ): 0;
if (isset($_POST['preg6'])) {
	foreach ($_POST['preg6'] as $planta) {
		$planta = intval( htmlspecialchars($planta) );
		$sql="
		INSERT INTO plantas_por_actividad(id_planta, id_intervencion) VALUES ({$planta}, {$id_intervencion})
		";
		$query = mysqli_prepare($mysqli, $sql);
		if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

		if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

		mysqli_stmt_close( $query);
	}

}
$preg7=intval( htmlspecialchars($_POST['preg7']) );
$preg8=strtolower( htmlspecialchars($_POST['preg8']) );
$preg9=intval( htmlspecialchars($_POST['preg9']) );
$preg10=strtolower( htmlspecialchars($_POST['preg10']) );
$preg11=intval( htmlspecialchars($_POST['preg11']) );
$preg12=intval( htmlspecialchars($_POST['preg12']) );
$preg13=strtolower( htmlspecialchars($_POST['preg13']) );
$preg14=intval( htmlspecialchars($_POST['preg14']) );
$preg15=strtolower( htmlspecialchars($_POST['preg15']) );

$sql="
INSERT INTO calidad_mantenimiento(id_intervencion, preg1, preg2, preg3, preg4, preg5, preg6, preg7, preg8, preg9, preg10, preg11, preg12, preg13, preg14, preg15)
VALUES ( {$id_intervencion}, '{$preg1}', '{$preg2}', {$preg3}, '{$preg4}', {$preg5}, {$preg6}, {$preg7}, '{$preg8}', {$preg9}, '{$preg10}', {$preg11}, {$preg12}, '{$preg13}', {$preg14}, '{$preg15}');
";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>
