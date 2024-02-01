<?php

class Conexion
{
    public $servidor;
    public $usuario;
    public $password;
    public $bd;

    public function __construct()
    {
        $this->servidor = "localhost";
        $this->usuario = "studium";
        $this->password = "studium__";
        $this->bd = "studium_dws_p2";
    }


    // Método conexión.
    public function conectar()
    {
        try
        {
            //Conectar con servidor.
            $conexion = mysqli_connect($this->servidor, $this->usuario, $this->password);

            //Seleccionar bae de datos.
            mysqli_select_db($conexion, $this->bd);

            return $conexion;
        }
        catch(Exception)
        {
            echo "<p>ERROR: " . mysqli_errno($conexion) . " - " . mysqli_error($conexion) . "</p>"; //devuelve el último error.
                                                                                                //devuelve el mensaje de error. 
        }
    }
}


/*
$conexion = new Conexion();
$conectada = $conexion->conectar();

    if(!$conectada)
    {
        echo "Error al conectar<br>";
    }
    else
    {
        echo "Conexión correcta!<br>";
    }
*/

?>