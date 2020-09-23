<?php

require_once ('Database.php');

class Subclase{
    
    public function crearSubclase($nombre, $clase){
        
        $db = new Database();

        $sql = "INSERT INTO Subclase (subclase, clase) VALUES ('$nombre', '$clase')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarSubclase($antiguo,$nuevo){

        $db = new Database();

        $sql = "UPDATE Subclase SET subclase='$nuevo' WHERE Subclase.subclase='$antiguo'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarSubclase($nombre){

        $db = new Database();

        $sql = "DELETE FROM Subclase WHERE Subclase.subclase='$nombre'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todasSubclases(){

        $db = new Database();

        $sql = "SELECT subclase from Subclase";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if($resultado->num_rows == 0){
            echo "No hay clases en la base de datos";
        }else{
            return $resultado;
        }
    }

    public function MiClase($nombre){

        $db = new Database();

        $sql = "SELECT clase from Subclase WHERE subclase='$nombre' ";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $MiClase = $resultado->fetch_array()["clase"];

        return $MiClase;
    }


}
