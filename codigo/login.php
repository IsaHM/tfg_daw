<?php

class ConectorBD {
    private $servername;
    private $database;
    private $user;
    private $pass;
    
    function __construct() {
        $this->servername = "localhost";
        $this->database = "tfg_web_academia";
        $this->user = "user";
        $this->pass = "pass";
    }

    public function conectarBD() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        
        if(!$conector) {
            echo "FALLO AL CONECTAR LA BASE DE DATOS<br>";
        } else {
            echo "BASE DE DATOS CONECTADA CORRECTAMENTE<br>";
        }
        mysqli_close($conector);
    }

    //Login
    public function loggearUsuario($email, $pass) {

    }
}