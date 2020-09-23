<?php

require_once('class/papelera.php');

$papelera = new Papelera();

if (isset($_GET['genero_id']) && !empty($_GET['genero_id'])) {

    $Especies = $papelera->especiesPapelera($_GET['genero_id']);

    if($Especies == 2){
        echo '<option value="" disabled selected>Elija otro género</option>';
    }

    while ($fila = $Especies->fetch_array()) {
        echo '<option value="' . $fila["especie_p"] . '">' . strtolower($fila["especie_p"]) . '</option>';
    }
}

?>