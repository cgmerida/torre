<?php
function color($programa){

    switch ($programa) {
        case 'Agendado':
        return '#007bff';
        break;

        case 'Realizado':
        return '#28a745';
        break;

        default:
        break;
    }
}

require '../../../complementos/require.php';
require '../../../complementos/conexion.php';

date_default_timezone_set('America/Guatemala');

$wheres=array();

if (!empty($_POST['oficina'])) {
    $oficina=htmlspecialchars($_POST['oficina']);
    $wheres['oficina']=$oficina;

    if (!empty($_POST['sub'])) {
        $sub=htmlspecialchars($_POST['sub']);
        $wheres['sub']=$sub;

        if (!empty($_POST['programa'])) {
            $programa=htmlspecialchars($_POST['programa']);
            $wheres['programa']=$programa;
        }
    }
}

$sql="
SELECT i.id_intervencion id, i.descripcion, i.respuesta, 
CASE 
WHEN i.fecha_realizado IS NOT NULL THEN i.fecha_realizado
ELSE i.planificacion_inicio
END inicio,
CASE
WHEN i.fecha_terminado IS NOT NULL THEN i.fecha_terminado
ELSE i.planificacion_fin
END fin,
i.programa, l.nombre, l.direccion, l.colonia, l.zona, l.mts, i.estatus
FROM intervencion i, lugar l
WHERE i.id_lugar = l.id_lugar AND YEAR(i.planificacion_inicio)=YEAR( NOW() )
";

if (count($wheres) != 0){
    $sql.=" AND ";
    foreach ($wheres as $columna => $valor){ $sql .= "{$columna}='{$valor}' AND ";}
    $sql.=" 1=1 ORDER BY i.estatus DESC;";
}

$query=mysqli_query($mysqli, $sql);

if( $query === false ) {
    die( print_r( mysqli_error($mysqli), true));
}

$eventos = array();
while($row = mysqli_fetch_object($query)) {
    $data = array();
    $dir = "";
    if ($row->mts) {
        $data['title'] = $row->programa." ".$row->nombre;
        $dir = $row->direccion .", Zona ". $row->zona;
    } else {
        $data['title'] = $row->programa." ".$row->colonia;
        $dir = $row->nombre." ".$row->direccion .", Colonia ". $row->colonia .", Zona ". $row->zona;
    }
    $data['start'] = $row->inicio;
    $data['end'] = $row->fin;
    $data['id'] = (int)$row->id;
    $data['color'] = color($row->estatus);
    $data['textColor'] = 'white';
    $data['programa'] = $row->programa;
    $data['descripcion'] = $row->descripcion;
    $data['direccion'] = $dir;
    $data['estatus'] = $row->estatus;
    if ($row->estatus == 'Realizado') {
        $data['respuesta'] = $row->respuesta;   
    }
    if ($row->mts) {
        $data['mts'] = $row->mts;   
    }
    array_push($eventos, $data);
}

print json_encode($eventos);


mysqli_free_result( $query);
mysqli_close($mysqli);
?>