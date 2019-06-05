<div class="sidebar" data-color="black" data-image="/torre/img/regencia-mobil.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <span class="simple-text">
                Torre de Control
            </span>
        </div>
        <ul class="nav">
            <?php 
            switch ($usuario->privilegio) {

                case 1:
                include_once 'sidebar/admin.php';
                break;

                case 2:
                include_once 'sidebar/dashboard.php';
                break;

                case 3:
                include_once 'sidebar/educa.php';
                break;

                case 4:
                include_once 'sidebar/jardines.php';
                break;
                
                case 5:
                include_once 'sidebar/calidad.php';
                break;
                
                default:
                echo "Revisar privilegio";
                break;
                
            }
            ?>
        </ul>
    </div>
</div>