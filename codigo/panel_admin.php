<?php
    require 'ConectorBD.php';
    $conector = new ConectorBD();
    $id_sesion = session_id();
    $lista_usuarios = $conector->adminVerUsuarios();
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
    <script src="js/mostrar_tabla.js"></script>
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
                        <li class="nav-item"><a class="nav_enlace" href="#">el proyecto</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#">contacto</a></li>
                        <?php
                        //Evita que salte el texto de error en la cabecera al no encontrar a un usuario conectado
                        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        //Enlaces para usuario
                        if (isset($_SESSION['usuario'])){
                    ?>
                        <li class="nav-item"><a class="nav_enlace" href="#">productos</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#">prueba de conocimiento</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="#">perfil</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="logout.php">logout</a></li>
                        <?php
                        //Enlaces para administrador
                        } else if (isset($_SESSION['admin'])){
                    ?>
                        <li class="nav-item"><a class="nav_enlace" href="#">productos</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#">prueba de conocimiento</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#">panel administrativo</a></li>
                        <li class="nav-item"><a class="nav_enlace log" href="#">perfil</a></li>
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
            <h3 class="admin_opcion">funciones sobre usuarios</h3>
                <form action="servidor.php" method="post" class="admin_form">
                    <input class="admin_input" type="text" name="email" placeholder="Correo del usuario" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="60">
                    <fieldset id="option">
                        <input type="radio" name="option" value="admin_dar_admin" checked> <p class="admin_radio_btn">Dar poderes de administrador</p><br>
                        <input type="radio" name="option" value="admin_quitar_admin"> <p class="admin_radio_btn">Eliminar poderes de administrador</p><br>
                        <input type="radio" name="option" value="admin_borrar_usuario"> <p class="admin_radio_btn">Borrar usuario</p>
                    </fieldset>
                    <input class="submit_admin" type="submit" value="Enviar">
                </form>
            <!--
                La tabla de usuarios aparece ordenada:
                    Primero por administradores sobre usuarios base
                    Segundo por fecha de registro (ascendente)
            -->
            <a id="toggleTableDisplay" class="mostrar_ocultar_tabla" onclick="tablaUsuarios();" href="#">Ocultar / mostrar usuarios</a>
            <div class="contenedor_tabla_usuarios">
                <table id="tabla_usuarios" class="tabla_usuarios">
                    <tr class="tabla_usuarios_cabecera">
                        <th>Correo electrónico</th>
                        <th>Nombre</th>
                        <th>Fecha de registro</th>
                        <th>Administrador</th>
                    </tr>
                <?php foreach($lista_usuarios as $row) { ?>
                    <tr class="tabla_usuarios_fila">
                        <td><p><?php echo $row[0] ?></p></td>
                        <td><p><?php echo $row[1] ?></p></td>
                        <td><p><?php echo $row[3] ?></p></td>
                        <td><p><?php echo $row[4] ?></p></td>
                    </tr>    
                <?php } ?>
                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="cuerpo_perfil_no_log">
                <h2 class="titulo_no_loggeado">Solamente los administradores tienen permiso para acceder a esta página.</h2>
                <a href="landpage.php" class="btn_perfil">Página principal</a>
                <a href="registro_login.php" class="btn_perfil">Login / Registro</a>
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