<?php

//Cambiar los date por int.

require_once ('Database.php');
require_once ('genero.php');

class Planta{

    public function crearPlanta($especie, $genero){

        $db = new Database();

        $sql = "INSERT INTO Planta (genero, especie) VALUES ('$genero', '$especie')";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function editarPlanta($genero, $especie,$nuevo,$columna){

        $db = new Database();

        $sql = "UPDATE Planta SET $columna='$nuevo' WHERE Planta.genero='$genero' AND Planta.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarPlanta($especie, $genero){

        $db = new Database();

        $sql = "DELETE FROM Planta WHERE Planta.genero='$genero' AND Planta.especie='$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function todasPlantas(){

        $db = new Database();

        $sql = "SELECT * from Planta WHERE estado='0'";

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

    public function todasMisEspecies($genero){

        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE genero ='$genero' AND estado='0'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if($resultado->num_rows == 0){
            echo "No hay plantas en la base de datos";
            return 2;
        }else{
            return $resultado;
        }
    }

    public function buscarFloracion($inicio,$fin){
        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE floracion_inicio='$inicio' AND floracion_fin='$fin' AND estado='0'";

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

    public function misDatos($genero, $especie){

        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE genero='$genero' AND especie='$especie'";

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

    public function miGenero($especie){

        $db = new Database();

        $sql = "SELECT genero FROM Planta WHERE especie = '$especie'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado || $resultado->num_rows ==0){
            return 1;
        }

        $miGenero = $resultado->fetch_array()["genero"];

        return $miGenero;
    }

    public function tipos(){

        $db = new Database();

        $sql = "SELECT DISTINCT tipo FROM Planta WHERE tipo!='false' AND estado='0'";

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

    public function formasHoja(){

        $db = new Database();

        $sql = "SELECT DISTINCT forma_hoja FROM Planta WHERE forma_hoja!='false' AND estado='0'";

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

    public function persistencias(){

        $db = new Database();

        $sql = "SELECT DISTINCT persistencia FROM Planta WHERE persistencia!='false' AND estado='0'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo 'error al buscar';
            return 1;
        }
        if($resultado->num_rows == 0){
            echo 'No se encontraron resultados';
            return 1;
        }

        return $resultado;
    }

    public function insertarMes($genero, $especie, $mes, $columna){

        $db = new Database();

        $sql = "UPDATE Planta SET $columna";
    }

    public function buscarConUnDato($dato, $valor){

        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE $dato='$valor' AND estado='0'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo 'Error obteniendo resultados';
            return 1;
        }
        if($resultado->num_rows == 0){
            return 2;
        }

        return $resultado;
    }

    public function buscarConDosDatos($dato1, $valor1, $dato2, $valor2){

        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE $dato1='$valor1' AND $dato2='$valor2' AND estado='0'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo 'Error obteniendo resultados';
            return 1;
        }
        if($resultado->num_rows == 0){
            return 2;
        }

        return $resultado;
    }

    public function buscarConTresDatos($dato1, $valor1, $dato2, $valor2, $dato3, $valor3){

        $db = new Database();

        $sql = "SELECT * FROM Planta WHERE $dato1='$valor1' AND $dato2='$valor2' AND $dato3='$valor3' AND estado='0'";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo 'Error obteniendo resultados';
            return 1;
        }
        if($resultado->num_rows == 0){
            return 2;
        }

        return $resultado;
    }

}
?>
