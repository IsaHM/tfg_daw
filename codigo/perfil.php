<?php
    require 'ConectorBD.php';
    $conector = new ConectorBD();
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

    <div class="perfil_cuerpo">
        <?php
        //Enlaces para usuario
        if (isset($_SESSION['usuario']) || isset($_SESSION['admin'])){
            if (isset($_SESSION['usuario'])) {
                $usuario = $_SESSION['usuario'];
            }
            if (isset($_SESSION['admin'])) {
                $usuario = $_SESSION['admin'];
            }            
        ?>
            <h2 class="titulo_loggeado">Hola de nuevo, <?php echo $usuario; ?>.</h2>
            <h3 class="perfil_opcion">Cambiar dirección de correo electrónico</h3>
                <form action="servidor.php" method="post" class="perfil_form">
                    <input class="input_perfil" type="hidden" name="option" value="cambiar_mail">
                    <input class="input_perfil" type="hidden" name="nombre" value="<?php echo $usuario; ?>">
                    <input class="input_perfil" type="text" name="mail_antiguo" placeholder="Correo antiguo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="60" required>
                    <input class="input_perfil" type="text" name="mail_nuevo" placeholder="Nueva dirección de correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="60" required>
                    <input class="input_perfil" type="password" name="pass" placeholder="Contraseña" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" minlength="8" maxlength="60" required>
                    <input class="perfil_submit submit_cambio" type="submit" value="Enviar">
                </form>
            <h3 class="perfil_opcion">Cambiar contraseña</h3>
                <form action="servidor.php" method="post" class="perfil_form">
                    <input class="input_perfil" type="hidden" name="option" value="cambiar_pass">
                    <input class="input_perfil" type="hidden" name="nombre" value="<?php echo $usuario; ?>">
                    <input class="input_perfil" type="password" name="pass_antigua" placeholder="Contraseña antigua" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" minlength="8" maxlength="60" required>
                    <input class="input_perfil" type="password" name="pass_nueva" placeholder="Nueva contraseña" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" minlength="8" maxlength="60" required>
                    <input class="perfil_submit submit_cambio" type="submit" value="Enviar">
                </form>
            <h3 class="perfil_opcion">Borrar usuario</h3>
            <h4>¡Alerta! Es un cambio irreversible.</h4>
                <form action="servidor.php" method="post" class="perfil_form">
                    <input class="input_perfil" type="hidden" name="option" value="borrar_cuenta">
                    <input class="input_perfil" type="hidden" name="nombre" value="<?php echo $usuario; ?>">
                    <input class="input_perfil" type="text" name="mail" placeholder="Correo electrónico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="60" required>
                    <input class="input_perfil" type="password" name="pass_uno" placeholder="Contraseña" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" minlength="8" maxlength="60" required>
                    <input class="input_perfil" type="password" name="pass_dos" placeholder="Repite la contraseña" pattern="[a-zA-Z0-9-_¡!¿?@#/.&%()]+" minlength="8" maxlength="60" required>
                    <input class="perfil_submit submit_borrado" type="submit" value="Borrar">
                </form><br>
        <?php
        } else {
        ?>
            <div class="cuerpo_perfil_no_log">
                <h2 class="titulo_no_loggeado">Debes estar conectado para acceder al contenido de esta página.</h2>
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