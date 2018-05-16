<?php
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('./AdministradorBaseDatos.php');
   $adminBDD = new AdministradorBaseDatos();
   $sql = 'select concat(autor.nombres, \' \', autor.apellidos) as sera, count(autor.nombres) as conteo from autor group by sera; ';
  // $sql = 'SELECT id, nombre FROM public.nombres;';
  
   
   $respuesta = $adminBDD->ejecutarConsulta($sql);
   
  echo json_encode($respuesta);

