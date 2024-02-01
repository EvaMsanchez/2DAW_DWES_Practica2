<?php

include_once("Conexion.php");

class Regalos
{
    public $id;
    public $nombre;
    public $precio;
    public $idRey;

    public function __construct()
    {}


    // Método consulta: lista de regalos.
    public function consulta()
    {
        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "SELECT
                        idJuguete,
                        nombreJuguete,
                        precio,
                        idReyFK
                    FROM
                        regalos";

        $resultado = mysqli_query($conexion, $consulta);
        $regalos = [];

        while($fila = mysqli_fetch_array($resultado))
        {
            $regalo = new Regalos();

            $regalo->id = $fila["idJuguete"];
            $regalo->nombre = $fila["nombreJuguete"];
            $regalo->precio = $fila["precio"];
            $regalo->idRey = $fila["idReyFK"];

            // Agregar cada objeto regalo al array.
            $regalos[] = $regalo;
        }

        mysqli_close($conexion);

        return $regalos;
    }

 
    // Método añadir regalo.
    public function agregarRegalo($nombre, $precio, $rey)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;  
        $this->idRey = $rey;   

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "INSERT INTO 
                        regalos (nombreJuguete, precio, idReyFK) 
                    VALUES 
                        ('$this->nombre', '$this->precio', '$this->idRey')";
        
        mysqli_query($conexion, $consulta);
        $fila_insertada = mysqli_affected_rows($conexion);

        if ($fila_insertada >0)
        {
            $resultado_agregar = "Se ha insertado " . $fila_insertada . " registro correctamente.";
        }
        else
        {
            $resultado_agregar = "No se ha insertado ningún registro.";
        }

        mysqli_close($conexion);

        return $resultado_agregar;
    }


    // Método modificar regalo.
    public function modificarRegalo($id, $nombre, $precio, $rey)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;  
        $this->idRey = $rey;   

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "UPDATE 
                        regalos
                    SET 
                        nombreJuguete='$this->nombre', 
                        precio='$this->precio', 
                        idReyFK='$this->idRey'
                    WHERE 
                        idJuguete=$this->id";

        mysqli_query($conexion, $consulta);
        $fila_modificada = mysqli_affected_rows($conexion);

        if ($fila_modificada >0)
        {
            $resultado_modificar = "Se ha modificado " . $fila_modificada . " registro correctamente.";
        }
        else
        {
            $resultado_modificar = "No se ha modificado ningún registro.";
        }

        mysqli_close($conexion);

        return $resultado_modificar;
    }


    // Método borrar regalo.
    public function borrarRegalo($id)
    {
        $this->id = $id;

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "DELETE FROM 
                        regalos
                    WHERE 
                        idJuguete = $this->id";
                        
        mysqli_query($conexion, $consulta);
        $fila_borrada = mysqli_affected_rows($conexion);

        if ($fila_borrada >0)
        {
            $resultado_borrar = "Se ha eliminado " . $fila_borrada . " registro correctamente.";
        }
        else
        {
            $resultado_borrar = "No se ha eliminado ningún registro.";
        }

        mysqli_close($conexion);

        return $resultado_borrar;
    }
}

?>