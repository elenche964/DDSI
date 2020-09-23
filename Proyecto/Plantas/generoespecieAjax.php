<?php

require_once('class/planta.php');

$planta = new Planta();

if (isset($_GET['genero_id']) && !empty($_GET['genero_id'])) {

    $Especies = $planta->todasMisEspecies($_GET['genero_id']);

    if($Especies == 2){
        echo '<option value="" disabled selected>Elija otro género</option>';
    }

    while ($fila = $Especies->fetch_array()) {
        echo '<option value="' . $fila["especie"] . '">' . strtolower($fila["especie"]) . '</option>';
    }
}

?>