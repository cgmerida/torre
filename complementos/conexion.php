<?php

$usuario= 'root';
$pass = '';
$servidor = '127.0.0.1'; 
$basedatos = 'db_torre';

$mysqli = new mysqli($servidor, $usuario, $pass, $basedatos);

// Comprobar conexion
if (mysqli_connect_errno()) {
	echo "Fallo la conexion a MySQL: " . mysqli_connect_error();
	exit();
}

if (!mysqli_set_charset($mysqli, "utf8")) {
    exit();
}

?>