<?php
require '../../../complementos/conexion.php';

if ( !isset($_POST['id_intervencion']) ) {
	exit("falta");
}
$id_intervencion=intval( htmlspecialchars($_POST['id_intervencion']) );

$director=strtolower( htmlspecialchars($_POST['director']) );
$telefono=intval( htmlspecialchars($_POST['telefono']) );

$preg1=intval( htmlspecialchars($_POST['preg1']) );
$preg2=strtolower( htmlspecialchars($_POST['preg2']) );
$preg3=intval( htmlspecialchars($_POST['preg3']) );
$preg4=strtolower( htmlspecialchars($_POST['preg4']) );
$preg5=intval( htmlspecialchars($_POST['preg5']) );
$preg6=strtolower( htmlspecialchars($_POST['preg6']) );
$preg7=intval( htmlspecialchars($_POST['preg7']) );
$preg8=strtolower( htmlspecialchars($_POST['preg8']) );
$preg9=intval( htmlspecialchars($_POST['preg9']) );
$preg10=intval( htmlspecialchars($_POST['preg10']) );
$preg11=strtolower( htmlspecialchars($_POST['preg11']) );
$preg12=intval( htmlspecialchars($_POST['preg12']) );
$preg13=strtolower( htmlspecialchars($_POST['preg13']) );
$preg14=strtolower( htmlspecialchars($_POST['preg14']) );

$sql="
INSERT INTO calidad_cuentos(id_intervencion, director, telefono, preg1, preg2, preg3, preg4, preg5, preg6, preg7, preg8, preg9, preg10, preg11, preg12, preg13, preg14)
VALUES({$id_intervencion}, '{$director}', {$telefono}, {$preg1}, '{$preg2}', {$preg3}, '{$preg4}', {$preg5}, '{$preg6}', {$preg7}, '{$preg8}', {$preg9}, {$preg10}, '{$preg11}', {$preg12}, '{$preg13}', '{$preg14}');
";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>
