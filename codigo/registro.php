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

    //Registro usuario
    public function insertarUsuario($nombre, $email, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);

        $sql = "insert into usuarios_php (nombre, apellido, pass, fecha_registro, ultimo_login, administrador, total_donado) values ('$nombre', '$email','$pass')";
        
        if (mysqli_query($conector, $sql)) {
            echo "USUARIO INSERTADO<br>";
        } else {
            echo "ERROR AL INSERTAR EL USUARIO<br>";
        }
        mysqli_close($conector);
    }
}