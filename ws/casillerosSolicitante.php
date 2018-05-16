<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   
$conn = pg_connect("host=localhost dbname=php user=postgres password=12345");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}
$result = pg_query($conn, 'select p.fecha_presentacion, p.numero_tramite_patente, p.numero_expediente_patente, p.titulo, t.nombre as tipo, per.nombre_persona, c.nombre_pais as pais, p.estado
from iepi_procesos.ppdi_solicitud_patente p inner join iepi_procesos.ppdi_persona_solicitud_patente pp on
p.codigo_solicitud_patente = pp.codigo_solicitud_patente inner join iepi_procesos.ppdi_persona per on
pp.codigo_persona = per.codigo_persona inner join iepi_procesos.ppdi_tipo_derecho t on
p.codigo_tipo_derecho = t.codigo_tipo_derecho left join iepi_procesos.ppdi_pais c on
c.codigo_pais = per.codigo_pais where pp.tipo_persona = 
\'SOLICITANTE\' and p.fecha_presentacion >= \'2017-01-01\'::date and p.fecha_presentacion <= \'2017-12-31\'::date
order by nombre_persona, fecha_presentacion, estado;');
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
$salida = array();
while ($arr = pg_fetch_assoc($result)) {
    
    array_push($salida, $arr);
}
pg_close($conn);
echo json_encode($salida);
?>
