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
    }

    // USUARIO
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
                    alert("Usuario creado correctamente.<br>Introduce los datos nuevamente en el login para acceder a la cuenta.");
                    location="registro_login.php";
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
                header("Location: landpage.php");
                exit();
            }      
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }

    public function cambiarMail($nombre, $mail_antiguo, $mail_nuevo, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where email = '$mail_antiguo' AND nombre = '$nombre' AND pass = '$pass'";
        $sql_cambio = "UPDATE usuario SET email = '$mail_nuevo' WHERE email = '$mail_antiguo'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            if ($conector->query($sql_cambio) === TRUE) {
                echo '<script type="text/javascript">
                    alert("El correo electrónico ha sido actualizado.");
                    location="perfil.php";
                </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                    alert("No se ha podido actualizar la dirección email.");
                    location="perfil.php";
                </script>';
                exit();
            }
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }

    public function cambiarPass($nombre, $pass_antigua, $pass_nueva) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where pass = '$pass_antigua' AND nombre = '$nombre'";
        $sql_cambio = "UPDATE usuario SET pass = '$pass_nueva' WHERE pass = '$pass_antigua'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            if ($conector->query($sql_cambio) === TRUE) {
                echo '<script type="text/javascript">
                    alert("La contraseña ha sido actualizada.");
                    location="perfil.php";
                </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                    alert("No se ha podido actualizar la contraseña.");
                    location="perfil.php";
                </script>';
                exit();
            }
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }

    public function borrarCuenta($nombre, $email, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where nombre = '$nombre' AND email = '$email' AND pass = '$pass'";
        $sql_borrar = "DELETE FROM usuario WHERE nombre = '$nombre' AND email = '$email' AND pass = '$pass'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            if ($conector->query($sql_borrar) === TRUE) {
                session_destroy();
                echo '<script type="text/javascript">
                    alert("Se ha eliminado al usuario.");
                    location="landpage.php";
                </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                    alert("No se ha encontrado al usuario.");
                    location="perfil.php";
                </script>';
                exit();
            }
        } else {
            header("Location: error_login_registro.php");
            exit();
        }
        mysqli_close($conector);
    }

    //PRODUCTO
    public function productosOfertados() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM producto";

        $resultado = mysqli_query($conector, $sql);

        $lista_productos = $resultado->fetch_all();
        
        return $lista_productos;
        mysqli_close($conector);
    }

    //CARRITO
    public function insertarProducto($id_sesion, $id_producto, $precio) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "INSERT INTO carrito (id_sesion, id_producto, cantidad, precio) VALUES ('$id_sesion', $id_producto, 1, $precio)";
        $sql_busqueda = "SELECT id_producto FROM carrito where id_producto = '$id_producto'";
        $sql_update = "UPDATE carrito SET cantidad = (cantidad)+1 where id_producto = '$id_producto'";

        $resultado_busqueda = mysqli_query($conector, $sql_busqueda);

        if ($resultado_busqueda->num_rows == 1) {
            $resultado = mysqli_query($conector, $sql_update);
        } else {
            $resultado = mysqli_query($conector, $sql);
        }        

        header("Location: tienda.php");
        exit();

        mysqli_close($conector);
    }

    public function mostrarProductosEnCarrito() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT c.id_producto, nombre_producto, categoria, cantidad, c.precio FROM producto p, carrito c WHERE p.id_producto = c.id_producto";

        $resultado = mysqli_query($conector, $sql);

        $lista_carrito = $resultado->fetch_all();
        
        return $lista_carrito;
        mysqli_close($conector);
    }
    
    function borrarCarrito() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "DELETE FROM carrito";

        $resultado = mysqli_query($conector, $sql);
        mysqli_close($conector);
    }

    function borrarProductoCarrito($id_producto) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "DELETE FROM carrito WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($conector, $sql);
        mysqli_close($conector);

        header("Location: tienda.php");
        exit();
    }
}