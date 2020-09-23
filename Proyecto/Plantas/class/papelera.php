<?php

require_once('Database.php');
require_once('planta.php');


class Papelera{

    public function meterPlantaPapelera($genero, $especie){

        $db = new Database();

        $sql2 = "UPDATE Planta SET estado='1' WHERE Planta.genero='$genero' AND Planta.especie='$especie'";

        $sql = "INSERT INTO Papelera VALUES ('$genero','$especie', CURRENT_TIMESTAMP)";

        $request = $db->getDB()->query($sql2);
        $request2 = $db->getDB()->query($sql);
        if ($request == TRUE && $request2 == TRUE){
            return 0;
        }else{
            return 1;
        }
    }

    public function eliminarPlantaDefinitiva($genero, $especie){

        $planta = new Planta();

        $answer = $planta->eliminarPlanta($especie,$genero);

        $db = new Database();

        $sql = "DELETE * FROM Papelera WHERE  genero_p = '$genero' AND especie_p = '$especie'";

        if ($db->getDB()->query($sql)==TRUE){
            return 0;
        }

        return $answer;
    }

    public function restaurar($genero,$especie){

        $db = new Database();

        $sql2 = "UPDATE Planta SET estado='0' WHERE Planta.genero='$genero' AND Planta.especie='$especie'";;

        $sql = "DELETE FROM Papelera WHERE  genero_p = '$genero' AND especie_p = '$especie'";

        $request = $db->getDB()->query($sql2);
        $request2 = $db->getDB()->query($sql);

        if ($request == TRUE || $request2 == TRUE){
            return 0;
        }else{
            return 1;
        }

    }

    public function todasPapelera(){

        $db = new Database();

        $sql = "SELECT * FROM Papelera";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo 'Algo ha fallado';
        }
        if($resultado->num_rows == 0){
            echo 'La papelera está vacía';
        }

        return $resultado;
    }

    public function generosPapelera(){

        $db = new Database();

        $sql = "SELECT DISTINCT genero_p FROM Papelera";

        $resultado = $db->getDB()->query($sql);

        if(!$resultado){
            echo "Esto no funciona demasiado bien";
            return 1;
        }

        if($resultado->num_rows == 0){
            return 0;
        }else{
            return $resultado;
        }
    }

    public function especiesPapelera($genero){

        $db = new Database();

        $sql = "SELECT * FROM Papelera WHERE genero_p ='$genero'";

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


}
?>