-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2022 a las 01:48:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg_web_academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_sesion` varchar(30) NOT NULL,
  `id_producto` int(3) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `precio` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `categoria` varchar(80) NOT NULL,
  `fecha_producto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `url_img` varchar(80) NOT NULL,
  `alt_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `categoria`, `fecha_producto`, `url_img`, `alt_img`) VALUES
(1, '<i>Style guides</i> para aplicaciones con Christian Vizcarra', 'Uno de los elementos claves para el desarrollo web y de aplicaciones es la <i>style guide</i>, que sirve para documentar e informar todos los equipos involucrados en el proceso, especialmente a los programadores. En este curso el instructor muestra como crear una <i>style guide</i> paso a paso para que no solo se vea bien sino que, a su vez, sea altamente funcional.', 9.99, 'Cursos', '2022-06-11 17:11:01', 'https://i.imgur.com/lskBfHb.jpg', 'Style guides para aplicaciones con Christian Vizcarra'),
(2, 'Transforma los datos en arte, con Sonja Kuijper', 'Este curso te proporciona las herramientas necesarias para transformar lo objetivo en ilustraciones cautivadoras, recopilar y analizar un conjunto de datos para crear un arte final distintivo con una historia de trasfondo.', 12.99, 'Cursos', '2022-06-11 17:12:15', 'https://i.imgur.com/2ze79iV.jpg', 'Transforma los datos en arte, con Sonja Kuijper'),
(3, 'No me hagas pensar (ed. digital)', 'Un libro querido y recomendado sobre el la usabilidad. Steve regresa con nueva perspectiva para reexaminar los principios web actualizados y un nuevo apartado de usabilidad para apps. Profusamente ilustrado... y lo mejor de todo divertido de leer.', 11.90, 'Libros', '2022-06-11 17:26:20', 'https://i.imgur.com/upv5rJV.jpg', 'No me hagas pensar'),
(4, 'Adobe Creative Cloud (12 meses)', 'Un pack ahorro para el software preferido por los expertos en la materia. Incluye productos como Photoshop, InDesign, Illustrator, After Effects y muchos otros.', 729.99, 'Software', '2022-06-11 17:25:47', 'https://i.imgur.com/oto6ipa.jpg', 'Adobe Creative Cloud'),
(5, '<i>Web Form Design: Filling in the Blanks</i> (ENG)', '<i>Forms make or break the most crucial online interactions: checkout (commerce), registration (community), data input (participation and sharing), and any task requiring information entry.</i>', 41.30, 'Libros', '2022-06-11 17:31:40', 'https://i.imgur.com/1OEznyQ.jpg', 'Web Form Design: Filling in the Blanks'),
(6, 'Lean UX', 'Lean UX ofrece una perspectiva completa de la manera en que los principios de Lean Startup pueden aplicarse en el contexto del mundo UX, formando parte con el Desarrollo de Clientes, el <i>design thinking</i> y otros. Este libro introduce nuevas herramientas para conseguir productos mucho mejores.', 16.50, 'Libros', '2022-06-11 17:32:05', 'https://i.imgur.com/3T4hRsM.jpg', 'Lean UX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(60) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`email`, `nombre`, `pass`, `fecha_registro`, `administrador`) VALUES
('carola@gmail.com', 'Carola', 'usuario_03', '2022-06-09 21:16:59', 0),
('eva@gmail.com', 'Eva', 'usuario_02', '2022-06-09 21:15:05', 0),
('isabelhmoyo@gmail.com', 'Isabel', 'admin_ihm', '2022-05-21 11:54:08', 1),
('paul123@gmail.com', 'Paul', 'usuario_01', '2022-06-09 21:12:29', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
