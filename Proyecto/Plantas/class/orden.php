<?php

require_once ('Database.php');
require_once ('subclase.php');

class Orden{

    public function crearOrden($nombre, $subclase){

        $db = new Database();

        $sql = "INSERT INTO Orden (orden, subclase) VALUES ('$nombre','$subclase')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarOrden($antiguo,$nuevo){

        $db = new Database();

        $sql = "ALTER TABLE Orden SET orden='$nuevo' WHERE orden='$antiguo'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarOrden($nombre){

        $db = new Database();

        $sql = "DELETE from Orden WHERE orden='$nombre' CASCADE CONSTRAINTS";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todosOrden(){

        $db = new Database();

        $sql = "SELECT orden from Orden";

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

    public function MiSubclase($nombre){

        $db = new Database();

        $sql = "SELECT subclase from Orden WHERE orden='$nombre' ";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $MiSubclase = $resultado->fetch_array()["subclase"];

        $subclase = new Subclase();

        $resultadoClase = $subclase->MiClase($MiSubclase);

        echo '&emsp;Clase: '.$resultadoClase."<br>";

        return $MiSubclase;
    }

}