<?php
require 'ConectorBD.php';
$conector = new ConectorBD();

session_start();
$conector->borrarCarrito();
$usuario = $_SESSION['usuario'];
session_destroy();

header("Location: landpage.php");
exit();