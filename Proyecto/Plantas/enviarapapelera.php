<?php
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION["admin"]))
    header('Location: iniciosesion.php');

require_once('class/papelera.php');

$papelera = new Papelera();

$envia = $papelera->meterPlantaPapelera($_GET["genero"], $_GET["especie"]);

?>

<html>
<head>
    <title>Redireccionando</title>
</head>
<body>
    <?php
     echo $_GET["genero"].' '.$_GET["especie"].' se ha movido a la papelera.';
    ?>
    <meta http-equiv="refresh" content="2;url=http://127.0.0.1/Plantas/admin.php" />
</body>
</html>
