<?php
require_once 'complementos/require.php';
switch ($usuario->privilegio) {
	case 2:
	case 1:
	header("location: dashboard/dashboard-educa.php");
	break;

	case 3:
	header("location: dashboard/dashboard-jardines.php");
	break;
	
	case 4:
	header("location: dashboard/dashboard-educa.php");
	break;

	case 5:
	header("location: encuestas/dashboard.php");
	break;

	default:
	echo "Error privilegio";
	break;
}
?>