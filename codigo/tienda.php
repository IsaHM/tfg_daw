<?php
    require 'ConectorBD.php';
    $conector = new ConectorBD();
    $lista_productos = $conector->productosOfertados();

    $token = isset($_GET['token']) ? $_GET['token'] : '';
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
    <link rel="stylesheet" href="css/tienda.css">
    <link rel="stylesheet" href="css/fuentes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JS -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/portada.js"></script>
    <script src="js/cabecera.js"></script>
    <!-- Link para el menú desplegable -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/24313a3b3e.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="/imgs/favicon.png">
    <title>Cursor Academy</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-lg-4">
                <a class="portada_btn_img" href="landpage.php"><img class="img_portada" src="/imgs/500x500_sin_fondo.png" width="70" height="70" alt="Logotipo Cursor Academy"></a>
                <!-- Main, menu, contact  -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
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
    <?php
        if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['usuario']) || isset($_SESSION['admin'])){
    ?>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php foreach($lista_productos as $row) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                            $id_producto = $row[0];
                            $img = "/imgs/producto/$id_producto.jpg"            
                        ?>
                        <img src="<?php echo $img ?>" alt="">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row[1] ?></h4>
                            <h5 class="card-text"><?php echo $row[4] ?></h5>
                            <p class="card-text"><?php echo $row[2] ?></p>
                            <p class="card-text"><?php echo $row[3] ?> EUR</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="carrito">
                <button class="btn_carrito"><i class="fa-solid fa-basket-shopping"></i></button>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="tienda_no_log">
            <h2>debes estar conectado para acceder a la tienda</h2>
            <a href="registro_login.php" class="btn_volver_login">Login</a>
            <a href="landpage.php" class="btn_volver_landpage">Página principal</a>
        </div>
    <?php } ?>

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