<?php
require_once '/complementos/require.php';
$pagina='Ingreso';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '/pagina/header.php';?>
  <!-- Optional srcipt -->

</head>

<body>
  <div class="wrapper">
    <?php include_once 'pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once 'pagina/navbar.php'; ?>
      <div class="content">
        <div class="container-fluid">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div><!-- /container-frluid -->
      </div>
    </div>
  </div>
</body>
</html>