<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
header("Content-Type: text/html; charset=utf-8");
$id_intervencion = array_shift($_POST);
foreach ($_POST as $campo => $valor) {
	$campo = mysqli_real_escape_string($mysqli, $campo);
	if ($campo=='descripcion') {
		$sql= "
		UPDATE intervencion set descripcion=? WHERE id_intervencion=?;
		";
		$query = mysqli_prepare($mysqli, $sql);
		if ( !$query ) {
			die( 'Error en query: '.mysqli_error($mysqli) );
		}

		mysqli_stmt_bind_param($query, 'si', $valor, $id_intervencion);

		if( mysqli_stmt_execute($query) === false) {
			exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
		}
		mysqli_stmt_close( $query);
	} else {
		$sql= "
		UPDATE intervencion a, lugar l SET l.{$campo}=?
		WHERE a.id_lugar = l.id_lugar AND a.id_intervencion=?;
		";
		$query = mysqli_prepare($mysqli, $sql);
		if ( !$query ) {
			die( 'Error en query: '.mysqli_error($mysqli) );
		}

		mysqli_stmt_bind_param($query, 'si', $valor, $id_intervencion);
		
		if( mysqli_stmt_execute($query) === false) {
			exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
		}
		mysqli_stmt_close( $query);
	}
}
mysqli_close( $mysqli );
exit("exito");
?>