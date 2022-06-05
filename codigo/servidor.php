<?php
require 'conectorBD.php';

$option = $_POST['option'];

$conector = new ConectorBD();

switch ($option) {
    case "registro":
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];

        //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
        if(!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
            /*
                Comprueba si el email existe previamente
                Si existe, salta un mensaje avisando de ello
                Si no existe, registra el usuario en la BBDD
            */
            $emailRepetido = $conector->comprobarEmail($email);

            if ($emailRepetido == true) {
                echo '<script type="text/javascript">
                    alert("Ya existe una cuenta con este correo electrónico");
                    location="registro_login.php";
                </script>';
                exit();
            } else {
                $conector->insertarUsuario($email, $nombre, $pass);
            }
        } else {
            header("Location: error_login_registro.php");
            exit();
        }        
        break;
    case "inicio_sesion":
        $nombre = $_POST['nombre'];
        $pass = $_POST['pass'];
        
        //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
        if(!empty($_POST['nombre']) && !empty($_POST['pass'])) {
            $conector->consultarUsuario($nombre, $pass);     
        } else {
            header("Location: error_login_registro.php");
            exit();
        }    
        break;
}
?>

