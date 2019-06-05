<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if(!isset($_POST['zona']) ){exit("falta");}
$zona=$_POST['zona'];

$sql= "SELECT colonia FROM colonia WHERE zona=?;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'i', $zona);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
mysqli_stmt_bind_result($query, $colonia);
while (mysqli_stmt_fetch($query)) {
	?>
	<option><?=$colonia;?></option>
	<?php
}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
