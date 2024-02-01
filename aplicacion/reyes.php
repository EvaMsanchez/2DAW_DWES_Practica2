<?php

include("claseReyes.php");

// Consulta: lista regalos de cada rey mago "regalo" y "niño".
$rey = new Reyes();
$lista_reyes = $rey->consulta();

// Arrays separados para cada rey.
$reyesOrganizados = [];

foreach ($lista_reyes as $rey) 
{
    $idRey = $rey["idRey"];

    if (!isset($reyesOrganizados[$idRey])) 
    {
        $reyesOrganizados[$idRey] = [];
    }

    // Agregar la información del niño al array del rey mago.
    $reyesOrganizados[$idRey][] = $rey;
}

ksort($reyesOrganizados); // Ordenar por los índices del array.

?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reyes Magos</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">        
        <link rel="stylesheet" type="text/css" href="./assets/css/estilos.css"/>
    </head>

    <body>
        <div class="container color">
            <h3 class="mb-2 text-center py-2 h3">Listado de los Reyes Magos</h3>

            <div class="text-end">
                <a href="./index.php" class="text-black"><button class="btn btn-inicio mb-1" type="button">
                    <i class="bi bi-house"></i>
                </button></a>
            </div>
           
            <?php
            foreach ($reyesOrganizados as $idRey=>$ninos) 
            {
                $gastos = 0;

                $id = $idRey;
                if ($id == 1)
                {
                    echo "<h3 class='mb-3 reyes'>Melchor</h3>";
                }
                else if ($id == 2)
                {
                    echo "<h3 class='mb-3 reyes'>Gaspar</h3>";
                }
                else
                {
                    echo "<h3 class='mb-3 reyes'>Baltasar</h3>";
                }
            ?>

            <table class="table table-striped mb-5">
                <tr>
                    <th class="color-th">Nombre niño</th>
                    <th class="color-th">Apellidos</th>
                    <th class="color-th">Juguete</th>
                </tr>
                
                <?php
                foreach ($ninos as $nino)
                {
                    echo "<tr>";
                    echo "<td>" . $nino["nombreNino"] . "</td>";
                    echo "<td>" . $nino["apellidos"] . "</td>";
                    echo "<td>" . $nino["nombreJuguete"] . "</td>";
                    echo "</tr>";
                    $gastos += $nino["precio"];
                }
                ?>     

                <tr>
                    <td colspan="3" class="text-end font-weight-bold">Total gastos: <?php echo $gastos; ?> euros </td>
                </tr>
            </table> 

            <?php
            } 
            ?>
        </div>
    </body>
</html>