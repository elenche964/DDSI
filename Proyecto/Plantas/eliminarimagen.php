<?php

require_once ('class/imagen.php');

$imagen = new Imagen();

$image_path='/opt/lampp/htdocs/Plantas/images/';

if(isset($_GET['imagen']) AND !empty($_GET['imagen'])){

    if($imagen->eliminarImagen($_GET['imagen'])==0)
        echo 'Se ha desvinculado la imagen de la base de datos.<br>';

    if(unlink($image_path.$_GET['imagen']))
        echo "Imagen eliminada.";
}
header('Refresh: 3; URL=' . $_SERVER['HTTP_REFERER']);
?>
