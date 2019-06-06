<?php
require 'activo.php';
require 'encriptar.php';

//Creamos la funcion para verificar los usuarios
function verificar_login($user,$password,&$result){
	require 'conexion.php';
    $consulta = " SELECT id_usuario, pass FROM tb_usuarios WHERE usuario=? LIMIT 1";
    /* crear una sentencia preparada */
    if ($sentencia = $mysqli->prepare($consulta)) {

        /* ligar parámetros para marcadores */
        $sentencia->bind_param("s", $user);

        /* ejecutar la consulta */
        $sentencia->execute();

        /* ligar variables de resultado */
        $sentencia->bind_result($id, $pass);

        $count = 0;


        $hashed_pass;

        /* obtener valor */
        while($sentencia->fetch() ){
            $count++;
            $result = $id;
            $hashed_pass = $pass; 
        }

        if( $count == 1 && password_verify($password, $hashed_pass) ){
            /* cerrar sentencia */
            $sentencia->close();
            return 1;
        } else{
            return 0;
        }

    }

    /* cerrar conexión */
    $mysqli->close();
}

if(!$_POST['user'] || !$_POST['password']) {
	echo "<div class='alert alert-danger fade in'>
  <a href=# class=close data-dismiss=alert aria-label=close>&times;</a>
  <strong>Error!</strong> Le falto un llenar un campo.</div>";
} else {
	if(verificar_login($_POST['user'], $_POST['password'], $result) == 1){
		session_start();
        $_SESSION['userid'] = $result;
        $_SESSION['registo'] = 1;
        echo "exito";
        exit();
    } else{
        echo 'error';
    }
    exit();
}

?>