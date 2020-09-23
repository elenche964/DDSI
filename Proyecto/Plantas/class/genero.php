<?php

require_once ('Database.php');
require_once ('familia.php');

class Genero{

    public function crearGenero($nombre, $familia){

        $db = new Database();

        $sql = "INSERT INTO Genero (genero, familia) VALUES ('$nombre', '$familia')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarGenero($antiguo,$nuevo){

        $db = new Database();

        $sql = "UPDATE Genero SET genero='$nuevo' WHERE Genero.genero='$antiguo'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarGenero($nombre){

        $db = new Database();

        $sql = "DELETE from Genero WHERE genero='$nombre' CASCADE CONSTRAINTS";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todosGeneros(){

        $db = new Database();

        $sql = "SELECT genero from Genero";

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

    public function printGenero($genero){
        echo "&emsp;Género: ".$genero."<br>";
    }

    public function Taxonomia($genero){

        $db = new Database();

        $sql = "SELECT genero from Genero WHERE genero='$genero' ";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $MiGenero = $resultado->fetch_array()["genero"];

        $genero1 = new Genero();

        $resultadoFamilia = $genero1->MiFamilia($MiGenero);

        echo '&emsp;Familia: '.$resultadoFamilia."<br>";

        return $this->printGenero($MiGenero);
    }

    public function MiFamilia($nombre){

        $db = new Database();

        $sql = "SELECT familia from Genero WHERE genero='$nombre' ";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }


        $MiFamilia = $resultado->fetch_array()["familia"];

        $familia = new Familia();

        $resultadoOrden = $familia->MiOrden($MiFamilia);

        echo '&emsp;Orden: '.$resultadoOrden."<br>";

        return $MiFamilia;

    }

    public function miFruto($genero){

        $db = new Database();

        $sql = "SELECT * FROM Genero WHERE genero='$genero'";

        $familia = new Familia();

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $miFamilia = $resultado->fetch_array()["familia"];

        $fruto = $familia->miFruto($miFamilia);

        return $fruto;
    }

    public function miForma($genero){

        $db = new Database();

        $sql = "SELECT * FROM Genero WHERE genero='$genero'";

        $familia = new Familia();

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows == 0){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        $miFamilia = $resultado->fetch_array()["familia"];

        $forma = $familia->miForma($miFamilia);

        return $forma;
    }

}