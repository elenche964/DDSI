<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS", "");
define("DB_DATABASE", "Plantas");

class Database{

    var $db;

    function __construct() {

        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_DATABASE);

        if($this->db->connect_errno){
           die("Error de conexión: " . $objetoMysqli->mysqli_connect_errno() . ", " .  $objetoMysqli->mysqli_connect_errno());
        }

    }

    public function getDB(){
        return $this->db;
    }

}

//mysqli_close($db);

?>
