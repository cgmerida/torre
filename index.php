<?php
session_start();
if (isset($_SESSION['userid'])) {
    header("Location: direccionar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="img/icono.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Torre de Control RN - Login </title>

    <link rel="stylesheet" type="text/css" href="dist/css/login.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>

    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js" defer></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous" defer></script>
</head>

<body>
    <div class="main">
        <div class="row justify-content-center no-gutters">
            <div class="col-md-4">
                <div class="box">
                    <form role='form'>
                        <h1>Login</h1>
                        <input type="text" placeholder="Usuario" id="username" name="user">
                        <input type="password" placeholder="Contraseña" id="password" name="password">
                        <button id="login">Login</button>
                        <br>
                        <div class="mensaje"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cargando">
        <!-- cargando, siempre al final -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#login').click(function(evento) {
                evento.preventDefault();
                var datos = $('form').serialize();
                if (!$("#username").val() || !$("#password").val()) {
                    $(".mensaje").append(`
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> Usuario o contraseña invalidos.
                    </div>`);
                }
                $.post("complementos/login.php", datos, function(data) {
                    if (data == "exito") {
                        $(".mensaje").append("<div class='alert alert-success alert-dismissible fade show' role=alert>" +
                            "<strong>Genial!</strong> Ingresando al sistema!</div>");
                        window.location.href = 'direccionar.php';
                    }
                })
                .fail(function(jqXHR, textStatus) {
                    console.error("Fallo la petición: " + textStatus);
                    console.error(jqXHR);

                    $(".mensaje").append(`
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>¡Error!</strong> Usuario o contraseña invalidos.
                    </div>`);
                });
            });
        });
    </script>
</body>

</html>