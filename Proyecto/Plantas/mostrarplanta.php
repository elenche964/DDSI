<?php

require_once('class/planta.php');
require_once('class/genero.php');
require_once ('class/colorFlor.php');
require_once ('class/origen.php');
require_once ('class/multiplicacion.php');
require_once ('class/imagen.php');

$planta = new Planta();
$genero = new Genero();
$color = new ColorFlor();
$origen = new Origen();
$multiplicacion = new Multiplicacion();
$fotos = new Imagen();

$todasPlantas = $planta->todasPlantas();
$todosGeneros = $genero->todosGeneros();

?>

<html>
<head>
    <title><?php
        if (isset($mostrarGenero) && isset($mostrarEspecie)){
            echo $mostrarGenero . ' ' . $mostrarEspecie;
        } else {
            echo 'Consulta';
        } ?></title>
    <link rel="stylesheet" type="text/css" href="bonito.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body class="indexbg-css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#Genero').change(function(){
            var generoID = $(this).val();
            if(generoID){
                $.ajax({
                    type:'GET',
                    url:'generoespecieAjax.php',
                    data: 'genero_id='+generoID,
                    success:function(html){
                        $('#Especie').html(html);
                    }
                });
            }
        });
    });
</script>
<div class="text-center" style="vertical-align: center ;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" >
        <main role="main" class="inner cover rounded" style="background-color: white; width: 700px;margin: 0 auto;">
<form method="post" enctype="multipart/form-data" action="">
    <br/>
    <?php echo '&emsp;';?>
    <select name="InputGenero" id="Genero" class="soflow-color" style="width: 200px;font-size: 15px">
        <option value="" disabled selected>Genero</option>
        <?php
        while ($fila = $todosGeneros->fetch_array()) {
            if($fila["genero"]==$_POST['InputGenero']){
                echo '<option value="' . $fila["genero"].'" selected="selected">' . $fila["genero"]. '</option>';
            }else
                echo '<option value="' . $fila["genero"].'">' . $fila["genero"]. '</option>';
        }
        ?>
    </select>
    <select name="InputEspecie" id="Especie" placeholder="Especie" class="soflow-color" style="width: 200px;font-size: 15px">
        <option value="">Elija un género</option>;
    </select>
    <?php echo '&emsp;';?>
    <input type="submit" value="Consultar" name="SubmitPlanta" class="selectionbox1-css">
</form>


<button onclick="window.location.href = 'index.php';" class="selectionbox1-css">Volver</button>
            <br/><br/>
        </main>
    </div>
</div>
</body>
</html>
<?php

if (isset($_REQUEST['SubmitPlanta'])) {
    $param = "genero=".$_POST['InputGenero']."&especie=".$_POST['InputEspecie'];
    header("Location: mostrarplanta.php?$param");

}

if(isset($_GET['genero']) && isset($_GET['especie'])) {
    $mostrarGenero = $_GET['genero'];
    $mostrarEspecie = $_GET['especie'];

}

if (isset($mostrarGenero) && isset($mostrarEspecie)) {

    echo '<div class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" style="margin: 0 auto" >
<main role="main" class="inner cover rounded" style="background-color: white; width: 800px;margin: -12cm auto;">
<h1 class="cover-heading" style="font-size: 30px; color: #13673d"><br>Consultando <i>'.$mostrarGenero.' '.strtolower($mostrarEspecie).'</i></h1>

    <main role="main" class="inner cover rounded" style="background-color: transparent;text-align: left; width: 600px;margin: 0 auto;"><br/>
    <div class="inner cover rounded" style="background-color: transparent; text-align: center; width: 600px;"><br/>';
    $imagenes = $fotos->misImagenes($mostrarGenero, $mostrarEspecie);

    if($imagenes != '1') {
        while ($fila = $imagenes->fetch_array()) {
            echo '<img src="images/' . $fila["imagen"] . '" height="180" width="180"/> &emsp;';//Mostrar imagen
        }
    }

    echo "</div><br><br><b>Taxonomía:</b><br>";

    $resultadoTaxonomia = $genero->Taxonomia($mostrarGenero); //Taxonomía desde género porque puede que no haya especies(Metrosideros)

    if (isset($mostrarEspecie) && $planta->miGenero($mostrarEspecie) == $mostrarGenero) {
        echo "&emsp;Especie: " . $mostrarGenero . ' ' . strtolower($mostrarEspecie);

        $datos = $planta->misDatos($mostrarGenero, $mostrarEspecie);
        $fruto = $genero->miFruto($mostrarGenero);
        $forma = $genero->miForma($mostrarGenero);

        $datos = $datos->fetch_array();
        $fruto = $fruto->fetch_array();


        if($datos["tipo"]!='false'){
            echo  "<br><br>".'<b>Tipo:</b> '. $datos['tipo'];
        }

        if($datos["forma_hoja"]!='false' || $datos["disposicion_hoja"]!='false' || $datos["persistencia"]!='false' )
            echo "<br><br><b>Hoja:</b>" ;

        if($datos["forma_hoja"]!='false')
            echo "<br>&emsp;Forma: " . $datos["forma_hoja"];
        if($datos["disposicion_hoja"]!='false')
            echo "<br>&emsp;Disposicion: " . $datos["disposicion_hoja"];
        if($datos["persistencia"]!='false')
            echo "<br>&emsp;Persistencia: " . $datos["persistencia"];
        if($fruto["fruto"]!='false')
            echo"<br><br><b>Fruto:</b> " . $fruto["fruto"];

        echo "<br><br><b>Flor:</b> ";

        $misColores = $color->misColores($mostrarGenero,$mostrarEspecie);

        if($misColores != '1' && $misColores != '2'){
            echo '<br>&emsp;Color: ';
            while($fila = $misColores->fetch_array()){
                echo $fila['color_flor'] . ', ';
            }
        }

        if($forma != '1' && $forma != '2'){
            echo '<br>&emsp;Forma: ';
            while ($fila = $forma->fetch_array()) {
                if ($fila['forma_flor'] != 'false') {
                    echo $fila['forma_flor'];
                } else if($fila['forma_flor_masculina']!='false' && $fila['forma_flor_femenina']!='false'){
                    echo '<br>&emsp;&emsp;Flor masculina: ' . $fila['forma_flor_masculina'];
                    echo '<br>&emsp;&emsp;Flor femenina: ' . $fila['forma_flor_femenina'];

                }
            }

        }

        if($datos["disposicion_flor"]!='false')
            echo "<br>&emsp;Disposición: " . $datos["disposicion_flor"];

        if($datos["n_petalos"]!='-1')
            echo "<br>&emsp;Número de pétalos: " . $datos["n_petalos"];

        if($datos["tam"]!='-1')
            echo "<br><br><b>Tamaño: </b>" . $datos["tam"]. "cm";

        $misOrigenes = $origen->misOrigenes($mostrarGenero,$mostrarEspecie);

        if($misOrigenes != '1' && $misOrigenes != '2'){
            echo '<br><br><b>Origen: </b>';
            while($fila = $misOrigenes->fetch_array()){
                echo $fila['origen'] . ', ';
            }
        }

        echo "<br><br><b>Ciclo reproductivo:</b><br>";

        echo "&emsp;Floración: " . date('F', mktime(0,0,0,$datos["floracion_inicio"])) . '-' . date('F', mktime(0,0,0,$datos["floracion_fin"]))."<br>";
        echo "&emsp;Maduracion: " . date('F', mktime(0,0,0,$datos["maduracion_inicio"])) . '-' . date('F', mktime(0,0,0,$datos["maduracion_fin"]))."<br>";

        $misMultiplicaciones = $multiplicacion->misMultiplicaciones($mostrarGenero,$mostrarEspecie);

        if($misMultiplicaciones != '1' && $misMultiplicaciones != '2'){
            echo '<br/><b>Multiplicación: </b>';
            while($fila = $misMultiplicaciones->fetch_array()){
                echo $fila['multiplicacion'] . ', ';
            }
        }

    }
    echo "<br><br></main></main></div></div>";
} //Mostrar todos los datos

?>