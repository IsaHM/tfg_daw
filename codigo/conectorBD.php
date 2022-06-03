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

    public function comprobarEmail($email) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where email = '$email'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        mysqli_close($conector);
    }
    
    public function insertarUsuario($email, $nombre, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);      
        $sql = "INSERT INTO usuario (email, nombre, pass, fecha_registro, administrador) VALUES ('$email', '$nombre','$pass', CURRENT_TIMESTAMP, 0)";
        
        if (mysqli_query($conector, $sql)) {
            //JS pop up para dar aviso del registro correcto
            header("Location: landpage.php");
            exit();
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }

    public function consultarUsuario($nombre, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where nombre = '$nombre' and pass = '$pass'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            //Llevar a la página principal con la sesión conectada
            echo "EL USUARIO EXISTE";
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }
}
