<?php

session_start();
include("claseRegalos.php");

$regalo = new Regalos();

// Insertar.
if (isset($_POST["agregar_regalo"]))
{
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    // Convertir "Melchor", "Gaspar" o "Baltasar" a 1, 2 o 3.
    if ($_POST["reyes"] == "melchor")
    {
        $rey = 1;
    }
    else if ($_POST["reyes"] == "gaspar")
    {
        $rey = 2;
    }
    else
    {
        $rey = 3;
    }

    $resultado_agregar = $regalo->agregarRegalo($nombre, $precio, $rey);
    setcookie("resultado_agregar", $resultado_agregar, time() + 3); // Caducará en 3 segundos.

    header("Location: regalos.php");
}

?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reyes Magos</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./assets/css/estilos.css"/>
    </head>

    <body>
        <div class="container color">
            <h3 class="mb-5 text-center py-2 h3">Registrar regalo</h3>

            <form action="insertar_regalo.php" method="post">
                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Precio:</label>
                    <input type="text" name="precio" required/>
                </div>    

                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nombre">Rey:</label>
                    <select name="reyes" id="reyes">
                        <option disabled selected>Selecciona un rey...</option>
                        <option value="melchor">Melchor</option>
                        <option value="gaspar">Gaspar</option>
                        <option value="baltasar">Baltasar</option>
                    </select>
                </div>
                    
                <div class="col-4 mx-auto text-end">
                    <a href="./regalos.php" class="text-white"><button class="btn btn-secondary mx-2" type="button">Volver</button></a>
                    <input class="btn btn-secondary mx-2" type="reset" value="Limpiar">
                    <input class="btn btn-agregar text-white ms-2" type="submit" name="agregar_regalo" value="Registrar">
                </div>
            </form>
        </div>
    </body>
</html>  