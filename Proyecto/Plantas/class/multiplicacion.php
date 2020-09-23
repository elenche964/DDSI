<?php
require_once('Database.php');
require_once ('planta.php');

class Multiplicacion{

    public function nuevaMultiplicacion($genero, $especie, $multiplicacion){

        $db = new Database();

        $sql = "INSERT INTO Origen (genero,especie,multiplicacion) VALUES ('$genero','$especie','$multiplicacion')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarMultiplicacion($genero, $especie,$nuevo){

        $db = new Database();

        $sql = "UPDATE Multiplicacion SET multiplicacion='$nuevo' WHERE Multiplicacion.genero='$genero' AND Multiplicacion.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarMultiplicacion($especie, $genero){

        $db = new Database();

        $sql = "DELETE FROM Multiplicacion WHERE Multiplicacion.genero='$genero' AND Multiplicacion.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function misMultiplicaciones($genero, $especie){

        $db = new Database();

        $sql = "SELECT multiplicacion FROM Multiplicacion WHERE genero='$genero' AND especie='$especie'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            return 1;
        }else if($resultado->num_rows==0){
            return 2;
        }
        return $resultado;
    }
}