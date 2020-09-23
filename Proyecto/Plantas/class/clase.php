<?php

require_once ('Database.php');

class Clase{
    
    public function crearClase($nombre){
        
        $db = new Database();

        $sql = "INSERT INTO Clase (clase) VALUES ('$nombre')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }
    }

    public function editarClase($antiguo,$nuevo){

        $db = new Database();

        $sql = "UPDATE Clase SET clase='$nuevo' WHERE Clase.clase='$antiguo'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarClase($nombre){

        $db = new Database();

        $sql = "DELETE from Clase WHERE Clase.clase='$nombre'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todasClases(){

        $db = new Database();

        $sql = "SELECT * from Clase";

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

    public function buscarSubclases($nombre){

        $db = new Database();

        $sql = "SELECT subclase from Subclase WHERE clase='$nombre'";

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
}
        
?>
