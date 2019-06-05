<?php
require_once '/complementos/require.php';
$pagina='Dashboard Example';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php require_once '/pagina/header.php';?>
  <!-- Optional srcipt -->
  <script src="../dist/js/plugins/chartist.min.js" defer></script>

  <script src="../dist/js/demo.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      demo.initDashboardPageCharts();

      demo.showNotification();

    });
  </script>
</head>

<body>
  <div class="wrapper">
    <?php include_once 'pagina/sidebar.php'; ?>
    <div class="main-panel">
      <?php include_once 'pagina/navbar.php'; ?>
      <div class="content">
        <div class="container-fluid">

        </div><!-- /container-frluid -->
      </div>
    </div>
  </div>
</body>
</html>