<?php

session_start();
include("claseNinos.php");

// Consulta.
$nino = new Ninos();
$lista_ninos = $nino->consulta();

// Mensaje: insertar.
$resultado_agregar = isset($_COOKIE["resultado_agregar"]) ? $_COOKIE["resultado_agregar"] : "";
setcookie("resultado_agregar", "", time() - 3600);

// Mensaje: modificar.
$resultado_modificar = isset($_COOKIE["resultado_modificar"]) ? $_COOKIE["resultado_modificar"] : "";
setcookie("resultado_modificar", "", time() - 3600);

// Mensaje: borrar.
$resultado_borrar = isset($_COOKIE["resultado_borrar"]) ? $_COOKIE["resultado_borrar"] : "";
setcookie("resultado_borrar", "", time() - 3600);

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
            <h3 class="mb-5 text-center py-2 h3">Listado de Niños</h3>

            <div class="row align-items-center">
                <div class="col-5">
                    <a href="./index.php" class="text-black"><button type="button" class="btn btn-inicio mb-3 me-2">
                        <i class="bi bi-house"></i>
                    </button></a>
                    <a href="./insertar_nino.php" class="text-white"><button class="btn btn-agregar mb-3" type="button">+ Añadir niño</button></a>
                </div>
                <div class="col-7">
                    <?php
                    // Mensaje: insertar.
                    if (!empty($resultado_agregar)) 
                    {
                        echo "<div class='alert alert-secondary' role='alert'>
                                $resultado_agregar</div>";
                    }   
                    ?>

                    <?php
                    // Mensaje: modificar.
                    if (!empty($resultado_modificar)) 
                    {
                        echo "<div class='alert alert-secondary' role='alert'>
                                $resultado_modificar</div>";
                    }
                    ?>

                    <?php
                    // Mensaje: borrar.
                    if (!empty($resultado_borrar)) 
                    {
                        echo "<div class='alert alert-secondary' role='alert'>
                                $resultado_borrar</div>";
                    }
                    ?>
                </div>
            </div>    

            <table class="table table-striped">
                <tr>
                    <th class="color-th">Nombre</th>
                    <th class="color-th">Apellidos</th>
                    <th class="color-th">Fecha Nacimiento</th>
                    <th class="color-th">Bueno</th> 
                    <th class="color-th"></th>
                    <th class="color-th"></th>
                </tr>

                <?php
                foreach ($lista_ninos as $nino) 
                {
                    echo "<tr>";
                    echo "<td>" . $nino->nombre . "</td>";
                    echo "<td>" . $nino->apellidos . "</td>";
                    echo "<td>" . $nino->fechaNacimiento . "</td>";

                    $comportamiento = $nino->bueno;
                    if ($comportamiento == 0)
                    {
                        echo "<td>No</td>";
                    }
                    else
                    {
                        echo "<td>Sí</td>";
                    }
                ?>    
                
                    <td>
                    <form action="modificar_nino.php" method="post">
                        <input type="hidden" name="idNino" value="<?php echo $nino->id ?>">
                        <input type="hidden" name="nombre" value="<?php echo $nino->nombre ?>">
                        <input type="hidden" name="apellidos" value="<?php echo $nino->apellidos ?>">
                        <input type="hidden" name="fechaNacimiento" value="<?php echo $nino->fechaNacimiento ?>">
                        <input type="hidden" name="bueno" value="<?php echo $nino->bueno ?>">
                        <button type="submit" class="btn btn-editar" name="editar_nino" value="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </form>
                    </td>

                    <td>
                    <form action="borrar_nino.php" method="post">
                        <input type="hidden" name="idNino" value="<?php echo $nino->id ?>">
                        <button class="btn btn-borrar" type="submit" name="eliminar_nino" value="Eliminar">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                    </td>
            
                <?php
                } 
                ?>

                </tr>
            </table>
        </div>
    </body>
</html>    