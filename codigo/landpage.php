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

    <link rel="icon" type="image/x-icon" href="/imgs/favicon.png">
    <title>Cursor Academy</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-default" id="mainNav">
            <div class="menu">
                <a href="landpage.php"><img src="/imgs/500x500_sin_fondo.png" alt="Logotipo Cursor Academy"></a>
                <ul>
                    <li><a href="#el_proyecto">el proyecto</a></li>
                    <li><a href="#contacto">contacto</a></li>
                    <li><a href="#">productos</a></li>
                    <li><a href="#">prueba de conocimiento</a></li>
                    <li><a href="#">panel administrativo</a></li>
                    <li><a href="#" class="log">login</a></li>
                    <li><a href="#" class="log">logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="portada">
        <h1 class="texto_portada">cursor academy</h1>
        <!-- Texto con efecto portada.js -->
        <h2>una plataforma para<span class="txt_rotar" data-period="2000" data-rotate='[" diseñadores."," programadores."," todo el mundo."]'></span></h2>
    </div>

    <div class="cuerpo_fondo">
        <div class="cuerpo_el_proyecto" id="el_proyecto">

        </div>
        <div class="cuerpo_contacto" id="contacto">
            <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.522412591126!2d-3.6933637000000004!3d40.41942969999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422884b69894d3%3A0x42597193d8bd3e47!2sPlaza%20Cibeles%2C%2028014%20Madrid!5e0!3m2!1ses!2ses!4v1654164882894!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <form class="formulario_contacto">
                    <h2 class="contacto_titulo">contacto</h2>
                    <p><input placeholder="Nombre"></input></p>
                    <p><input placeholder="Email de contacto"></input></p>
                    <p><input placeholder="Escribe aquí tu mensaje"></input></p>
                    <button>Enviar</button>
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