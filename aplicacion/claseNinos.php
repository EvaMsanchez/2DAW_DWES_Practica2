<?php

include_once("Conexion.php");

class Ninos
{
    public $id;
    public $nombre;
    public $apellidos;
    public $fechaNacimiento;
    public $bueno;

    public function __construct()
    {}


    // Método consulta: lista regalos por niño.
    public function consultaRegalos($id)
    {
        $this->id = $id;  

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "SELECT 
                        nombreJuguete
                    FROM
                        ninos_juguetes 
                    INNER JOIN 
                        ninos ON idNinoFK = idNino 
                    INNER JOIN 
                        regalos ON idJugueteFK = idJuguete 
                    WHERE 
                        idNino = '$this->id'";

        $resultado = mysqli_query($conexion, $consulta);
        $lista_regalos = [];

        while ($fila = mysqli_fetch_assoc($resultado))
        {
            $lista_regalos[] = $fila;
        }
        
        mysqli_close($conexion);

        return $lista_regalos;
    }


    // Método añadir: nuevo regalo al niño.
    public function agregarNuevoRegalo($idNino, $idJuguete, $nombreJuguete)
    {
        $this->id = $idNino;

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        // Regalos que tiene ya el niño en su lista.
        $regalosActuales = $this->consultaRegalos($idNino);

        foreach ($regalosActuales as $regalo) 
        {
            if ($regalo["nombreJuguete"] == $nombreJuguete) 
            {
                return "El niño ya eligió ese regalo.";
            }
        }

        $consulta = "INSERT INTO 
                        ninos_juguetes (idNinoFK, idJugueteFK) 
                    VALUES 
                        ('$this->id', '$idJuguete')";

        mysqli_query($conexion, $consulta);
        $fila_insertada = mysqli_affected_rows($conexion);

        if ($fila_insertada >0)
        {
            $resultado_agregarRegalo = "Se ha añadido " . $fila_insertada . " juguete más a su lista.";
        }
        else
        {
            $resultado_agregarRegalo = "No se ha añadido ningún juguete.";
        }

        mysqli_close($conexion);

        return $resultado_agregarRegalo;
    }


    // Método consulta: lista de niños ordenada alfabéticamente por nombre.
    public function consulta()
    {
        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "SELECT
                        idNino,
                        nombreNino,
                        apellidos,
                        fechaNacimiento,
                        bueno
                    FROM
                        ninos
                    ORDER BY 2";

        $resultado = mysqli_query($conexion, $consulta);
        $niños = [];

        while($fila = mysqli_fetch_array($resultado))
        {
            $nino = new Ninos();

            $nino->id = $fila["idNino"];
            $nino->nombre = $fila["nombreNino"];
            $nino->apellidos = $fila["apellidos"];
            $nino->fechaNacimiento = $fila["fechaNacimiento"];
            $nino->bueno = $fila["bueno"];

            // Agregar cada objeto niño al array.
            $niños[] = $nino;
        }

        mysqli_close($conexion);

        return $niños;
    }

 
    // Método añadir niño.
    public function agregarNino($nombre, $apellidos, $fechaNacimiento, $bueno)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;  
        $this->fechaNacimiento = $fechaNacimiento;  
        $this->bueno = $bueno;  

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "INSERT INTO 
                        ninos (nombreNino, apellidos, fechaNacimiento, bueno) 
                    VALUES 
                        ('$this->nombre', '$this->apellidos', '$this->fechaNacimiento', '$this->bueno')";
        
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


    // Método modificar niño.
    public function modificarNino($id, $nombre, $apellidos, $fechaNacimiento, $bueno)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;  
        $this->fechaNacimiento = $fechaNacimiento;  
        $this->bueno = $bueno;  

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "UPDATE 
                        ninos 
                    SET 
                        nombreNino='$this->nombre', 
                        apellidos='$this->apellidos', 
                        fechaNacimiento='$this->fechaNacimiento', 
                        bueno=$this->bueno 
                    WHERE 
                        idNino=$this->id";

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


    // Método borrar niño.
    public function borrarNino($id)
    {
        $this->id = $id;

        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        // Si el niño tiene asociado regalos, hay que borrar antes sus regalos.
        $consultaEliminarRegalos = "DELETE FROM 
                                        ninos_juguetes
                                    WHERE 
                                        idNinoFK = $this->id";

        mysqli_query($conexion, $consultaEliminarRegalos);

        $consulta = "DELETE FROM 
                        ninos 
                    WHERE 
                        idNino = $this->id";
                        
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