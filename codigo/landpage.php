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
    <!-- Link para el menú desplegable -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" type="image/x-icon" href="/imgs/favicon.png">
    <title>Cursor Academy</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-lg-4">
                <a class="portada_btn_img" href="#"><img class="img_portada" src="/imgs/500x500_sin_fondo.png" width="70" height="70" alt="Logotipo Cursor Academy"></a>
                <!-- Main, menu, contact  -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="menu collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav_enlace" href="#el_proyecto">el proyecto</a></li>
                        <li class="nav-item"><a class="nav_enlace" href="#contacto">contacto</a></li>
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
                        <li class="nav-item"><a class="nav_enlace" href="panel_admin.php">panel administrativo</a></li>
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

    <div class="portada">
        <h1 class="texto_portada">cursor academy</h1>
        <!-- Texto con efecto portada.js -->
        <h2>una plataforma para<span class="txt_rotar" data-period="2000" data-rotate='[" diseñadores."," programadores."," todo el mundo."]'></span></h2>
    </div>

    <!-- El proyecto -->
    <div id="el_proyecto" class="mt-7 cuerpo_fondo">
        <!-- Texto inicial del cuerpo -->
        <div class="row el_proyecto">
            <section class="col-lg-6 mb-lg-0 mt-4 contenedor_izq">
                <div>
                    <h3 class="mb-4">Cuando alguien dice: «esto también yo lo sé hacer», significa que sabe hacer de nuevo, de lo contrario lo hubiera hecho antes.</h3>
                    <p class="contenedor_izq_autor">— Bruno Munari</p>
                    <p class="mb-5">Con el auge del formato digital, destacar en el sector se ha vuelto imprescindible. Esto no se aplica solamente a la parte técnica de la programación; la imagen es un factor igual de decisivo a la hora de atraer al público potencial.</p>
                </div>
            </section>
            <section class="col-lg-6 contenedor_dcha">
                <h3 class="mb-8">El proyecto</h3>
                <hr class="mb-4 mt-1">
                <div class="mb-5">
                    <div class="contenedor_dcha_texto">
                        <h4>Una puerta de entrada al diseño UX</h4>
                        <p>Enfocada en el diseño de aplicaciones para web y dispositivos móviles, la plataforma también proporciona las herramientas para familiarizarse con los conceptos básicos del diseño, como son la maquetación, la jerarquía de la información, el uso del color y la tipografía básicos o el desarrollo de la creatividad.</p>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="contenedor_dcha_texto">
                        <h4>Estrategia de aprendizaje</h4>
                        <p>Cursos grabados donde cada usuario podrá aprender a su ritmo. La duración se adapta a las necesidades de la materia. El curso incluye un apartado de contacto directo con el instructor para las dudas ocasionadas.</p>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="contenedor_dcha_texto">
                        <h4>Material adicional de refuerzo</h4>
                        <p>Además de los cursos, la plataforma ofrece otros productos enfocados en el crecimiento del usuario como diseñador UX, como pueden ser libros o licencias de software.</p>
                    </div>
                </div>
            </section>
        </div>
    <!-- Botones de registro o tienda -->
        <?php if (isset($_SESSION['usuario']) || isset($_SESSION['admin'])){ ?>
            <div class="aviso_registro">
            <a href="tienda.php">Acceso a la tienda</a>
            </div>
        <?php } else { ?>
            <div class="aviso_registro">
            <a href="registro_login.php">Únete a la plataforma</a>
            </div>
        <?php } ?>
    <!-- Contacto -->
    <div id="el_proyecto" class="cuerpo_fondo">
        <div class="cuerpo_el_proyecto" id="el_proyecto">
        </div>
        <div class="cuerpo_contacto" id="contacto">
            <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.522412591126!2d-3.6933637000000004!3d40.41942969999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422884b69894d3%3A0x42597193d8bd3e47!2sPlaza%20Cibeles%2C%2028014%20Madrid!5e0!3m2!1ses!2ses!4v1654164882894!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- 
                Al no star desplegado en un dominio, siempre dará error en el envío.
             -->
            <form class="formulario_contacto" action="enviar_mail.php">
                    <h2 class="contacto_titulo">contacto</h2>
                    <p><input name="nombre_contacto" placeholder="Nombre" minlength="2" maxlength="30" pattern="[a-zA-Z0-9-_]+" required></input></p>
                    <p><input name="email_contacto" placeholder="Email de contacto" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></input></p>
                    <p><input name="mensaje" placeholder="Escribe aquí tu mensaje" maxlength="460" required></input></p>
                    <input class="btn_enviar_form" type="submit" name="submit" value="Enviar">
                <div class="tlf_email">
                    <span class="fa fa-phone"></span>601 23 45 67<br>
                    <span class="fa fa-envelope-o"></span>contacto@cursoracademy.com
                </div>
            </form>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="pie_pagina">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="pie_titulo">sobre el proyecto</h2>
                    <p class="pie_texto">Esta página web, desde el desarrollo de la idea hasta su creación, forma parte del trabajo de final de grado de Isabel Heredia Moyo para el grado superior de Desarrollo de Aplicaciones Web del IES El Lago, curso 2021/2022.</p>
                </div>
                <div class="col-md-3">
                    <h2 class="pie_titulo">agradecimientos</h2>
                    <ul class="pie_links">
                        <li><a href="https://www.linkedin.com/in/luis-silva-castro/">Luis Silva Castro</a></li>
                        <li><a href="https://www.linkedin.com/in/jorgeblazq/">Jorge Blázquez Álvarez</a></li>
                        <li><a href="https://www.linkedin.com/in/pablo-perales-perez-014808222/">Pablo Perales Pérez</a></li>
                        <li><a href="https://www.linkedin.com/in/diego-cachafeiro-neulander/">Diego Cachafeiro Neulander</a></li>
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