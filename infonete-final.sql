-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2022 a las 15:40:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
                            `id` int(11) NOT NULL,
                            `texto` text NOT NULL,
                            `idEscritor` int(11) NOT NULL,
                            `valor` decimal(10,0) NOT NULL,
                            `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
                                                                                 (23, '$2y$10$xxyNrOnSZn4rkcGLCkFhouZGjhle62W.C/vVQ/YxcWooMJ0iJNUiW', 40, 713797, 1);

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
                                                             (6, 2),
                                                             (6, 3),
                                                             (6, 4);

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
                        `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
    (5, 'Clarin', 'public/img/publications/clarin.png');

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
                           `nombre` varchar(30) NOT NULL,
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

INSERT INTO `usuario` (`id`, `nombre`, `ubicacion`, `email`, `latitud`, `longitud`, `activo`, `idRol`) VALUES
                                                                                                           (37, 'Agustin', 'Direccion', 'test@test.com', '-34.6882825', '-58.6118834', 1, 1),
                                                                                                           (38, 'Joni', 'Direccion', 'asd@asd', '-34.6882672', '-58.6118902', 1, 4),
                                                                                                           (39, 'enrique', 'calle falsa 123', 'enrique@enrique', '-34.7612', '-58.3856', 1, 3),
                                                                                                           (40, 'julian', 'calle falsa 456', 'julian@julian', '-34.7612', '-58.3856', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
    ADD KEY `fk_admin_usuario` (`idUsuario`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idEstado` (`idEstado`),
  ADD KEY `fk_esc_articulo` (`idEscritor`);

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
  ADD KEY `idEstadoFk` (`idEstado`);

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
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contrasenia`
--
ALTER TABLE `contrasenia`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `edicion`
--
ALTER TABLE `edicion`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estadodepublicacion`
--
ALTER TABLE `estadodepublicacion`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
    ADD CONSTRAINT `fk_admin_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
    ADD CONSTRAINT `fk_esc_articulo` FOREIGN KEY (`idEscritor`) REFERENCES `escritor` (`idUsuario`),
  ADD CONSTRAINT `fk_estado_articulo` FOREIGN KEY (`idEstado`) REFERENCES `estadodepublicacion` (`id`);

--
-- Filtros para la tabla `contenidista`
--
ALTER TABLE `contenidista`
    ADD CONSTRAINT `fk_cont_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `edicion`
--
ALTER TABLE `edicion`
    ADD CONSTRAINT `fk_pub_edicion` FOREIGN KEY (`idPublicacion`) REFERENCES `publicacion` (`id`);

--
-- Filtros para la tabla `escritor`
--
ALTER TABLE `escritor`
    ADD CONSTRAINT `fk_escritor_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `lector`
--
ALTER TABLE `lector`
    ADD CONSTRAINT `fk_lector_suscripcion` FOREIGN KEY (`idSuscripcion`) REFERENCES `suscripcion` (`id`),
  ADD CONSTRAINT `fk_lector_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
    ADD CONSTRAINT `idEstadoFk` FOREIGN KEY (`idEstado`) REFERENCES `estadodepublicacion` (`id`),
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`idSeccion`) REFERENCES `seccion` (`id`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`idEdicion`) REFERENCES `edicion` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
    ADD CONSTRAINT `fk_rol_usuario` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
