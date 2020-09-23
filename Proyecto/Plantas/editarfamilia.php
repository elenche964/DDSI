<?php
session_start();

if (!isset($_SESSION["admin"]))
header('Location: iniciosesion.php');

if(empty($_GET["familia"])){
    echo 'Por favor, seleccione una familia.<br>
    <meta http-equiv="refresh" content="4;url=http://127.0.0.1/Plantas/nuevaTaxonomia.php" />';
}
require_once('class/familia.php');

$familia = new Familia();

$misDatos = $familia->misDatos($_GET["familia"]);

$dato = $misDatos->fetch_array();


if(isset($_REQUEST['Editar'])){
    $familiaEdit = $_GET["familia"];

    if (isset($_POST['InputFruto'])) {
        $familia->editarFamilia($_POST['InputFruto'], 'fruto', $familiaEdit);
    }
    if (isset($_POST['InputForma'])) {
        $familia->editarFamilia($_POST['InputForma'], 'forma_flor', $familiaEdit);
    }
    if (isset($_POST['InputFormaMasc'])) {
        $familia->editarFamilia($_POST['InputFormaMasc'], 'forma_flor_masculina', $familiaEdit);
    }
    if (isset($_POST['InputFormaFem'])) {
        $familia->editarFamilia($_POST['InputFormaFem'], 'forma_flor_femenina', $familiaEdit);
    }
    header("Refresh:0");
}
?>
<html>
<head>
    <title><?php
        echo $_GET["familia"];
        ?></title>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputEdición"> <?php echo '<b>Editando</b> ' . $_GET["familia"]; ?><br></label>
    <?php
    echo '<br><b>Fruto:</b>';
    if ($dato["fruto"] != 'false') {
        echo '<br>&emsp;Fruto actual: ' . $dato["fruto"]. '  ';
    }
    echo '<input type="text" name="InputFruto" placeholder="Nuevo fruto">';

    echo '<br><b>Forma flor:</b><br>';
    if ($dato["forma_flor"] != 'false') {
        echo '<br>&emsp;Forma actual (ambos sexos): ' . $dato["forma_flor"] . '  ';
    }
    echo '<input type="text" name="InputForma" placeholder="Forma (ambos sexos)"><br>';

    if ($dato["forma_flor_masculina"] != 'false' && $dato["forma_flor_femenina"] != 'false') {
        echo '<br>&emsp;Forma actual (masculina): ' . $dato["forma_flor_masculina"] . '  ';
    }
    echo '<input type="text" name="InputFormaMasc" placeholder="Forma (masculina)">';
    if ($dato["forma_flor_masculina"] != 'false' && $dato["forma_flor_femenina"] != 'false') {
        echo '<br>&emsp;Forma actual (femenina): ' . $dato["forma_flor_femenina"] . ' ';
    }
    echo '<br><input type="text" name="InputFormaFem" placeholder="Forma (femenina)">';
    ?>
    <br><br>
    <input type="submit" value="Editar" name="Editar">
</form>

<br/><br/>
<button onclick="window.location.href = 'nuevaTaxonomia.php';">Volver</button>
</body>
</html>
