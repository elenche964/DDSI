<?php
require_once('Database.php');
require_once ('planta.php');

class ColorFlor{

    public function nuevoColor($genero, $especie, $color){

        $db = new Database();

        $sql = "INSERT INTO ColorFlor (genero,especie,color_flor) VALUES ('$genero','$especie','$color')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarColor($genero, $especie,$nuevo){

        $db = new Database();

        $sql = "UPDATE ColorFlor SET color='$nuevo' WHERE ColorFlor.genero='$genero' AND ColorFlor.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarColor($especie, $genero){

        $db = new Database();

        $sql = "DELETE FROM ColorFlor WHERE ColorFlor.genero='$genero' AND ColorFlor.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todosColores(){

        $db = new Database();

        $sql = "SELECT DISTINCT color_flor FROM ColorFlor";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if($resultado->num_rows == 0){
            echo "No hay colores en la base de datos";
            return 2;
        }else{
            return $resultado;
        }
    }

    public function esColor($genero, $especie, $color){

        $db = new Database();

        $sql = "SELECT * FROM ColorFlor WHERE genero='$genero' AND especie='".strtolower($especie)."' AND color_flor='$color'";

        $resultado = $db->getDB()->query($sql);

        if ($resultado==TRUE && $resultado->num_rows!=0){
            return 0;
        }else{
            return 1;
        }
    }

    public function misColores($genero, $especie){

        $db = new Database();

        $sql = "SELECT color_flor FROM ColorFlor WHERE genero='$genero' AND especie='$especie'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }else if($resultado->num_rows==0){
            return 2;
        }
            return $resultado;
    }
}
?>