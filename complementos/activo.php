<?php
$segundos = 7200; //3 horas en segundos
if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
    if($vida_session > $segundos) {
        session_destroy();
        header("Location: /torre");
        exit();
    }
}
$_SESSION['tiempo'] = time();
?>
