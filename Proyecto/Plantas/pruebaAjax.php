<?php
require_once("class/subclase.php");
require_once("class/clase.php");

$subclase = new Subclase();
$clase = new Clase();

if(isset($_GET['clase_id']) && !empty($_GET['clase_id'])) {

    $mostrarSubclases = $clase->buscarSubclases($_GET['clase_id']);

    echo '<option value="" disabled selected>Elija una subclase</option>';

    while ($fila = $mostrarSubclases->fetch_array())
        echo '<option value="' . $fila["subclase"] . '">' . $fila["subclase"] . '</option>';
}
?>