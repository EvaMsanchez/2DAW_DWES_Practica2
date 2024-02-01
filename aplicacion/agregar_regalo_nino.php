<?php

session_start();
include("claseNinos.php");

$nino = new Ninos();

if (isset($_POST["agregar_regalo"]))
{
    $idNino = $_POST["idNino"];

    if (empty($_POST["regalos"])) 
    {
        $resultado_agregarRegalo = "Por favor, selecciona un regalo antes de agregarlo.";
    }
    else
    {
        $regalo = $_POST["regalos"];
        list($idJuguete, $nombreJuguete) = explode(" ", $regalo, 2);

        // Añadir: nuevo regalo al niño.
        $resultado_agregarRegalo = $nino->agregarNuevoRegalo($idNino, $idJuguete, $nombreJuguete);
        // Consulta: lista regalos ACTUALIZADA del niño seleccionado.
        $_SESSION["lista_regalos"] = $lista_regalos = $nino->consultaRegalos($idNino);
    }

    setcookie("resultado_agregarRegalo", $resultado_agregarRegalo, time() + 3); // Caducará en 3 segundos.
    
    header("Location: busqueda.php");
}

?>