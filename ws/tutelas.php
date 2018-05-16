<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('coneccion.php');

$con= new coneccion();
$nect = $con->conectar();

$f1 = $_GET['inicio'];

$f2 = $_GET['fin'];

$texto = 'select t.numero_tramite_tutela, p.nombre_persona from iepi_procesos.ppdi_solicitud_tutela t inner join
iepi_procesos.ppdi_persona_solicitud_tutela u on t.codigo_solicitud_tutela=u.codigo_solicitud_tutela
inner join iepi_procesos.ppdi_persona p on u.codigo_persona=p.codigo_persona
 where t.fecha_creacion between \''.$f1.'\'  and  \''.$f2.'\'  and u.tipo_persona_tutela= \'ACCIONANTE\' order by t.numero_tramite_tutela, p.nombre_persona;';


 $resultado = $con->consultar($texto);


$salida = array();
while ($arr = pg_fetch_assoc($resultado)) {
    
    array_push($salida, $arr);
}

echo json_encode($salida);
?>

