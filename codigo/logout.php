<?php

session_start();
$usuario = $_SESSION['usuario'];
session_destroy();

header("Location: landpage.php");
exit();