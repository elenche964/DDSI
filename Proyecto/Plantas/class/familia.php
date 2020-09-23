<?php

require_once ('Database.php');
require_once ('orden.php');

class Familia{

    public function crearFamilia($nombre, $orden){

        $db = new Database();

        $sql = "INSERT INTO Familia (familia, fruto, forma_flor, forma_flor_masculina, forma_flor_femenina, orden) VALUES
('$nombre', default , default, default, default, '$orden')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarFamilia($nuevo,$columna, $familia){

        $db = new Database();

        $sql = "UPDATE Familia SET $columna='$nuevo' WHERE familia='$familia'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarFamilia($nombre){

        $db = new Database();

        $sql = "DELETE from Familia WHERE Familia.familia='$nombre'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todasFamilias(){

        $db = new Database();

        $sql = "SELECT familia from Familia";

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

    public function MiOrden($nombre){

        $db = new Database();

        $sql = "SELECT orden from Familia WHERE familia='$nombre' ";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $MiOrden = $resultado->fetch_array()["orden"];

        $orden = new Orden();

        $resultadoSubclase = $orden->MiSubclase($MiOrden);

        echo '&emsp;Subclase: '.$resultadoSubclase."<br>";

        return $MiOrden;
    }

    public function miFruto($familia)
    {

        $db = new Database();

        $sql = "SELECT fruto FROM Familia WHERE familia='$familia'";

        $resultado = $db->getDB()->query($sql);

        if (!$resultado) {
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if ($resultado->num_rows == 0) {
            echo "No hay plantas en la base de datos";
        } else {
            return $resultado;
        }
    }

    public function miForma($familia)
    {

        $db = new Database();

        $sql = "SELECT * FROM Familia WHERE familia='$familia'";

        $resultado = $db->getDB()->query($sql);

        if (!$resultado) {
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if ($resultado->num_rows == 0) {
            echo "No hay plantas en la base de datos";
            return 2;
        } else {
            return $resultado;
        }
    }
    
    public function misDatos($familia){

        $db = new Database();

        $sql = "SELECT * FROM Familia WHERE Familia.familia = '$familia'";

        $resultado = $db->getDB()->query($sql);
        if(!$resultado){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if($resultado->num_rows == 0){
            echo "No hay plantas en la base de datos";
        }else{
            return $resultado;
        }
    }

}