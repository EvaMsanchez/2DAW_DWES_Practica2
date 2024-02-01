<?php

session_start();
include("claseRegalos.php");

$regalo = new Regalos();

// Modificar.
if (isset($_POST["editar_regalo"]))
{
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    // Convertir 1, 2 o 3 a "Melchor", "Gaspar" o "Baltasar".
    if ($_POST["idRey"] == 1)
    {
        $rey = "Melchor";
    }
    else if ($_POST["idRey"] == 2)
    {
        $rey = "Gaspar";
    }
    else
    {
        $rey = "Baltasar";
    }
}

// Recoger datos ya modificados.
if (isset($_POST["guardar_regalo"]))
{
    $id = $_POST["idJuguete"];
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
   
    $resultado_modificar = $regalo->modificarRegalo($id, $nombre, $precio, $rey);
    setcookie("resultado_modificar", $resultado_modificar, time() + 3); // Caducará en 3 segundos.

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
            <h3 class="mb-5 text-center py-2 h3">Editar regalo</h3>

            <form action="modificar_regalo.php" method="post">
                <input type="hidden" name="idJuguete" value="<?php echo $id ?>">

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $nombre ?>" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Precio:</label>
                    <input type="text" name="precio" value="<?php echo $precio . ' €'?>" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nombre">Rey:</label>
                    <select name="reyes" id="reyes">
                        <option disabled selected>Selecciona un rey...</option>
                        <option value="melchor" <?php if ($rey == "Melchor") echo "selected"; ?> >Melchor</option>
                        <option value="gaspar" <?php if ($rey == "Gaspar") echo "selected"; ?> >Gaspar</option>
                        <option value="baltasar" <?php if ($rey == "Baltasar") echo "selected"; ?> >Baltasar</option>
                    </select>
                </div>  
                    
                <div class="col-4 mx-auto text-end">
                    <a href="./regalos.php" class="text-white"><button class="btn btn-secondary mx-2" type="button">Volver</button></a>
                    <input class="btn btn-agregar text-white ms-2" type="submit" name="guardar_regalo" value="Guardar">
                </div>
            </form>
        </div>
    </body>
</html> 