<?php

//Tengo que comprobar sesion iniciada (isset $_SESSION["admin"])
session_start();

if (!isset($_SESSION["admin"]))
    header('Location: iniciosesion.php');

require_once('class/papelera.php');

$papelera = new Papelera();

$todosGeneros = $papelera->generosPapelera();

if(isset($_REQUEST['InputEliminar'])){
    $nota = $papelera->eliminarPlantaDefinitiva($_POST['InputGeneroPapelera'], $_POST['InputEspeciePapelera']);
    if($nota=='1'){
        echo 'Error eliminando';
    }
}

if(isset($_REQUEST['InputRestaurar'])){
    $nota = $papelera->restaurar($_POST['InputGeneroPapelera'], $_POST['InputEspeciePapelera']);
    if($nota=='1'){
        echo 'Error restaurando';
    }
}


?>

<html>
<head>
    <title>Papelera</title>
</head>
<body>

<?php
if(!$todosGeneros){
    echo 'La papelera está vacía, redireccionando a la página del administrador.<br>
    <meta http-equiv="refresh" content="2;url=http://127.0.0.1/Plantas/admin.php" />';
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#Genero').change(function () {
            var generoID = $(this).val();
            if (generoID) {
                $.ajax({
                    type: 'GET',
                    url: 'papeleraAjax.php',
                    data: 'genero_id=' + generoID,
                    success: function (html) {
                        $('#Especie').html(html);
                    }
                });
            }
        });
    });
</script>


<form method="post" enctype="multipart/form-data" action="">
    <label>Planta </label>
    <select name="InputGeneroPapelera" id="Genero">
        <option value="" disabled selected>Género</option>
        <?php
        while ($fila = $todosGeneros->fetch_array()) {
            echo '<option value="' . $fila["genero_p"] . '">' . $fila["genero_p"] . '</option>';
        }
        ?>
    </select>
    <select name="InputEspeciePapelera" id="Especie">
        <option value="">Elija un género</option>;
    </select>
    <br/>
    <input type="submit" name="InputEliminar" value="Eliminar definitivamente">
    <input type="submit" name="InputRestaurar" value="Restaurar">
</form>
<button onclick="window.location.href = 'admin.php';">Volver</button>
</body>
</html>
