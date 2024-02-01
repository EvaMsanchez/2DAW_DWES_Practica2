<?php

include_once("Conexion.php");

class Reyes
{
    public $id;
    public $nombre;

    public function __construct()
    {}


    // Método consulta: lista regalos de cada rey mago "regalo" y "niño".
    public function consulta()
    {
        $conexion = new Conexion();
        $conexion = $conexion->conectar();

        $consulta = "SELECT DISTINCT 
                        nombreNino,
                        apellidos,
                    CASE 
                        WHEN bueno = 0 THEN 'Carbon' 
                        ELSE nombreJuguete END AS nombreJuguete, 
                    CASE 
                        WHEN bueno = 0 THEN 0 
                        ELSE precio END AS precio, 
                    CASE 
                        WHEN bueno = 0 THEN (SELECT 
                                                idRey 
                                            FROM 
                                                regalos 
                                            INNER JOIN reyes ON idReyFK = idRey 
                                            WHERE 
                                                 nombreJuguete = 'Carbon') 
                        ELSE idRey END AS idRey
                    FROM
                        ninos_juguetes
                    INNER JOIN
                        ninos ON idNinoFK = idNino
                    INNER JOIN
                        regalos ON idJugueteFK = idJuguete
                    INNER JOIN
                        reyes ON idReyFK = idRey";

        $resultado = mysqli_query($conexion, $consulta);
        $reyes = [];

        while($fila = mysqli_fetch_array($resultado))
        {
            $reyes[] = $fila;
        }

        mysqli_close($conexion);

        return $reyes;
    }
}

?>
