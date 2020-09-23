<?php
session_start();

require_once("class/user.php");

$user = new User();

if(isset($_SESSION["admin"])){
    header('location: admin.php');
}

if(isset($_REQUEST["SubmitUser"])){

    if($user->soyUsuario($_POST['InputUsuario'])==1){
        echo 'Usuario incorrecto';
    }else if($user->soyUsuario($_POST['InputUsuario'])==0){
        if($user->contrasenaCorrecta($_POST['InputContrasena'],$_POST['InputUsuario'])==1){
            echo 'Contraseña incorrecta';
        }else{
            $Yo = $user->quienSoy($_POST['InputUsuario']);

            $_SESSION["admin"]=$Yo['user_id'];

            header('location: admin.php');
        }

    }
}
?>

<html>
<head>
    <title>Inicio de sesión</title>
    <link rel="stylesheet" type="text/css" href="bonito.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body class="indexbg-css">

<div class="text-center" style="vertical-align: center ;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" >
        <main role="main" class="inner cover rounded" style="background-color: white; width: 300px;margin: auto auto;color: #13673d">

<form method="post" enctype="multipart/form-data" action="" clas="">
    <p><label for="InputUser" style="font-size: larger"><br>Inicio de sesión</label></p>
    <p><input type="text" name="InputUsuario" placeholder="usuario" required class="textbox-css"></p>
    <p><input type="password" name="InputContrasena" placeholder="contraseña" required class="textbox-css"></p>
    <br>
    <input type="submit" value="Iniciar sesión" name="SubmitUser" class="selectionbox1-css">
</form>
        <br/>
<button onclick="window.location.href = 'index.php';" class="selectionbox-css" >Volver</button>
            <br/><br/>
        </main>
    </div>
</div>

</body>
</html>
