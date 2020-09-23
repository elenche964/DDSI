<?php
//Tengo que comprobar sesion iniciada (isset $_SESSION["admin"])
session_start();

if(!isset($_SESSION["admin"]))
    header('Location: iniciosesion.php');

require_once('class/genero.php');
require_once('class/planta.php');

$genero = new Genero();
$planta = new Planta();

if(isset($_REQUEST['SubmitNueva'])){

    $especie = $_POST['InputEspecieNueva'];
    $genero = $_POST['InputGeneroCrear'];

    echo $genero.' '.$especie;

    $nueva = $planta->crearPlanta($especie, $genero);

    if($nueva == 1){
        echo "No se puede crear esa especie";
    }else if ($nueva == 0){

        $param = "genero=" . $genero . "&especie=" . $especie;
        header("Location: editar.php?$param");
    }
}

if(isset($_REQUEST['SubmitEditar'])){

    $especie = $_POST['InputEspecieEditar'];
    $genero = $_POST['InputGeneroEditar'];

    $param = "genero=" . $genero . "&especie=" . $especie;
    header("Location: editar.php?$param");
}

if(isset($_REQUEST['Eliminar'])){

    $especie = $_POST['InputEspecieEliminar'];
    $genero = $_POST['InputGeneroEliminar'];

    $param = "genero=" . $genero . "&especie=" . $especie;
    header("Location: enviarapapelera.php?$param");
}

?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="bonito.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <style>
        form{
            background-color:#3a9e19;
            width: 800px;
            margin: 0.26cm auto;
            color: white;
            height: 2cm;
            align-content: center;
            vertical-align: central;
        }
    </style>
</head>

<body class="indexbg-css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#GeneroEditar').change(function(){
            var generoID = $(this).val();
            if(generoID){
                $.ajax({
                    type:'GET',
                    url:'generoespecieAjax.php',
                    data: 'genero_id='+generoID,
                    success:function(html){
                        $('#EspecieEditar').html(html);
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#GeneroEliminar').change(function(){
            var generoID = $(this).val();
            if(generoID){
                $.ajax({
                    type:'GET',
                    url:'generoespecieAjax.php',
                    data: 'genero_id='+generoID,
                    success:function(html){
                        $('#EspecieEliminar').html(html);
                    }
                });
            }
        });
    });
</script>
<div class="text-center" style="vertical-align: center ;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" >
        <main role="main" class="inner cover rounded" style="background-color: white; width: 1000px;margin: 2cm auto;">


<form method="post" enctype="multipart/form-data" action="" class="inner cover rounded">
    <label for="CrearPlanta"><br>Crear</label>
    <select name="InputGeneroCrear" id="GeneroCrear">
        <option value="" disabled selected>Genero</option>
        <?php
        $todosGeneros = $genero->todosGeneros();
        while ($fila = $todosGeneros->fetch_array()) {
            if($fila["genero"]==$_POST['InputGeneroCrear']){
                echo '<option value="' . $fila["genero"].'" selected="selected">' . $fila["genero"]. '</option>';
            }else
                echo '<option value="' . $fila["genero"].'">' . $fila["genero"]. '</option>';
        }
        ?>
    </select>
    <input type="text" name="InputEspecieNueva" placeholder="Nombre Especie" required>
    <input type="submit" value="Crear" name="SubmitNueva">
    <button onclick="window.location.href = 'nuevaTaxonomia.php';">No encuentro mi género</button>
</form>

<form method="post" enctype="multipart/form-data" action="" class="inner cover rounded">
    <label for="EditPlanta"><br>Editar</label>
    <select name="InputGeneroEditar" id="GeneroEditar" >
        <option value="" disabled selected>Genero</option>
        <?php
        $todosGeneros = $genero->todosGeneros();
        while ($fila = $todosGeneros->fetch_array()) {
            if($fila["genero"]==$_POST['InputGeneroEditar']){
                echo '<option value="' . $fila["genero"].'" selected="selected">' . $fila["genero"]. '</option>';
            }else
                echo '<option value="' . $fila["genero"].'">' . $fila["genero"]. '</option>';
        }
        ?>
    </select>
    <select name="InputEspecieEditar" id="EspecieEditar">
        <option value="">Elija un género</option>;
    </select>
    <input type="submit" value="Editar" name="SubmitEditar">
</form>

<form method="post" enctype="multipart/form-data" action="" class="inner cover rounded">
    <label for="EditPlanta"><br>Eliminar</label>
    <select name="InputGeneroEliminar" id="GeneroEliminar" >
        <option value="" disabled selected>Genero</option>
        <?php
        $todosGeneros = $genero->todosGeneros();
        while ($fila = $todosGeneros->fetch_array()) {
            if($fila["genero"]==$_POST['InputGeneroEliminar']){
                echo '<option value="' . $fila["genero"].'" selected="selected">' . $fila["genero"]. '</option>';
            }else
                echo '<option value="' . $fila["genero"].'">' . $fila["genero"]. '</option>';
        }
        ?>
    </select>
    <select name="InputEspecieEliminar" id="EspecieEliminar">
        <option value="">Elija un género</option>;
    </select>
    <input type="submit" value="Eliminar" name="Eliminar">
</form>

<div class="inner cover rounded">
<button onclick="window.location.href = 'gestionarpapelera.php';">Gestionar papelera</button>
<br/><br/>
<button onclick="window.location.href = 'cerrarsesion.php';">Cerrar sesión</button>
<button onclick="window.location.href = 'index.php';">Volver a la página principal</button>
            </div>
        </main>
    </div>
</div>

</body>
</html>
