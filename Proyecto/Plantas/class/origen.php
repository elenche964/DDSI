<?php
require_once('Database.php');
require_once ('planta.php');

class Origen{

    public function nuevoOrigen($genero, $especie, $origen){

        $db = new Database();

        $sql = "INSERT INTO Origen (genero,especie,origen) VALUES ('$genero','$especie','$origen')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarOrigen($genero, $especie,$nuevo){

        $db = new Database();

        $sql = "UPDATE Origen SET origen='$nuevo' WHERE Origen.genero='$genero' AND Origen.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarOrigen($especie, $genero){

        $db = new Database();

        $sql = "DELETE FROM Origen WHERE Origen.genero='$genero' AND Origen.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function misOrigenes($genero, $especie){

        $db = new Database();

        $sql = "SELECT origen FROM Origen WHERE genero='$genero' AND especie='$especie'";

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