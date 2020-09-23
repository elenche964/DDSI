<?php
session_start();

if (!isset($_SESSION["admin"]))
    header('Location: iniciosesion.php');

require_once('class/planta.php');
require_once ('class/colorFlor.php');
require_once ('class/origen.php');
require_once ('class/multiplicacion.php');
require_once ('class/imagen.php');

$planta = new Planta();
$color = new ColorFlor();
$origen = new Origen();
$multiplicacion = new Multiplicacion();
$imagen = new Imagen();

$misDatos = $planta->misDatos($_GET["genero"], $_GET["especie"]);
$tipos = $planta->tipos();
$formas = $planta->formasHoja();
$persistencias = $planta->persistencias();

$dato = $misDatos->fetch_array();
$imagenes = $imagen->misImagenes($_GET['genero'],$_GET['especie']);

$urlvar = "genero=" . $_GET['genero'] . "&especie=" . $_GET['especie'];

if (isset($_REQUEST['Editar'])) {
    $genero = $_GET["genero"];
    $especie = $_GET["especie"];

    if (isset($_POST['InputTipo'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputTipo'], 'tipo');
    }
    if (isset($_POST['InputForma'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputForma'], 'forma_hoja');
    }
    if (isset($_POST['InputDisposicionHoja']) and !empty($_POST['InputDisposicionHoja'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputDisposicionHoja'], 'disposicion_hoja');
    }
    if (isset($_POST['InputPersistencia'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputPersistencia'], 'persistencia');
    }
    if (isset($_POST['InputColorFlor']) and !empty($_POST['InputColorFlor'])) {
        $color->nuevoColor($genero, $especie, $_POST['InputColorFlor']);
    }
    if (isset($_POST['InputDisposicionFlor']) and !empty($_POST['InputDisposicionFlor'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputDisposicionFlor'], 'disposicion_flor');
    }
    if (isset($_POST['InputPetalos']) and !empty($_POST['InputPetalos'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputPetalos'], 'n_petalos');
    }
    if (isset($_POST['InputTam']) and !empty($_POST['InputTam'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputTam'], 'tam');
    }
    if (isset($_POST['InputOrigen']) and !empty($_POST['InputOrigen'])) {
        $origen->nuevoOrigen($genero, $especie, $_POST['InputOrigen']);
    }

    if (isset($_POST['InputFlorIni']) and !empty($_POST['InputFlorIni'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputFlorIni'], 'floracion_inicio');
    }

    if (isset($_POST['InputFlorFin']) and !empty($_POST['InputFlorFin'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputFlorFin'], 'floracion_fin');
    }

    if (isset($_POST['InputMultIni']) and !empty($_POST['InputMultIni'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputMultIni'],'multiplicaion_inicio');
    }

    if (isset($_POST['InputMultFin']) and !empty($_POST['InputMultFin'])) {
        $planta->editarPlanta($genero, $especie, $_POST['InputMultFin'],'multiplicaion_fin');
    }

    if (isset($_POST['InputMultiplicacion']) and !empty($_POST['InputMultiplicacion'])) {
        $multiplicacion->nuevaMultiplicacion($genero, $especie, $_POST['InputMultiplicacion']);
    }


    header("Refresh:0");
}
?>

<html>
<head>
    <title><?php
        echo $_GET["genero"] . ' ' . $_GET["especie"];
        ?></title>
</head>
<body>

<br>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputEdición"> <?php echo '<b>Editando</b> ' . $_GET["genero"] . ' ' . strtolower($_GET["especie"]) ?><br></label>
    <?php
    echo '<br><b>Tipo:</b>';
    if ($dato["tipo"] != 'false') {
        echo '<br>&emsp;Tipo actual: ' . $dato["tipo"] . '  ';
    }
    echo '<select name="InputTipo" id="Tipo" >
            <option value="" disabled selected>Nuevo tipo</option>';
    while ($fila = $tipos->fetch_array()) {
        echo '<option value="' . $fila["tipo"] . '">' . $fila["tipo"] . '</option>';
    }

    echo '</select><br><br><b>Forma hoja:&emsp;</b>';

    if ($dato["forma_hoja"] != 'false') {
        echo '<br>&emsp;Forma actual: ' . $dato["forma_hoja"] . '  ';
    }
    echo '<select name="InputForma" id="Forma" >
                <option value="" disabled selected>Nueva forma</option>';
    while ($fila = $formas->fetch_array()) {
        echo '<option value="' . $fila["forma_hoja"] . '">' . $fila["forma_hoja"] . '</option>';
    }

    echo '</select><br><br><b>Disposición de la hoja:&emsp;</b>';

    if ($dato["disposicion_hoja"] != 'false') {
        echo '<br>&emsp;Disposición actual: ' . $dato["disposicion_hoja"] . '  ';
    }
    echo '<input type="text" name="InputDisposicionHoja" placeholder="Disposición de la hoja">';

    echo '<br><br><b>Persistencia:</b>&emsp;';

    if ($dato["persistencia"] != 'false') {
        echo '<br>&emsp;Persistencia actual: ' . $dato["persistencia"] . '  ';
    }
    echo '<select name="InputPersistencia" id="Persistencia" >
                    <option value="" disabled selected>Nueva persistencia</option>';
    while ($fila = $persistencias->fetch_array()) {
        echo '<option value="' . $fila["persistencia"] . '">' . $fila["persistencia"] . '</option>';
    }

    echo '</select><br><br><b>Color: </b>';

    $colores = $color->misColores($dato['genero'], $dato['especie']);

    if($colores!='1' && $colores !='2'){
        while($fila = $colores->fetch_array()){
            echo $fila['color_flor'] . ', ';
        }
    }

    echo '<input type="text" name="InputColorFlor" placeholder="Nuevo color flor">';



    echo '<br><br><b>Disposición de la flor:&emsp;</b>';

    if ($dato["disposicion_flor"] != 'false') {
        echo '<br>&emsp;Disposición actual: ' . $dato["disposicion_flor"] . '  ';
    }
    echo '<input type="text" name="InputDisposicionFlor" placeholder="Disposición de la flor">';

    echo '<br><br><b>Número de pétalos:&emsp;</b>';

    if ($dato["n_petalos"] != '-1') {
        echo '<br>&emsp;N actual: ' . $dato["n_petalos"] . '  ';
    }
    echo '<input type="number" name="InputPetalos" placeholder="Número de pétalos" min="0">';

    echo '<br><br><b>Tamaño:&emsp;</b>';

    if ($dato["tam"] != '-1') {
        echo '<br>&emsp;Tam actual: ' . $dato["tam"] . 'cm  ';
    }
    echo '<input type="number" name="InputTam" placeholder="Tamaño (cm)" min="0">';

    echo '<br><br><b>Origen: </b>';

    $origenes = $origen->misOrigenes($dato['genero'], $dato['especie']);

    if($origenes!='1' && $origenes !='2'){
        while($fila = $origenes->fetch_array()){
            echo $fila['origen'] . ', ';
        }
    }

    echo '<input type="text" name="InputOrigen" placeholder="Nuevo origen">';

    echo '<br><br><b>Floración:&emsp;</b>';

    if ($dato["floracion_inicio"] != '0') {
        echo '<br>&emsp;Floración inicio: ' . date('F', mktime(0,0,0,$dato["floracion_inicio"])).'&emsp;';
    }

    echo '<input type="number" name="InputFlorIni" placeholder="Mes inicio" min="1" max="12">';

    if ($dato["floracion_fin"] != '0') {
        echo '<br>&emsp;Floración fin: ' . date('F', mktime(0,0,0,$dato["floracion_fin"])).'&emsp;';
    }

    echo '<input type="number" name="InputFlorFin" placeholder="Mes fin" min="1" max="12">';


    echo '<br><br><b>Maduración:&emsp;</b>';

    if ($dato["maduracion_inicio"] != '0') {
        echo '<br>&emsp;Maduración inicio: ' . date('F', mktime(0,0,0,$dato["maduracion_inicio"])).'&emsp;';
    }
    echo '<input type="number" name="InputMadIni" placeholder="Mes inicio" min="1" max="12">';

    if ($dato["maduracion_fin"] != '0') {
        echo '<br>&emsp;Maduración fin: ' . date('F', mktime(0,0,0,$dato['maduracion_fin'])).'&emsp;';
    }
    echo '<input type="number" name="InputMadFin" placeholder="Mes fin" min="1" max="12">';

    echo '<br><br><b>Multiplicación: </b>';

    $multiplicaciones = $multiplicacion->misMultiplicaciones($dato['genero'], $dato['especie']);

    if($multiplicaciones!='1' && $multiplicaciones !='2'){
        while($fila = $multiplicaciones->fetch_array()){
            echo $fila['multiplicacion'] . ', ';
        }
    }

    echo '<input type="text" name="InputMultiplicacion" placeholder="Nueva Multiplicaión">';
    ?>
    <br><br>
    <input type="submit" value="Editar" name="Editar">
</form>


<form method="post" action="upload.php?<?php echo $urlvar; ?>" enctype="multipart/form-data">
    <div>
        <span>Subir una imagen:</span>
        <input type="file" name="uploadedFile" />
    </div>
    <input onclick="window.location.href = '<?php echo 'upload.php?' . $urlvar; ?>';" type="submit" name="uploadphoto" value="Subir" />
</form>

<?php
if ($imagenes != '1') {
    while ($fila = $imagenes->fetch_array()) {
        echo '<img src="images/' . $fila["imagen"] . '" height="200" width="200"/>
        <form method="POST" action="eliminarimagen.php?imagen='.$fila["imagen"].'" enctype="multipart/form-data">
           <input onclick="window.location.href = \'eliminarimagen.php?imagen='.$fila["imagen"].'\';" type="submit" value="Eliminar" /> 
        </form>';
    }
}
?>

<br/><br/>
<button onclick="window.location.href = '<?php echo 'enviarapapelera.php?' . $urlvar; ?>';">Eliminar(enviar a papelera)
</button>
<button onclick="window.location.href = 'admin.php';">Volver</button>
</body>
</html>
