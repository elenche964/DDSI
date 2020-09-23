<?php

require_once("Database.php");

class User{

    public function soyUsuario($name){

        $db = new Database();

        $sql = "SELECT * FROM Users WHERE user_id='$name' OR mail='$name'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            return 1;
        }

        return 0;
    }

    public function contrasenaCorrecta($passw, $user){

        $db = new Database();

        $sql = "SELECT * FROM Users WHERE password='$passw' AND (user_id='$user' OR mail='$user')";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            return 1;
        }

        return 0;
    }

    public function quienSoy($nombre){

        $db = new Database();

        $sql = "SELECT user_id FROM Users WHERE user_id='$nombre' OR mail='$nombre'";

        $resultado = $db->getDB()->query($sql);

        if (!$resultado || $resultado->num_rows == 0) {
            return 1;
        }

        $miNombre = $resultado->fetch_array();

        return $miNombre;
    }


}
?>