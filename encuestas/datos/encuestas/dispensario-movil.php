<?php
require '../../../complementos/conexion.php';

if ( !isset($_POST['id_intervencion']) ) {
	exit("falta");
}
$id_intervencion=intval( htmlspecialchars($_POST['id_intervencion']) );

$edad=intval( htmlspecialchars($_POST['edad']) );
$sexo=strtolower( htmlspecialchars($_POST['sexo']) );

$preg1=strtolower( htmlspecialchars($_POST['preg1']) );
$preg2=strtolower( htmlspecialchars($_POST['preg2']) );
if ($preg2 == "otro") {
	$preg2=strtolower( htmlspecialchars($_POST['preg2-otro']) );
}
$preg3=intval( htmlspecialchars($_POST['preg3']) );
$preg4=intval( htmlspecialchars($_POST['preg4']) );
$preg5=strtolower( htmlspecialchars($_POST['preg5']) );
$preg6=intval( htmlspecialchars($_POST['preg6']) );
$preg7=strtolower( htmlspecialchars($_POST['preg7']) );
$preg8=intval( htmlspecialchars($_POST['preg8']) );
$preg9=strtolower( htmlspecialchars($_POST['preg9']) );
$medio=strtolower( htmlspecialchars($_POST['preg10']) );
$preg11=intval( htmlspecialchars($_POST['preg11']) );
$preg12=intval( htmlspecialchars($_POST['preg12']) );
$preg13=strtolower( htmlspecialchars($_POST['preg13']) );

$sql="
INSERT INTO calidad_dispensario(id_intervencion, edad, sexo, preg1, preg2, preg3, preg4, preg5, preg6, preg7, preg8, preg9, medio, preg11, preg12, preg13)
VALUES({$id_intervencion}, {$edad}, '{$sexo}', '{$preg1}', '{$preg2}', {$preg3}, {$preg4}, '{$preg5}', {$preg6}, '{$preg7}', {$preg8}, '{$preg9}', '{$medio}', {$preg11}, {$preg12}, '{$preg13}')
";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>
