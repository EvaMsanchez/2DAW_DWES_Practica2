<?php

session_start();
include("claseNinos.php");

$nino = new Ninos();

// Modificar.
if (isset($_POST["editar_nino"]))
{
    $id = $_POST["idNino"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
     // Convertir 1 o 0 a "si" o "no".
    $bueno = ($_POST["bueno"] == 1) ? "Sí" : "No";
}

// Recoger datos ya modificados.
if (isset($_POST["guardar_nino"]))
{
    $id = $_POST["idNino"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    // Convertir "si" o "no" a 1 o 0.
    $bueno = ($_POST["bueno"] == "Sí") ? 1 : 0;

    $resultado_modificar = $nino->modificarNino($id, $nombre, $apellidos, $fechaNacimiento, $bueno);
    setcookie("resultado_modificar", $resultado_modificar, time() + 3); // Caducará en 3 segundos.

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
            <h3 class="mb-5 text-center py-2 h3">Editar niño</h3>

            <form action="modificar_nino.php" method="post">
                <input type="hidden" name="idNino" value="<?php echo $id ?>">

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $nombre ?>" required/>
                </div> 

                <div class="col-4 d-flex flex-column mx-auto mb-2">
                    <label for="nombre">Apellidos:</label>
                    <input type="text" name="apellidos" value="<?php echo $apellidos ?>" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-2">    
                    <label for="nombre">Fecha de nacimiento:</label>
                    <input type="text" name="fechaNacimiento" value="<?php echo $fechaNacimiento ?>" placeholder="yyyy-mm-dd" required/>
                </div>

                <div class="col-4 d-flex flex-column mx-auto mb-4">
                    <label for="nombre">Bueno:</label>
                    <select name="bueno" id="bueno">
                        <option disabled selected>Selecciona comportamiento...</option>
                        <option value="Sí" <?php if ($bueno == "Sí") echo "selected"; ?> >Sí</option>
                        <option value="No" <?php if ($bueno == "No") echo "selected"; ?> >No</option>
                    </select>
                </div>    

                <div class="col-4 mx-auto text-end">
                    <a href="./ninos.php" class="text-white"><button class="btn btn-secondary mx-2" type="button">Volver</button></a>
                    <input class="btn btn-agregar text-white ms-2" type="submit" name="guardar_nino" value="Guardar">
                </div>
            </form>
        </div>
    </body>
</html>  