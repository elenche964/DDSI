<?php
//Tengo que comprobar sesion iniciada (isset $_SESSION["admin"])
session_start();

if(!isset($_SESSION["admin"]))
    header('Location: iniciosesion.php');

require_once('class/clase.php');
require_once('class/subclase.php');
require_once ('class/orden.php');
require_once ('class/familia.php');
require_once ('class/genero.php');

$clase = new Clase();
$subclase = new Subclase();
$orden = new Orden();
$familia = new Familia();
$genero = new Genero();

if(isset($_REQUEST['SubmitClase'])){

    if($clase->crearClase(ucfirst($_POST["InputClase"]))==0){
        echo "Clase creada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['SubmitClaseEditada'])){

    if($clase->editarClase($_POST["InputClaseAntigua"],ucfirst ($_POST["InputClaseNueva"] ))==0){
        echo "Clase editada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['DeleteClase'])){

    if($clase->eliminarClase($_POST["InputClaseEliminar"])==0){
        echo "Clase eliminada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['SubmitSubclase'])){

    if($subclase->crearSubclase(ucfirst ($_POST["InputSubclase"] ), $_POST["InputClase"])==0){
        echo "Subclase creada";
    }else{
        echo "Error durante la creación";
    }
}

if(isset($_REQUEST['SubmitSubclaseEditada'])){

    if($subclase->editarSubclase($_POST["InputSubclaseAntigua"], ucfirst($_POST["InputSubclaseNueva"]))==0){
        echo "Subclase editada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['DeleteSubclase'])){

    if($subclase->eliminarSubclase($_POST["InputSubclaseEliminar"])==0){
        echo "Subclase eliminada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['SubmitOrden'])){

    if($orden->crearOrden(ucfirst($_POST["InputOrden"]), $_POST["InputSubclase"])==0){
        echo "Orden creado";
    }else{
        echo "Error durante la creación";
    }
}

if(isset($_REQUEST['SubmitOrdenEditado'])){

    if($orden->editarOrden($_POST["InputOrdenAntiguo"],ucfirst($_POST['InputOrdenNuevo']))==0){
        echo "Orden editado";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['DeleteOrden'])){

    if($orden->eliminarOrden($_POST["InputOrdenEliminar"])==0){
        echo "Orden eliminado";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['SubmitFamilia'])){

    if($familia->crearFamilia(ucfirst($_POST["InputFamilia"]), $_POST["InputOrden"])==0){

        $familia = $_POST['InputFamilia'];

        $param = "genero=" . $familia;
        header("Location: editarfamilia.php?$param");

    }else{
        echo "Error durante la creación";
    }
}

if(isset($_REQUEST['SubmitFamiliaEditar'])){
    $familia = $_POST['InputFamiliaEditar'];
    $param = "familia=" . $familia;
    header("Location: editarfamilia.php?$param");
}

if(isset($_REQUEST['DeleteFamilia'])){

    if($familia->eliminarFamilia($_POST["InputFamiliaEliminar"])==0){
        echo "Familia eliminada";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['SubmitGenero'])){

    if($genero->crearGenero(ucfirst($_POST["InputGenero"]), $_POST["InputFamilia"])==0){
        echo "Género creado";
    }else{
        echo "Error durante la creación";
    }
}

if(isset($_REQUEST['SubmitGeneroEditado'])){

    if($genero->editarGenero($_POST["InputGeneroAntiguo"],ucfirst($_POST['InputGeneroNuevo']))==0){
        echo "Género editado";
    }else{
        echo "Algo ha fallado";
    }
}

if(isset($_REQUEST['DeleteGenero'])){

    if($genero->eliminarGenero($_POST["InputGeneroEliminar"])==0){
        echo "Género eliminado";
    }else{
        echo "Algo ha fallado";
    }
}

?>

<html>
<head>
    <title>Cosillas de taxonomía</title>
</head>

<body>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputClase">Nueva clase</label>
    <input type="text" name="InputClase" placeholder="Clase" required>
    <input type="submit" value="Insertar" name="SubmitClase">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputClase">Cambiar clase</label>
    <select name="InputClaseAntigua">
        <option value="" disabled selected>Clase a cambiar</option>
        <?php
        $todasClases = $clase->todasClases();
        while($fila = $todasClases->fetch_array()){
            echo '<option value="'.$fila["clase"].'">'.$fila["clase"].'</option>';
        }
        ?>
    </select>
    <input type="text" name="InputClaseNueva" placeholder="Clase Nueva" required>
    <input type="submit" value="Editar" name="SubmitClaseEditada">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputClase">Eliminar clase</label>
    <select name="InputClaseEliminar">
        <option value="" disabled selected>Clase a eliminar</option>
        <?php
        $todasClases = $clase->todasClases();
        while($fila = $todasClases->fetch_array()){
            echo '<option value="'.$fila["clase"].'">'.$fila["clase"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Eliminar" name="DeleteClase">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputSubclase">Nueva Subclase</label>
    <input type="text" name="InputSubclase" placeholder="Subclase" required>
    <select name="InputClase">
        <option value="" disabled selected>Clase</option>
        <?php
        $todasClases = $clase->todasClases();
        while($fila = $todasClases->fetch_array()){
            echo '<option value="'.$fila["clase"].'">'.$fila["clase"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Añadir" name="SubmitSubclase">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputSubclase">Cambiar subclase</label>
    <select name="InputSubclaseAntigua">
        <option value="" disabled selected>Subclase a cambiar</option>
        <?php
        $todasSubclases = $subclase->todasSubclases();
        while($fila = $todasSubclases->fetch_array()){
            echo '<option value="'.$fila["subclase"].'">'.$fila["subclase"].'</option>';
        }
        ?>
    </select>
    <input type="text" name="InputSubclaseNueva" placeholder="Subclase Nueva" required>
    <input type="submit" value="Editar" name="SubmitSubclaseEditada">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputClase">Eliminar subclase</label>
    <select name="InputSubclaseEliminar">
        <option value="" disabled selected>Subclase a eliminar</option>
        <?php
        $todasSubclases = $subclase->todasSubclases();
        while($fila = $todasSubclases->fetch_array()){
            echo '<option value="'.$fila["subclase"].'">'.$fila["subclase"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Eliminar" name="DeleteSubclase">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputOrden">Nuevo orden</label>
    <input type="text" name="InputOrden" placeholder="Orden" required>
    <select name="InputSubclase">
        <option value="" disabled selected>Subclase</option>
        <?php
        $todasSubclases = $subclase->todasSubclases();
        while($fila = $todasSubclases->fetch_array()){
            echo '<option value="'.$fila["subclase"].'">'.$fila["subclase"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Añadir" name="SubmitOrden">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputSubclase">Cambiar orden</label>
    <select name="InputOrdenAntiguo">
        <option value="" disabled selected>Orden a cambiar</option>
        <?php
        $todosOrdenes = $orden->todosOrden();
        while($fila = $todosOrdenes->fetch_array()){
            echo '<option value="'.$fila["orden"].'">'.$fila["orden"].'</option>';
        }
        ?>
    </select>
    <input type="text" name="InputOrdenNuevo" placeholder="Orden Nuevo" required>
    <input type="submit" value="Editar" name="SubmitOrdenEditado">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputOrden">Eliminar orden</label>
    <select name="InputOrdenEliminar">
        <option value="" disabled selected>Orden a eliminar</option>
        <?php
        $todosOrdenes = $orden->todosOrden();
        while($fila = $todosOrdenes->fetch_array()){
            echo '<option value="'.$fila["orden"].'">'.$fila["orden"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Eliminar" name="DeleteOrden">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputFamilia">Nueva familia</label>
    <input type="text" name="InputFamilia" placeholder="Familia" required>
    <select name="InputOrden">
        <option value="" disabled selected>Orden</option>
        <?php
        $todosOrdenes = $orden->todosOrden();
        while($fila = $todosOrdenes->fetch_array()){
            echo '<option value="'.$fila["orden"].'">'.$fila["orden"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Añadir" name="SubmitFamilia">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputFamilia">Editar familia</label>
    <select name="InputFamiliaEditar">
        <option value="" disabled selected>Familia a editar</option>
        <?php
        $todasFamilias = $familia->todasFamilias();
        while($fila = $todasFamilias->fetch_array()){
            echo '<option value="'.$fila["familia"].'">'.$fila["familia"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Editar" name="SubmitFamiliaEditar">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputFamilia">Eliminar familia</label>
    <select name="InputFamiliaEliminar">
        <option value="" disabled selected>Familia a eliminar</option>
        <?php
        $todasFamilias = $familia->todasFamilias();
        while($fila = $todasFamilias->fetch_array()){
            echo '<option value="'.$fila["familia"].'">'.$fila["familia"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Eliminar" name="DeleteFamilia">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputGenero">Nuevo Género</label>
    <input type="text" name="InputGenero" placeholder="Género" required>
    <select name="InputFamilia">
        <option value="" disabled selected>Familia</option>
        <?php
        $todasFamilias = $familia->todasFamilias();
        while($fila = $todasFamilias->fetch_array()){
            echo '<option value="'.$fila["familia"].'">'.$fila["familia"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Añadir" name="SubmitGenero">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputGenero">Cambiar género</label>
    <select name="InputGeneroAntiguo">
        <option value="" disabled selected>Género a cambiar</option>
        <?php
        $todosGeneros = $genero->todosGeneros();
        while($fila = $todosGeneros->fetch_array()){
            echo '<option value="'.$fila["genero"].'">'.$fila["genero"].'</option>';
        }
        ?>
    </select>
    <input type="text" name="InputGeneroNuevo" placeholder="Género nuevo" required>
    <input type="submit" value="Editar" name="SubmitGeneroEditado">
</form>

<form method="post" enctype="multipart/form-data" action="">
    <label for="InputGenero">Eliminar genero</label>
    <select name="InputGeneroEliminar">
        <option value="" disabled selected>Género a eliminar</option>
        <?php
        $todosGeneros = $genero->todosGeneros();
        while($fila = $todosGeneros->fetch_array()){
            echo '<option value="'.$fila["genero"].'">'.$fila["genero"].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Eliminar" name="DeleteGenero">
</form>

<button onclick="window.location.href = 'admin.php';">Volver</button>
</body>
</html>