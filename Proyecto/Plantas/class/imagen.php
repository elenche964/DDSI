<?php

require_once ('Database.php');
require_once ('planta.php');


class Imagen{

    public function subirImagen($genero, $especie, $url){

        $db = new Database();

        $sql = "INSERT INTO Imagen (genero, especie, imagen) VALUES ('$genero', '$especie', '$url')";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }else if ($resultado == TRUE){
            return 0;
        }
    }

    public function cuantasImagenesTengo($genero, $especie){

        $db = new Database();

        $sql = "SELECT count(*) as suma FROM Imagen WHERE Imagen.genero='$genero' AND Imagen.especie='$especie'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }

        return ($resultado->fetch_array())['suma'];
    }

    public function misImagenes($genero, $especie){

        $db = new Database();

        $sql = "SELECT * FROM Imagen WHERE Imagen.genero='$genero' AND Imagen.especie = '$especie'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows==0){
            return 1;
        }
        return $resultado;
    }

    public function yaExisto($nombre){

        $db = new Database();

        $sql = "SELECT imagen FROM Imagen WHERE Imagen.imagen='$nombre'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }else if($resultado->num_rows==0){
            return 2;
        }

        return 0;
    }

    public function eliminarImagen($nombre){

        $db = new Database();

        $sql = "DELETE FROM Imagen WHERE Imagen.imagen='$nombre'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }

        return 0;
    }
}
?>