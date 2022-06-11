<?php
    require 'ConectorBD.php';
    $conector = new ConectorBD();
    $id_sesion = session_id();
    $lista_usuarios = $conector->adminVerUsuarios();
    $lista_productos = $conector->productosOfertados();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/fuentes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/portada.js"></script>
    <script src="js/cabecera.js"></script>
    <script src="js/tablas_admin.js"></script>
    <!-- Link para el menú desplegable -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" type="image/x-icon" href="/imgs/favicon.png">
    <title>Cursor Academy</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-lg-4">
                <a class="portada_btn_img" href="landpage.php"><img class="img_portada"
                        src="/imgs/500x500_sin_fondo.png" width="70" height="70" alt="Logotipo Cursor Academy"></a>
                <!-- Main, menu, contact  -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="menu collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav_enlace" href="landpage.php#el_proyecto">el proyecto</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="landpage.php#contacto">contacto</a></li>
                        <?php
                        //Evita que salte el texto de error en la cabecera al no encontrar a un usuario conectado
                        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        //Enlaces para usuario
                        if (isset($_SESSION['usuario'])){
                    ?>
                        <li class="nav-item"><a class="nav_enlace" href="tienda.php">productos</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="perfil.php">perfil</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="logout.php">logout</a></li>
                        <?php
                        //Enlaces para administrador
                        } else if (isset($_SESSION['admin'])){
                    ?>
                        <li class="nav-item"><a class="nav_enlace" href="tienda.php">productos</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#">panel administrativo</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="perfil.php">perfil</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="logout.php">logout</a></li>
                        <?php 
                        //Enlaces para no-loggeados
                        } else {
                    ?>
                        <li class="nav-item"><a class="nav_enlace log" href="registro_login.php">login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="panel_admin_cuerpo">
        <?php
        //Enlaces para usuario
        if (isset($_SESSION['admin'])){   
            $usuario = $_SESSION['admin']; 
            $usuario_lc = strtolower($_SESSION['admin']); 
        ?>
                <h2 class="admin_titulo">panel de administrador</h2>
                
                <div class="form_contenedor">
                    


                    <!-- Administrador de productos -->
                        <form action="servidor.php" method="post">
                        <h3>funciones sobre productos</h3>
                            <input class="admin_input" type="text" name="producto_nombre" placeholder="Nombre del producto" maxlength="100" required>
                            <input class="admin_input" type="text" name="producto_descripcion" placeholder="Descripción *" maxlength="400">
                            <input class="admin_input" type="number" step="0.01" name="producto_precio" placeholder="Precio (ej. 99.99) *" maxlength="13">
                            <input class="admin_input" type="text" name="producto_categoria" placeholder="Categoría *" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" maxlength="80">
                            <input class="admin_input" type="text" name="producto_url_img" placeholder="URL de la imagen *" maxlength="80">
                            <input class="admin_input" type="text" name="producto_url_alt" placeholder="ALT para la imagen *" maxlength="200">
                            <fieldset id="option">
                                <input type="radio" name="option" value="admin_nuevo_producto" checked> <p class="admin_radio_btn">Añadir producto</p><br>
                                <input type="radio" name="option" value="admin_eliminar_producto"> <p class="admin_radio_btn">Eliminar producto</p><br>
                            </fieldset>
                            <p class="admin_anotacion">* Sólo necesario para añadir un nuevo producto</p>
                            <input class="submit_admin" type="submit" value="Enviar">
                        </form>


                        <!-- Administrador de usuarios -->
                        <form action="servidor.php" method="post">
                        <h3>funciones sobre usuarios</h3>
                            <input class="admin_input" type="text" name="email" placeholder="Correo del usuario" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="60">
                            <fieldset id="option">
                                <input type="radio" name="option" value="admin_dar_admin" checked> <p class="admin_radio_btn">Dar poderes de administrador</p><br>
                                <input type="radio" name="option" value="admin_quitar_admin"> <p class="admin_radio_btn">Eliminar poderes de administrador</p><br>
                                <input type="radio" name="option" value="admin_borrar_usuario"> <p class="admin_radio_btn">Borrar usuario</p>
                            </fieldset>
                            <input class="submit_admin" type="submit" value="Enviar">
                        </form>
                </div>



            
            <!-- Botones de ocultar y mostrar -->
            <div class="botones_mostrar_ocultar">
                <a id="toggleTableDisplay" class="mostrar_ocultar_tabla" onclick="tablaUsuarios();" href="#">Ocultar / mostrar usuarios</a>
                <a id="toggleTableDisplay" class="mostrar_ocultar_tabla" onclick="tablaProductos();" href="#">Ocultar / mostrar productos</a>
            </div>
            <!--
                La tabla de usuarios aparece ordenada:
                    Primero por administradores sobre usuarios base
                    Segundo por fecha de registro (ascendente)
            -->
            <div class="contenedor_tabla_usuarios">
                <table id="tabla_usuarios" class="tabla_usuarios">
                    <tr>
                        <th>Correo electrónico</th>
                        <th>Nombre del usuario</th>
                        <th>Fecha de registro</th>
                        <th>Administrador</th>
                    </tr>
                <?php foreach($lista_usuarios as $row_usuarios) { ?>
                    <tr>
                        <td><p><?php echo $row_usuarios[0] ?></p></td>
                        <td><p><?php echo $row_usuarios[1] ?></p></td>
                        <td><p><?php echo $row_usuarios[3] ?></p></td>
                        <td><p><?php echo $row_usuarios[4] ?></p></td>
                    </tr>    
                <?php } ?>
                </table>
            </div>
            <div class="contenedor_tabla_productos">
                <table id="tabla_productos" class="tabla_productos">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Fecha de creación</th>
                    </tr>
                <?php foreach($lista_productos as $row_productos) { ?>
                    <tr>
                        <td><p><?php echo $row_productos[0] ?></p></td>
                        <td><p><?php echo $row_productos[1] ?></p></td>
                        <td><p><?php echo $row_productos[2] ?></p></td>
                        <td><p><?php echo $row_productos[3] ?></p></td>
                        <td><p><?php echo $row_productos[4] ?></p></td>
                        <td><p><?php echo $row_productos[5] ?></p></td>
                    </tr>    
                <?php } ?>
                </table>
            </div>
        <?php } else { ?>
            <div class="cuerpo_perfil_no_log">
                <h2 class="titulo_no_loggeado">Solamente los administradores tienen permiso para acceder a esta página.</h2>
                <a href="landpage.php" class="btn_perfil">Página principal</a>
                <a href="logout.php" class="btn_perfil">Desconectarse</a>
            </div>
        <?php } ?>
    </div>
    
    <!-- Pie de página -->
    <footer>
        <div class="pie_pagina">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="pie_titulo">sobre el proyecto</h2>
                    <p class="pie_texto">Esta página web, desde el desarrollo de la idea hasta su creación, forma parte
                        del trabajo de final de grado de Isabel Heredia Moyo para el grado superior de Desarrollo de
                        Aplicaciones Web del IES El Lago, curso 2021/2022.</p>
                </div>
                <div class="col-md-3">
                    <h2 class="pie_titulo">agradecimientos</h2>
                    <ul class="pie_links">
                        <li><a href="https://www.linkedin.com/in/luis-silva-castro/">Luis Silva Castro</a></li>
                        <li><a href="https://www.linkedin.com/in/jorgeblazq/">Jorge Blázquez Álvarez</a></li>
                        <li><a href="https://www.linkedin.com/in/pablo-perales-perez-014808222/">Pablo Perales Pérez</a>
                        </li>
                        <li><a href="https://www.linkedin.com/in/diego-cachafeiro-neulander/">Diego Cachafeiro
                                Neulander</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h2 class="pie_titulo">paginas de ayuda</h2>
                    <ul class="pie_links">
                        <li><a href="https://github.com/IsaHM/tfg_daw">GitHub (Repositorio)</a></li>
                        <li><a href="https://www.w3schools.com/">W3 Schools</a></li>
                        <li><a href="https://es.stackoverflow.com/">Stack Overflow</a></li>
                        <li><a href="https://codepen.io">CodePen</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="pie_pagina">
            <div class="row">
                <p class="copyright">Copyright &copy; 2022 All Rights Reserved by <i>Cursor Academy</i></p>
            </div>
        </div>
    </footer>
</body>
</html>