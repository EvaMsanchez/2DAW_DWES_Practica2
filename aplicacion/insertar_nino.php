<?php

session_start();
include("claseNinos.php");

$nino = new Ninos();

// Insertar.
if (isset($_POST["agregar_nino"]))
{
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    // Convertir "si" o "no" a 1 o 0.
    $bueno = ($_POST["bueno"] == "Sí") ? 1 : 0;

    $resultado_agregar = $nino->agregarNino($nombre, $apellidos, $fechaNacimiento, $bueno);
    setcookie("resultado_agregar", $resultado_agregar, time() + 3); // Caducará en 3 segundos.

    header("Location: ninos.php");
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
            <h3 class="mb-5 text-center py-2 h3">Registrar niño</h3>

            <form action="insertar_nino.php" method="post">
                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Apellidos:</label>
                    <input type="text" name="apellidos" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Fecha de nacimiento:</label>
                    <input type="text" name="fechaNacimiento" placeholder="yyyy-mm-dd" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nombre">Bueno:</label>
                    <select name="bueno" id="bueno" required>
                        <option disabled selected>Selecciona comportamiento...</option>
                        <option value="Sí">Sí</option>
                        <option value="No">No</option>
                    </select>
                </div>    
                
                <div class="col-4 mx-auto text-end">
                    <a href="./ninos.php" class="text-white"><button class="btn btn-secondary mx-2" type="button">Volver</button></a>
                    <input class="btn btn-secondary mx-2" type="reset" value="Limpiar">
                    <input class="btn btn-agregar text-white ms-2" type="submit" name="agregar_nino" value="Registrar">  
                </div>
            </form>
        </div>
    </body>
</html>  