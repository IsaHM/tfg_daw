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
            echo '<script type="text/javascript">
                    alert("Usuario creado correctamente");
                    location="landpage.php";
                </script>';
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
        $sql_admin = "SELECT administrador FROM usuario where nombre = '$nombre' and pass = '$pass' and administrador = '1'";

        $resultado = mysqli_query($conector, $sql);
        $resultado_admin = mysqli_query($conector, $sql_admin);
        
        //Busca si existe un usuario
        if ($resultado->num_rows == 1) {
            /*
                De existir una fila en la tabla de usuarios, realiza la búsqueda de $sql_admin
                Si no aparecen filas, se ha conectado un usuario
                Si aparecen filas, se ha conectado un administrador
            */
            if ($resultado_admin->num_rows == 0) {
                session_start();
                $_SESSION['usuario'] = $nombre;
                header("Location: landpage.php");
                exit();
            } else {
                session_start();
                $_SESSION['admin'] = $nombre;
                setcookie("cookie_usuario", 1, time()+60*60*24*30);
                header("Location: landpage.php");
                exit();
            }            
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }
}
