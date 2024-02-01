<?php

session_start();
include("claseNinos.php");
include("claseRegalos.php");

$nino = new Ninos();

// Consulta: lista de niños.
$lista_ninos = $nino->consulta();

if (isset($_POST["buscar"]))
{
    if (empty($_POST["nino"]))
    {
        $resultado_seleccionarNino = "Por favor, selecciona un niño.";
    }
    else
    {    
        $nombre_completo = $_POST["nino"];

        list($_SESSION["id"], $_SESSION["nombre"], $_SESSION["apellidos"]) = explode(" ", $nombre_completo, 3);

        // Consulta: lista regalos del niño seleccionado.
        $lista_regalos = $nino->consultaRegalos($_SESSION["id"]);
        // Lista regalos ACTUALIZADA cuando se agrega nuevo regalo.
        $_SESSION['lista_regalos'] = $lista_regalos;
    }
}

// Consulta: lista de regalos.
$regalo = new Regalos();
$regalos = $regalo->consulta();

// Mensaje: agregar nuevo regalo al niño.
$resultado_agregarRegalo = isset($_COOKIE["resultado_agregarRegalo"]) ? $_COOKIE["resultado_agregarRegalo"] : "";
setcookie("resultado_agregarRegalo", "", time() - 3600);




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
            <h3 class="mb-2 text-center py-2 h3">Búsqueda</h3>

            <a href="./index.php" class="text-black"><button class="btn btn-inicio mb-1" type="button">
                    <i class="bi bi-house"></i>
            </button></a>

            <div class="col-5 mx-auto">
                <?php
                // Mensaje: seleccionar niño.
                if (!empty($resultado_seleccionarNino)) 
                {
                    echo "<div class='alert alert-secondary' role='alert'>
                                $resultado_seleccionarNino</div>";
                }
                ?>
            </div>

            <form action="busqueda.php" method="post">
                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nombre">Niño:</label>
                    <select name="nino" id="nino" required>
                        <option disabled selected>Selecciona un niño...</option>

                        <?php
                        foreach ($lista_ninos as $nino)
                        {
                            echo "<option value='" . $nino->id . " " . $nino->nombre . " " . $nino->apellidos . "'>" . $nino->nombre . " " . $nino->apellidos . "</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="col-4 mx-auto text-center">
                    <input class="btn btn-agregar text-white ms-2" type="submit" name="buscar" value="Buscar"> 
                </div>       
            </form>
        </div>  

        <div class="container">
            <h3 class="mb-3 mt-5 text-center">Lista regalos de <span class="nombre-nino">
                <?php echo (isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : "") . " " . (isset($_SESSION["apellidos"]) ? $_SESSION["apellidos"] : ""); ?>
            </h3>

            <div class="col-7 mx-auto mb-5">
                <table class="table table-striped">
                    <tr>
                        <th class="color-th">Juguetes</th>
                    </tr>
                    
                    <?php
                    $lista_regalos = isset($_SESSION["lista_regalos"]) ? $_SESSION["lista_regalos"] : [];
                    
                    foreach ($lista_regalos as $juguete)
                    {
                        echo "<tr>";
                        echo "<td>" . $juguete["nombreJuguete"] . "</td>";
                        echo "</tr>";
                    }
                
                    ?>
                </table>
            </div>    

            <div class="col-5 mt-5 mx-auto">
                <?php
                // Mensaje: agregar nuevo regalo al niño.
                if (!empty($resultado_agregarRegalo)) 
                {
                    echo "<div class='alert alert-secondary' role='alert'>
                                $resultado_agregarRegalo</div>";
                }
                ?>
            </div> 

            <h3 class="mb-3 text-center">Añadir Nuevo Juguete</h3>
    
            <form action="agregar_regalo_nino.php" method="post">
                <input type="hidden" name="idNino" value="<?php echo (isset($_SESSION["id"]) ? $_SESSION["id"] : ""); ?>">
        
                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nuevo_regalo">Juguete:</label>
                    <select name="regalos" id="regalos">
                        <option disabled selected>Selecciona un juguete...</option>

                        <?php
                        foreach ($regalos as $regalo)
                        {
                            echo "<option value='" . $regalo->id . " " . $regalo->nombre . "'>" . $regalo->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>    

                <div class="col-4 mx-auto text-center">
                    <input class="btn btn-agregar text-white" type="submit" name="agregar_regalo" value="Agregar Juguete">
                </div>        
            </form>   
        </div>    
    </body>
</html>