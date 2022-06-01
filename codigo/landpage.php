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
        <!-- Efecto portada JS -->
        <h2>una plataforma para<span class="txt_rotar" data-period="2000" data-rotate='[" diseñadores."," programadores."," todo el mundo."]'></span></h2>
    </div>

    <div class="cuerpo_fondo">
        <div class="cuerpo_el_proyecto" id="el_proyecto">

        </div>
        <div class="cuerpo_contacto" id="contacto">

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