<?php

require '../../../complementos/activo.php';
require '../../../complementos/conexion.php';

if (isset($_POST['id_indicador'])) {
	if( !isset($_POST['indicador']) || !isset($_POST['valor']) ){
		exit("falta") ;
	}
	$indicador=strtolower( htmlspecialchars($_POST['indicador']) );
	$id_indicador=intval($_POST['id_indicador']);
	$sql="UPDATE indicadores SET {$indicador}=? WHERE id_indicador=?";

	$query = mysqli_prepare($mysqli, $sql);
	if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

	mysqli_stmt_bind_param($query, 'si', $_POST['valor'], $id_indicador);
} else {
	if( !isset($_POST['fecha']) || !isset($_POST['programa']) || !isset($_POST['meta']) ){
		exit("falta") ;
	}
	$sql="INSERT INTO indicadores(fecha, programa, meta) VALUES (?, ?, ?)";

	$query = mysqli_prepare($mysqli, $sql);
	if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

	$fecha = $_POST['fecha']."/01";//date("d/m/Y", strtotime($_POST['fecha']."/01") );
	mysqli_stmt_bind_param($query, 'sss', $fecha, $_POST['programa'], $_POST['meta']);
}


if( mysqli_stmt_execute($query) === false) {
	if (mysqli_stmt_errno($query)==1062) {
		exit('duplicado');
	}
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_errno($query)) );
}
mysqli_stmt_close( $query);
mysqli_close( $mysqli );
exit("exito");
?>
