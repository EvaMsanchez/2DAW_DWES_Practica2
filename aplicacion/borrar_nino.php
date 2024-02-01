<?php

session_start();
include("claseNinos.php");

$nino = new Ninos();

// Borrar.
if (isset($_POST["eliminar_nino"]))
{
    $id = $_POST["idNino"];

    $resultado_borrar = $nino->borrarNino($id);
    setcookie("resultado_borrar", $resultado_borrar, time() + 3); // Caducará en 3 segundos.

    header("Location: ninos.php");
}

?>