-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 20:33:17
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infonete-final`
--
CREATE DATABASE IF NOT EXISTS `infonete-final` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infonete-final`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraedicion`
--

CREATE TABLE `compraedicion` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEdicion` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compranoticias`
--

CREATE TABLE `compranoticias` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idNoticia` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compranoticias`
--

INSERT INTO `compranoticias` (`id`, `idUsuario`, `idNoticia`, `precio`) VALUES
(1, 41, 3, '150');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidista`
--

CREATE TABLE `contenidista` (
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrasenia`
--

CREATE TABLE `contrasenia` (
  `id` int(11) NOT NULL,
  `clave` text NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `validado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contrasenia`
--

INSERT INTO `contrasenia` (`id`, `clave`, `idUsuario`, `codigo`, `validado`) VALUES
(20, '$2y$10$dK6OgUC5Lae9aDnQTccMJ.ywCrmYGpUCS0EgTsKlqYp2LplYQYvh.', 37, 468771, 1),
(21, '$2y$10$3Yq3lvSjnGH40/jJ0tF3Tu5ohvFRxNOL/7PT3doD7Bu03udt9t8hq', 38, 659843, 1),
(22, '$2y$10$/DBfaHOwc6gFfN44dakdiO0hFziK1nAluWUyW7p9wY1dcOmDoHzdq', 39, 593592, 1),
(23, '$2y$10$xxyNrOnSZn4rkcGLCkFhouZGjhle62W.C/vVQ/YxcWooMJ0iJNUiW', 40, 713797, 1),
(24, '$2y$10$FCvVher1x1bhcAdCogdEAekThgaHX7bGdObg1cHoePpj6bupMDGJ.', 0, 946351, 1),
(25, '$2y$10$cOCqLnJZttMUNm1ijY3ymeQaee/JyTMh.YiIox6EZXdiAmARMCIJO', 41, 835027, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion`
--

CREATE TABLE `edicion` (
  `id` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `descrip` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion`
--

INSERT INTO `edicion` (`id`, `idPublicacion`, `descrip`, `valor`) VALUES
(1, 1, '1', '4000'),
(2, 1, '2', '2500'),
(3, 5, '1', '3000'),
(4, 6, '1', '1500'),
(5, 7, '1', '2000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `idEdicion` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edicion_seccion`
--

INSERT INTO `edicion_seccion` (`idEdicion`, `idSeccion`) VALUES
(1, 2),
(1, 3),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(4, 3),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escritor`
--

CREATE TABLE `escritor` (
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadodepublicacion`
--

CREATE TABLE `estadodepublicacion` (
  `id` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadodepublicacion`
--

INSERT INTO `estadodepublicacion` (`id`, `Estado`) VALUES
(1, 'pendiente'),
(2, 'publicado'),
(3, 'baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE `lector` (
  `idUsuario` int(11) NOT NULL,
  `idSuscripcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Subtitulo` varchar(200) DEFAULT NULL,
  `Imagen` varchar(2000) DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL,
  `audio` int(11) DEFAULT NULL,
  `idSeccion` int(11) DEFAULT NULL,
  `idEdicion` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `idEscritor` int(11) NOT NULL,
  `idContenidista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id`, `Titulo`, `Subtitulo`, `Imagen`, `contenido`, `link`, `audio`, `idSeccion`, `idEdicion`, `precio`, `idEstado`, `idEscritor`, `idContenidista`) VALUES
(2, 'Inseguridad no para', 'mas 3 robos por dia', 'delito.jpg', '<p>agafdsasfasfasfasfaf</p>', 'https://www.google.com/search?q=messi+copa+del+mundo&sxsrf=ALiCzsbixn6QQbuRQhQgHqrsL_puiwp5mw:1669658183080&source=lnms&tbm=isch&sa=X&ved=2ahUKEwju-pe3udH7AhWtupUCHaNrCk0Q_AUoAXoECAMQAw&biw=1366&bih=592&dpr=1', NULL, 3, 4, 150, 1, 39, 38),
(3, 'messi gana la copa', 'asfafaf', 'messi.jpg', '<p>asfasdfasfafasf</p>', 'asfafasfasf', NULL, 1, 5, 150, 2, 39, NULL),
(4, 'diluvio en caracas', 'mucha agua', 'lluvia.jpg', '<h3>dasdasdasfasf</h3>', 'asdadsadad', NULL, 3, 4, 200, 1, 39, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `informacion` varchar(50) NOT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `informacion`, `ruta`) VALUES
(1, 'Pagina 12', 'public/img/publications/Pagina 12.png'),
(5, 'Clarin', 'public/img/publications/clarin.png'),
(6, 'La Nacion', 'public/img/publications/La Nacion.png'),
(7, 'Ole', 'public/img/publications/Ole.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'LECTOR'),
(2, 'ADMINISTRADOR'),
(3, 'ESCRITOR'),
(4, 'CONTENIDISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(11) NOT NULL,
  `descrip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `descrip`) VALUES
(1, 'Deporte'),
(2, 'Economia'),
(3, 'Social'),
(4, 'Politica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreApellido` varchar(30) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `longitud` varchar(20) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreApellido`, `ubicacion`, `email`, `latitud`, `longitud`, `activo`, `idRol`) VALUES
(38, 'Joni', 'Direccion', 'asd@asd', '-34.6882672', '-58.6118902', 1, 4),
(39, 'enrique', 'calle falsa 123', 'enrique@enrique', '-34.7612', '-58.3856', 1, 3),
(40, 'julian', 'calle falsa 456', 'julian@julian', '-34.7612', '-58.3856', 1, 2),
(41, 'Agustis Caceres', 'calle falsa 1444', 'test@test', '-34.7337245', '-58.4744297', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_admin_usuario` (`idUsuario`);

--
-- Indices de la tabla `compraedicion`
--
ALTER TABLE `compraedicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usuarioEdicion` (`idUsuario`),
  ADD KEY `fk_id_edicion` (`idEdicion`);

--
-- Indices de la tabla `compranoticias`
--
ALTER TABLE `compranoticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usuario` (`idUsuario`),
  ADD KEY `fk_id_noticia` (`idNoticia`);

--
-- Indices de la tabla `contenidista`
--
ALTER TABLE `contenidista`
  ADD KEY `fk_cont_usuario` (`idUsuario`);

--
-- Indices de la tabla `contrasenia`
--
ALTER TABLE `contrasenia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pub_edicion` (`idPublicacion`);

--
-- Indices de la tabla `escritor`
--
ALTER TABLE `escritor`
  ADD KEY `fk_escritor_usuario` (`idUsuario`);

--
-- Indices de la tabla `estadodepublicacion`
--
ALTER TABLE `estadodepublicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lector`
--
ALTER TABLE `lector`
  ADD KEY `fk_lector_usuario` (`idUsuario`),
  ADD KEY `fk_lector_suscripcion` (`idSuscripcion`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSeccion` (`idSeccion`),
  ADD KEY `idEdicion` (`idEdicion`),
  ADD KEY `idEstadoFk` (`idEstado`),
  ADD KEY `fk_escritor_nota` (`idEscritor`),
  ADD KEY `fk_contenidista_nota` (`idContenidista`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol_usuario` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compraedicion`
--
ALTER TABLE `compraedicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compranoticias`
--
ALTER TABLE `compranoticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contrasenia`
--
ALTER TABLE `contrasenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadodepublicacion`
--
ALTER TABLE `estadodepublicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_contenidista_nota` FOREIGN KEY (`idContenidista`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_escritor_nota` FOREIGN KEY (`idEscritor`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
