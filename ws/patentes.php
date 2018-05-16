<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('coneccion.php');

$con= new coneccion();
$nect = $con->conectar();


$f1 = $_GET['inicio'];

$f2 = $_GET['fin'];

$texto = "select p.fecha_presentacion, p.numero_tramite_patente, p.numero_expediente_patente, p.titulo, t.nombre as tipo, per.nombre_persona, c.nombre_pais as pais, p.estado
from iepi_procesos.ppdi_solicitud_patente p inner join iepi_procesos.ppdi_persona_solicitud_patente pp on
p.codigo_solicitud_patente = pp.codigo_solicitud_patente inner join iepi_procesos.ppdi_persona per on
pp.codigo_persona = per.codigo_persona inner join iepi_procesos.ppdi_tipo_derecho t on
p.codigo_tipo_derecho = t.codigo_tipo_derecho left join iepi_procesos.ppdi_pais c on
c.codigo_pais = per.codigo_pais where p.fecha_presentacion between '$f1'  and '$f2' and  pp.tipo_persona = 
'SOLICITANTE'
order by nombre_persona, fecha_presentacion, estado;";



 $resultado = $con->consultar($texto);


$salida = array();
while ($arr = pg_fetch_assoc($resultado)) {
    
    array_push($salida, $arr);
}

echo json_encode($salida);
?>
