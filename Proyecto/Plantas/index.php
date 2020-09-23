<?php
session_start();

if (isset($_SESSION["admin"])) {
    echo '<div class="inner"><br/>
      <h3 class="masthead-brand" style="color: darkslategrey; font-size: 16px; text-indent: 80%">
      Sesión iniciada como:  ' . $_SESSION["admin"].'</h3>
      <h3 style="text-indent: 85%"><button onclick="window.location.href = \'cerrarsesion.php\';" class="selectionbox-css">Cerrar sesión</button></h3></div><br><br>';
}else{
    echo '<div class="inner"><br/>
      <h3 style="text-indent: 87.5%"><button onclick="window.location.href = \'iniciosesion.php\';" class="selectionbox-css">Iniciar Sesión</button></h3></div>';
}

require_once('class/planta.php');
require_once('class/colorFlor.php');

$planta = new Planta();
$color = new ColorFlor();

$todasPlantas = $planta->todasPlantas();
$todosTipos = $planta->tipos();
$todasFormas = $planta->formasHoja();
$todasPersistencias = $planta->persistencias();

$colores = $color->todosColores();

?>

<html>

<head>
    <title>Mis queridas plantitas</title>
    <link rel="stylesheet" type="text/css" href="bonito.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>



<body class="indexbg-css">
<div class="text-center" style="vertical-align: center ;">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" >
<main role="main" class="inner cover rounded" style="background-color: white; width: 1000px;margin: 2cm auto;">
<h1 class="cover-heading" style="font-style: oblique; color: #13673d">Veo, veo en San Amaro una plantita...</h1>

<form method="post" enctype="multipart/form-data" action="" >

    <select name="InputTipo" class="soflow-color">
        <option value="">Tipo</option>
        <?php
        while ($fila = $todosTipos->fetch_array())
            echo '<option value="' . $fila["tipo"] . '">' . $fila["tipo"] . '</option>';
        ?>
    </select>

    <select name="InputFormaHoja" class="soflow-color">
        <option value="">Forma hoja</option>
        <?php
        while ($fila = $todasFormas->fetch_array())
            echo '<option value="' . $fila["forma_hoja"] . '">' . $fila["forma_hoja"] . '</option>';
        ?>
    </select>

    <select name="InputPersistencia" class="soflow-color">
        <option value="">Persistencia</option>
        <?php
        while ($fila = $todasPersistencias->fetch_array())
            echo '<option value="' . $fila["persistencia"] . '">' . $fila["persistencia"] . '</option>';
        ?>
    </select>

    <select name="InputColorFlor" class="soflow-color">
        <option value="">Color flor</option>
        <?php
        while ($fila = $colores->fetch_array())
            echo '<option value="' . $fila["color_flor"] . '">' . $fila["color_flor"] . '</option>';
        ?>
    </select>

    <br/><br/>
    <input type="submit" value="Buscar" name="SubmitPlanta" class="selectionbox1-css">
</form>

<?php

echo '<b>Tipo:</b> ';
if (!isset($_POST['InputTipo']) || $_POST['InputTipo'] == '') {
    echo ' - &emsp;';
} else {
    echo $_POST['InputTipo'] . '&emsp;';
}
echo '<b>Forma hoja:</b> ';
if (!isset($_POST['InputFormaHoja']) || $_POST['InputFormaHoja'] == '') {
    echo ' - &emsp;';
} else {
    echo $_POST['InputFormaHoja'] . '&emsp;';
}
echo '<b>Persistencia:</b> ';
if (!isset($_POST['InputPersistencia']) || $_POST['InputPersistencia'] == '') {
    echo ' - &emsp;';
} else {
    echo $_POST['InputPersistencia'] . '&emsp;';
}
echo '<b>Color de la flor:</b> ';
if (!isset($_POST['InputColorFlor']) || $_POST['InputColorFlor'] == '') {
    echo ' - &emsp; <br><br>';
} else {
    echo $_POST['InputColorFlor'] . '&emsp;<br><br>';
}
if (isset($_POST['InputTipo']) && $_POST['InputTipo'] != '') {

    if (isset($_POST['InputFormaHoja']) && $_POST['InputFormaHoja'] != '') {
        if (isset($_POST['InputPersistencia']) && $_POST['InputPersistencia'] != '') {
            $resultado = $planta->buscarConTresDatos('forma_hoja', $_POST['InputFormaHoja'], 'tipo', $_POST['InputTipo'], 'persistencia', $_POST['InputPersistencia']);
        } else {
            $resultado = $planta->buscarConDosDatos('tipo', $_POST['InputTipo'], 'forma_hoja', $_POST['InputFormaHoja']);
        }
    } else if (isset($_POST['InputPersistencia']) && $_POST['InputPersistencia'] != '') {
        $resultado = $planta->buscarConDosDatos('tipo', $_POST['InputTipo'], 'persistencia', $_POST['InputPersistencia']);
    } else {
        $resultado = $planta->buscarConUnDato('tipo', $_POST['InputTipo']);
    }

    if ($resultado == '2') {
        echo '<script> alert("No se obtuvieron resultados"); </script>';
    } else {

        while ($fila = $resultado->fetch_array()) {
            if (isset($_POST['InputColorFlor']) && $_POST['InputColorFlor'] != '') {
                if ($color->esColor($fila['genero'], $fila['especie'], $_POST['InputColorFlor']) == '0') {
                    echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
                }
            } else {
                echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
            }
        }
    }
} else if (isset($_POST['InputFormaHoja']) && $_POST['InputFormaHoja'] != '') {

    if (isset($_POST['InputPersistencia']) && $_POST['InputPersistencia'] != '') {
        $resultado = $planta->buscarConDosDatos('forma_hoja', $_POST['InputFormaHoja'], 'persistencia', $_POST['InputPersistencia']);
    } else {
        $resultado = $planta->buscarConUnDato('forma_hoja', $_POST['InputFormaHoja']);
    }

    if ($resultado == '2') {
        echo '<script> alert("No se obtuvieron resultados"); </script>';
    } else {
        while ($fila = $resultado->fetch_array()) {
            if (isset($_POST['InputColorFlor']) && $_POST['InputColorFlor'] != '') {
                if ($color->esColor($fila['genero'], $fila['especie'], $_POST['InputColorFlor']) == '0') {
                    echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
                }
            } else {
                echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
            }
        }
    }

} else if (isset($_POST['InputPersistencia']) && $_POST['InputPersistencia'] != '') {

    $resultado = $planta->buscarConUnDato('persistencia', $_POST['InputPersistencia']);

    if ($resultado == '2') {
        echo '<script> alert("No se obtuvieron resultados"); </script>';
    } else {
        while ($fila = $resultado->fetch_array()) {
            if (isset($_POST['InputColorFlor']) && $_POST['InputColorFlor'] != '') {
                if ($color->esColor($fila['genero'], $fila['especie'], $_POST['InputColorFlor']) == '0') {
                    echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
                }
            } else {
                echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
            }
        }
    }

} else if (isset($_POST['InputColorFlor']) && $_POST['InputColorFlor'] != '') {

    $resultado = $planta->todasPlantas();

    if ($resultado == '2') {
        echo '<script> alert("No se obtuvieron resultados"); </script>';
    } else {
        while ($fila = $resultado->fetch_array()) {
            if (isset($_POST['InputColorFlor']) && $_POST['InputColorFlor'] != '') {
                if ($color->esColor($fila['genero'], $fila['especie'], $_POST['InputColorFlor']) == '0') {
                    echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
                }
            }
        }
    }

}else if (isset($_REQUEST['SubmitPlanta'])){
    $resultado = $planta->todasPlantas();

    while ($fila = $resultado->fetch_array()) {

                echo '<a href="mostrarplanta.php?genero=' . $fila['genero'] . '&especie=' . $fila['especie'] . '">' . $fila['genero'] . ' ' . strtolower($fila['especie']) . '</a><br><br>';
    }
}

?>

<?php

if(isset($_SESSION["admin"])) {
    echo '<button onclick="window.location.href = \'admin.php\';" class="selectionbox1-css">Administrar</button>&emsp;';
}
?>

<button onclick="window.location.href = 'mostrarplanta.php';" class="selectionbox1-css">Consultar </button>
    <br><br>
</main>
</div>
</div>
</body>
</html>