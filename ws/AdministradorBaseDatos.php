

    <?php 
class coneccion
{
    private $host= "localhost";
    private $bd = "php";
    private $usuario = "postgres";
    private $password = "12345";
    private $link;

 
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
 
}

?>

