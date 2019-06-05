<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';

$mysqli->autocommit(FALSE);
if( !isset($_POST['id_intervencion']) || !isset($_FILES['foto']) || !isset($_POST['nombre']) || !isset($_POST['descripcion']) ){
	exit("falta");
}
$carpeta = "../fotos/";
if($_FILES['foto']['error'] > 0) { exit('error'); }

$permitido = array( 'jpg', 'jpeg', 'png', 'gif' );

$extension =strtolower( pathinfo( basename($_FILES['foto']["name"]),PATHINFO_EXTENSION) );

if (in_array($extension, $permitido) ) {

	if ($_FILES["foto"]["size"] > 5000000) { exit ("tamano"); }
	$sql=" INSERT INTO foto(id_intervencion, extension, nombre, descripcion, tipo) VALUES (?, ?, ?, ?, ?); ";

	$query = mysqli_prepare($mysqli, $sql);if ( !$query ) {exit( 'Error en query: '.mysqli_error($mysqli) );}

	mysqli_stmt_bind_param($query, 'issss', $id_intervencion, $extension, $nombre, $descripcion, $tipo);
	$id_intervencion= $_POST['id_intervencion'];
	$nombre= $_POST['nombre'];
	$descripcion=$_POST['descripcion'];
	$tipo=(isset($_POST['tipo']))? $_POST['tipo']: null;
	if( mysqli_stmt_execute($query) === false) {exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );}
	$id = mysqli_insert_id($mysqli);
	mysqli_stmt_close( $query);

	$archivo = $carpeta.$id.".".$extension;
	if (file_exists($archivo)) { exit ("nombre"); }
	if (move_uploaded_file($_FILES["foto"]["tmp_name"], $archivo)) {
		$mysqli->commit();
		mysqli_close( $mysqli );
		exit('exito');
	} else {
		$mysqli->rollback();
		mysqli_close( $mysqli );
		exit ("foto error");
	}

} else { echo 'tipo'; }
?>