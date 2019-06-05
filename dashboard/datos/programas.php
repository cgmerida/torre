<?php
require '../../complementos/activo.php';
require '../../complementos/conexion.php';
if( !isset($_POST['oficina']) || !isset($_POST['sub']) ){exit("falta");}
$oficina=$_POST['oficina'];$sub=$_POST['sub'];

$sql= "SELECT programa FROM estructura WHERE oficina=? AND sub=?;";

$query = mysqli_prepare($mysqli, $sql);
if ( !$query ) {
	die( 'Error en query: '.mysqli_error($mysqli) );
}

mysqli_stmt_bind_param($query, 'ss', $oficina, $sub);

if( mysqli_stmt_execute($query) === false) {
	exit( printf("Error al ejecutar: %s.\n", mysqli_stmt_error($query)) );
}
mysqli_stmt_bind_result($query, $programa);
?>
<option value="" selected>Seleccione Programa</option>
<?php 
while (mysqli_stmt_fetch($query)) {
	?>
	<option><?=$programa;?></option>
	<?php
}

mysqli_stmt_close( $query);
mysqli_close( $mysqli );
?>
