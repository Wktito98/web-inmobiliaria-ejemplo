-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220501.6af017a6ad
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2022 a las 11:49:42
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--
CREATE DATABASE IF NOT EXISTS `inmobiliaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `inmobiliaria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL,
  `dato` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dashboard`
--

INSERT INTO `dashboard` (`id`, `dato`, `valor`) VALUES
(1, 'visitas', 1642),
(2, 'usuarios', 1),
(3, 'publicacion', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `id_emisor` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `leido` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planta`
--

CREATE TABLE `planta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `planta`
--

INSERT INTO `planta` (`id`, `descripcion`) VALUES
(1, 'Bajo'),
(2, 'Planta Intermedia'),
(3, 'Ultima Planta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio` double NOT NULL DEFAULT 0,
  `tipo` varchar(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'A' COMMENT '[A]lquiler,[V]enta',
  `notificaciones` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `fechaPublicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vivienda`
--

CREATE TABLE `tipo_vivienda` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_vivienda`
--

INSERT INTO `tipo_vivienda` (`id`, `descripcion`) VALUES
(1, 'Obra Nueva'),
(2, 'Viviendas'),
(3, 'Oficina'),
(4, 'Local o Nave'),
(5, 'Garaje'),
(6, 'Terreno'),
(7, 'Trastero'),
(8, 'Edificio'),
(9, 'Estudio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `telefono`, `email`, `usuario`, `clave`, `admin`) VALUES
(20, 'Alberto', 'Rodriguez Perez', '657747574', 'albertoooo9846@gmail.com', 'WKtito98', '$2y$10$TD7RBUitfoCPa6vpDQKF2eOJg2cj6e3vNsFa32opJxq7kKKifIy5i', 1);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `Automatizar Preferencias` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
INSERT INTO preferencias VALUES
(null,NEW.id,0,'A',0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_vivienda_publicaciones_imagenes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_vivienda_publicaciones_imagenes` (
`id` int(11)
,`codigoVivienda` varchar(100)
,`direccion` varchar(200)
,`numero` int(11)
,`cp` int(11)
,`precio` int(11)
,`pais` varchar(50)
,`provincia` varchar(50)
,`localidad` varchar(50)
,`metros` int(11)
,`venta_alquiler` varchar(1)
,`planta` int(11)
,`tipo` int(11)
,`habitaciones` int(11)
,`banios` int(11)
,`descripcion` text
,`piscina` tinyint(1)
,`aire_acondicionado` tinyint(1)
,`armarios_empotrados` tinyint(1)
,`ascensor` tinyint(1)
,`terraza` tinyint(1)
,`trastero` tinyint(1)
,`garaje` tinyint(1)
,`jardin` tinyint(1)
,`camino` varchar(200)
,`principal` tinyint(4)
,`activo` tinyint(1)
,`id_usuario` int(11)
,`fechaPublicacion` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `id` int(11) NOT NULL,
  `codigoVivienda` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `pais` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `metros` int(11) NOT NULL,
  `venta_alquiler` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT '[V]enta,[A]lquiler',
  `planta` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `banios` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `piscina` tinyint(1) NOT NULL DEFAULT 0,
  `aire_acondicionado` tinyint(1) NOT NULL DEFAULT 0,
  `armarios_empotrados` tinyint(1) NOT NULL DEFAULT 0,
  `ascensor` tinyint(1) NOT NULL DEFAULT 0,
  `terraza` tinyint(1) NOT NULL DEFAULT 0,
  `trastero` tinyint(1) NOT NULL DEFAULT 0,
  `garaje` tinyint(1) NOT NULL DEFAULT 0,
  `jardin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda_img`
--

CREATE TABLE `vivienda_img` (
  `id` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `camino` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `principal` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_vivienda_publicaciones_imagenes`
--
DROP TABLE IF EXISTS `vista_vivienda_publicaciones_imagenes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_vivienda_publicaciones_imagenes`  AS SELECT `vivienda`.`id` AS `id`, `vivienda`.`codigoVivienda` AS `codigoVivienda`, `vivienda`.`direccion` AS `direccion`, `vivienda`.`numero` AS `numero`, `vivienda`.`cp` AS `cp`, `vivienda`.`precio` AS `precio`, `vivienda`.`pais` AS `pais`, `vivienda`.`provincia` AS `provincia`, `vivienda`.`localidad` AS `localidad`, `vivienda`.`metros` AS `metros`, `vivienda`.`venta_alquiler` AS `venta_alquiler`, `vivienda`.`planta` AS `planta`, `vivienda`.`tipo` AS `tipo`, `vivienda`.`habitaciones` AS `habitaciones`, `vivienda`.`banios` AS `banios`, `vivienda`.`descripcion` AS `descripcion`, `vivienda`.`piscina` AS `piscina`, `vivienda`.`aire_acondicionado` AS `aire_acondicionado`, `vivienda`.`armarios_empotrados` AS `armarios_empotrados`, `vivienda`.`ascensor` AS `ascensor`, `vivienda`.`terraza` AS `terraza`, `vivienda`.`trastero` AS `trastero`, `vivienda`.`garaje` AS `garaje`, `vivienda`.`jardin` AS `jardin`, `vivienda_img`.`camino` AS `camino`, `vivienda_img`.`principal` AS `principal`, `publicacion`.`activo` AS `activo`, `publicacion`.`id_usuario` AS `id_usuario`, `publicacion`.`fechaPublicacion` AS `fechaPublicacion` FROM ((`vivienda` left join `vivienda_img` on(`vivienda`.`id` = `vivienda_img`.`id_vivienda`)) left join `publicacion` on(`vivienda`.`id` = `publicacion`.`id_vivienda`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_emisor` (`id_emisor`),
  ADD KEY `id_receptor` (`id_receptor`);

--
-- Indices de la tabla `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferencias_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_vivienda` (`id_vivienda`);

--
-- Indices de la tabla `tipo_vivienda`
--
ALTER TABLE `tipo_vivienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planta` (`planta`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `vivienda_img`
--
ALTER TABLE `vivienda_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vivienda` (`id_vivienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `planta`
--
ALTER TABLE `planta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `tipo_vivienda`
--
ALTER TABLE `tipo_vivienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `vivienda_img`
--
ALTER TABLE `vivienda_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_emisor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_receptor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD CONSTRAINT `preferencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicacion_ibfk_2` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD CONSTRAINT `vivienda_ibfk_2` FOREIGN KEY (`planta`) REFERENCES `planta` (`id`),
  ADD CONSTRAINT `vivienda_ibfk_3` FOREIGN KEY (`tipo`) REFERENCES `tipo_vivienda` (`id`);

--
-- Filtros para la tabla `vivienda_img`
--
ALTER TABLE `vivienda_img`
  ADD CONSTRAINT `vivienda_img_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
