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

/* --- USUARIOS --- */

    //Comprueba en la base de datos si existe un email igual al enviado en el formulario y devuelve un valor booleano
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
    
    /*
        Inserta una fila en la tabla "usuario"
        El valor "administrador" es 0 por defecto, ya que debe ser otro administrador quien conceda los privilegios del rol
        La fecha de registro toma al valor "CURRENT_TIMESTAMP", es decir, del día y hora exactos del momento de registro
    */
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

    /*
        Busca si existe un usuario y si tiene poderes de administrador
        De existir una fila en la tabla de usuarios, realiza la búsqueda de $sql_admin
            - Si no aparecen filas, se ha conectado un usuario
            - Si aparecen filas, se ha conectado un administrador
    */
    public function consultarUsuario($nombre, $pass) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario where nombre = '$nombre' and pass = '$pass'";
        $sql_admin = "SELECT administrador FROM usuario where nombre = '$nombre' and pass = '$pass' and administrador = '1'";

        $resultado = mysqli_query($conector, $sql);
        $resultado_admin = mysqli_query($conector, $sql_admin);
        
        if ($resultado->num_rows == 1) {
            /*
                
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

    //Altera el contenido de la columna "email" del usuario conectado
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

    //Altera el contenido de la columna "email"
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

    //Elimina una fila de la tabla "usuario"
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

/* --- PRODUCTOS --- */

    //Busca y devuelve las filas en la tabla "producto"
    public function productosOfertados() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM producto";

        $resultado = mysqli_query($conector, $sql);

        $lista_productos = $resultado->fetch_all();
        
        return $lista_productos;
        mysqli_close($conector);
    }

/* --- CARRITO --- */

    /*
        Añade un producto al carrito
        Si existe ya un objeto igual en la tabla "carrito":
            - Suma 1 a la cantidad
            - Suma el equivalente a una unidad al precio anterior
        Si no existe, crea una fila en la tabla "carrito"
    */
    public function insertarProducto($id_sesion, $id_producto, $precio) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "INSERT INTO carrito (id_sesion, id_producto, cantidad, precio) VALUES ('$id_sesion', $id_producto, 1, $precio)";
        $sql_busqueda = "SELECT id_producto FROM carrito where id_producto = '$id_producto'";
        
        $resultado_busqueda = mysqli_query($conector, $sql_busqueda);
        
        if ($resultado_busqueda->num_rows == 1) {
            $sql_update = "UPDATE carrito SET cantidad = cantidad+1 where id_producto = '$id_producto'";
            $update_cantidad = mysqli_query($conector, $sql_update);
            
            $sql_precio_unidad = "SELECT precio FROM producto where id_producto = '$id_producto'";
            $resultado_precio_unidad = mysqli_query($conector, $sql_precio_unidad);
            $resultado_precio_unidad = $resultado_precio_unidad->fetch_array();
            $precio_unidad = floatval($resultado_precio_unidad[0]);
        
            $sql_update = "UPDATE carrito SET precio = precio+$precio_unidad where id_producto = '$id_producto'";

            $resultado = mysqli_query($conector, $sql_update);
        } else {
            $resultado = mysqli_query($conector, $sql);
        }        

        header("Location: tienda.php");
        exit();

        mysqli_close($conector);
    }

    //Devuelve las filas de la tabla "carrito"
    public function mostrarProductosEnCarrito() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT c.id_producto, nombre_producto, categoria, cantidad, c.precio FROM producto p, carrito c WHERE p.id_producto = c.id_producto";

        $resultado = mysqli_query($conector, $sql);

        $lista_carrito = $resultado->fetch_all();
        
        return $lista_carrito;
        mysqli_close($conector);
    }
    
    //Elimina todas las filas de la tabla "carrito"
    function borrarCarrito() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "DELETE FROM carrito";

        $resultado = mysqli_query($conector, $sql);
        mysqli_close($conector);
    }

    //Elimina una única fila de la tabla carrito
    function borrarProductoCarrito($id_producto) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "DELETE FROM carrito WHERE id_producto = '$id_producto'";

        $resultado = mysqli_query($conector, $sql);
        mysqli_close($conector);

        header("Location: tienda.php");
        exit();
    }

/* --- PANEL DE ADMINISTRACIÓN --- */

    //Si la fila señalada tiene la columna "administrador" con valor 0, cambia el valor a 1
    function darAdmin($email) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "UPDATE usuario SET administrador = true where email = '$email' AND administrador = false";
        $sql_busqueda = "SELECT email FROM usuario where email = '$email'";

        $resultado_busqueda = mysqli_query($conector, $sql_busqueda);

        if ($resultado_busqueda->num_rows == 1) {
            $resultado = mysqli_query($conector, $sql); 
            echo '<script type="text/javascript">
                    alert("Se ha editado el rol del usuario.");
                    location="panel_admin.php";
                </script>';
                exit();     
        } else {
            echo '<script type="text/javascript">
                    alert("No se ha podido editar el rol del usuario.");
                    location="panel_admin.php";
                </script>';
                exit();
        }
    }

    //Si la fila señalada tiene la columna "administrador" con valor 1, cambia el valor a 0
    function quitarAdmin($email) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "UPDATE usuario SET administrador = false where email = '$email' AND administrador = true";
        $sql_busqueda = "SELECT * FROM usuario where email = '$email'";

        $resultado_busqueda = mysqli_query($conector, $sql_busqueda);

        if ($resultado_busqueda->num_rows == 1) {
            $resultado = mysqli_query($conector, $sql); 
            echo '<script type="text/javascript">
                    alert("Se ha editado el rol del usuario.");
                    location="panel_admin.php";
                </script>';
                exit();     
        } else {
            echo '<script type="text/javascript">
                    alert("No se ha podido editar el rol del usuario.");
                    location="panel_admin.php";
                </script>';
                exit();
        }
        mysqli_close($conector);
    }

    //Elimina una fila de la tabla "usuario"
    public function adminBorrarCuenta($email) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario WHERE email = '$email'";
        $sql_borrar = "DELETE FROM usuario WHERE email = '$email'";

        $resultado = mysqli_query($conector, $sql);
        
        if ($resultado->num_rows == 1) {
            $resultado_borrar = mysqli_query($conector, $sql_borrar); 
            echo '<script type="text/javascript">
                    alert("Se ha eliminado el usuario.");
                    location="panel_admin.php";
                </script>';
                exit();     
        } else {
            echo '<script type="text/javascript">
                    alert("No se ha podido eliminar al usuario.");
                    location="panel_admin.php";
                </script>';
                exit();
        }
        mysqli_close($conector);
    }

    //Devuelve el listado de todas las filas de la tabla "usuario", ordenadas por su rol (admin/usuario) y la fecha de registro
    public function adminVerUsuarios() {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "SELECT * FROM usuario ORDER BY administrador DESC, fecha_registro ASC";

        $resultado = mysqli_query($conector, $sql);

        $lista_usuarios = $resultado->fetch_all();
        
        return $lista_usuarios;
        mysqli_close($conector);
    }

    /*
        Inserta una fila en la tabla producto
        La fecha de registro del producto toma al valor "CURRENT_TIMESTAMP", es decir, del día y hora exactos del momento de registro
        El link de la imagen y su alt pueden tener valor null
    */
    public function nuevoProducto($producto_nombre, $descripcion, $precio, $categoria, $url, $alt) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "INSERT INTO producto (nombre_producto, descripcion, precio, categoria, fecha_producto, url_img, alt_img) VALUES ('$producto_nombre', '$descripcion','$precio', '$categoria', CURRENT_TIMESTAMP, '$url', '$alt')";

        if (mysqli_query($conector, $sql)) {
            echo '<script type="text/javascript">
                    alert("Se ha añadido el producto a la tienda.");
                    location="panel_admin.php";
                </script>';
                exit();    
        } else {
            echo '<script type="text/javascript">
                    alert("No se ha podido añadir el producto.");
                    location="panel_admin.php";
                </script>';
                exit();
        }
        mysqli_close($conector);
    }

    //Elimina una fila de la tabla producto
    public function eliminarProducto($producto_nombre) {
        $conector = mysqli_connect($this->servername, $this->user, $this->pass, $this->database);
        $sql = "DELETE FROM producto WHERE nombre_producto = '$producto_nombre'";

        if (mysqli_query($conector, $sql)) {
            echo '<script type="text/javascript">
                    alert("Se ha eliminado el producto.");
                    location="panel_admin.php";
                </script>';
                exit();    
        } else {
            echo '<script type="text/javascript">
                    alert("No se ha podido eliminar el producto.");
                    location="panel_admin.php";
                </script>';
                exit();
        }
        mysqli_close($conector);
    }
}