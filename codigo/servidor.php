<?php
    require 'ConectorBD.php';
    $option = $_POST['option'];
    $conector = new ConectorBD();

switch ($option) {
    //USUARIOS
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
    case "cambiar_mail":
        session_start();
        $nombre = $_POST['nombre'];
        $mail_antiguo = $_POST['mail_antiguo'];
        $mail_nuevo = $_POST['mail_nuevo'];
        $pass = $_POST['pass'];
        
        //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
        if(!empty($_POST['nombre']) && !empty($_POST['mail_antiguo']) && !empty($_POST['mail_nuevo']) && !empty($_POST['pass'])) {
            $conector->cambiarMail($nombre, $mail_antiguo, $mail_nuevo, $pass);     
        } else {
            header("Location: error_login_registro.php");
            exit();
        }    
        break;
    case "cambiar_pass":
            session_start();
            $nombre = $_POST['nombre'];
            $pass_antigua = $_POST['pass_antigua'];
            $pass_nueva = $_POST['pass_nueva'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['nombre']) && !empty($_POST['pass_antigua']) && !empty($_POST['pass_nueva'])) {
                $conector->cambiarPass($nombre, $pass_antigua, $pass_nueva);     
            } else {
                header("Location: error_login_registro.php");
                exit();
            }    
            break;
    case "borrar_cuenta":
            session_start();
            $nombre = $_POST['nombre'];
            $email = $_POST['mail'];
            $pass_uno = $_POST['pass_uno'];
            $pass_dos = $_POST['pass_dos'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['nombre']) && !empty($_POST['mail']) && !empty($_POST['pass_uno']) && !empty($_POST['pass_dos'])) {
                if($pass_uno == $pass_dos) {
                    $conector->borrarCuenta($nombre, $email, $pass_uno);   
                } else {
                    echo '<script type="text/javascript">
                            alert("Las contraseñas no coinciden.");
                            location="perfil.php";
                        </script>';
                    exit();
                }                  
            } else {
                header("Location: error_login_registro.php");
                exit();
            }    
            break;
        //PRODUCTOS
        case "meter_en_carrito":
            session_start();
            $id_sesion = session_id();
            $id_producto = $_POST['id_producto'];
            $precio = $_POST['precio'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['id_producto']) && !empty($_POST['precio'])) {
                $conector->insertarProducto($id_sesion, $id_producto, $precio);        
            }

            break;
        case "borrar_del_carrito":
            session_start();
            $id_sesion = session_id();
            $id_producto = $_POST['id_producto'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['id_producto'])) {
                $conector->borrarProductoCarrito($id_producto);        
            }
            break;
        //ADMIN
        case "admin_dar_admin":
            session_start();
            $email = $_POST['email'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['email'])) {
                $conector->darAdmin($email);        
            }
            break;
        case "admin_quitar_admin":
            session_start();
            $email = $_POST['email'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['email'])) {
                $conector->quitarAdmin($email);        
            }
            break;
        case "admin_borrar_usuario":
            session_start();
            $email = $_POST['email'];
            
            //Si algún campo está vacío, lleva a la página de fallo. Esto no debería suceder por el limitador del propio formulario
            if(!empty($_POST['email'])) {
                $conector->adminBorrarCuenta($email);        
            }
            break;     
}
?>

