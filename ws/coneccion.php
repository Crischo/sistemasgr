

    <?php 
class coneccion
{

 
    public static function conectar()
    {
        $datos_bd="host=localhost dbname=php user=postgres password=12345";
        return pg_connect($datos_bd);


    
        
       
    }

 
  public function consultar($sql)
    {

        $respuesta = pg_query($this->conectar(), $sql);

       return $respuesta;
        
    }

    public function desconectar(){
        $this->Conexion = null;
    }

 
}

?>

