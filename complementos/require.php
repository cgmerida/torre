<?php
session_start();
require "seguridad.php";
require "activo.php";
require "conexion.php";

$userid = $_SESSION['userid'];
set_time_limit(500);

$consulta = "SELECT nombre, apellido, privilegio FROM tb_usuarios WHERE id_usuario='$userid';";

if ($resultado = $mysqli->query($consulta)) {
	$usuario = $resultado->fetch_object();
	/* liberar el conjunto de resultados */
	$resultado->close();
}

/* cerrar la conexión */
$mysqli->close();
?>