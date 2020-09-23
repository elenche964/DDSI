<?php

require_once ('class/Planta.php');

$planta = new Planta();

if(isset($_GET['tipo_id']) && !empty($_GET['tipo_id'])){

    echo '<option value="">' . $_GET['tipo_id'] . '</option>';

    $mostrarFormasHoja = $planta->misPersistenciasTipo($_GET['tipo_id']);

    while ($fila = $mostrarFormasHoja->fetch_array())
        echo '<option value="' . $fila['forma_hoja'] . '">' . $fila['forma_hoja'] . '</option>';
}

?>

