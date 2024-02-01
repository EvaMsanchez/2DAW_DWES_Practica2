<?php

session_start();
include("claseRegalos.php");

$regalo = new Regalos();

// Borrar.
if (isset($_POST["eliminar_regalo"]))
{
    $id = $_POST["idJuguete"];

    $resultado_borrar = $regalo->borrarRegalo($id);
    setcookie("resultado_borrar", $resultado_borrar, time() + 3); // Caducará en 3 segundos.

    header("Location: regalos.php");
}

?>