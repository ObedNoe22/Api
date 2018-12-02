-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2018 a las 00:11:32
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foodlyxapi`
--
CREATE DATABASE IF NOT EXISTS `foodlyxapi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `foodlyxapi`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_anuales`
--

CREATE TABLE `cupones_anuales` (
  `id` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `codigo` varchar(80) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones_diarios`
--

CREATE TABLE `cupones_diarios` (
  `id` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL COMMENT 'Tipo codigo,Tipo por fecha y Tipo por uso',
  `codigo` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `caducidad` varchar(80) NOT NULL,
  `activo` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cupones_diarios`
--

INSERT INTO `cupones_diarios` (`id`, `negocio_id`, `tipo`, `codigo`, `descripcion`, `caducidad`, `activo`, `created_at`, `updated_at`) VALUES
(3, 13, 'codigo', 'aaaa', 'PruebaReg', '2018-11-30', 1, '2018-11-25 02:38:58', '2018-11-29 00:22:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `negocio_id`, `producto_id`, `created_at`, `updated_at`) VALUES
(2, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 2, '2018-11-18 04:03:31', '2018-11-18 04:03:31'),
(4, 4, 3, '2018-11-18 04:04:00', '2018-11-18 04:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id` int(11) NOT NULL,
  `vendedorNombre` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `disponibilidad` varchar(20) DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `vendedorNombre`, `nombre`, `direccion`, `longitud`, `latitud`, `disponibilidad`, `horario`, `created_at`, `updated_at`) VALUES
(13, 'vendedor2', 'bbbbbb', 'bbbbb', '-98.9701005', '19.6794577', '0', '02', '2018-11-22 05:57:26', '2018-11-28 22:54:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `costo` double NOT NULL,
  `disponible` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `costo`, `disponible`, `negocio_id`, `created_at`, `updated_at`) VALUES
(3, 'Si c', 3000, 0, 13, '0000-00-00 00:00:00', '2018-11-30 04:06:23'),
(4, 'Producto', 200, 1, 13, '2018-11-30 03:52:34', '2018-11-30 03:52:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `disponible` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `negocio_id`, `descripcion`, `disponible`, `created_at`, `updated_at`) VALUES
(2, 2, 'Cambio', 0, '0000-00-00 00:00:00', '2018-11-19 19:48:43'),
(3, 3, 'prueba2', 0, '2018-11-18 04:08:13', '2018-11-18 04:08:13'),
(4, 4, 'prueba3', 0, '2018-11-18 04:08:30', '2018-11-18 04:08:30'),
(6, 13, 'Prueba55', 0, '2018-11-29 00:07:47', '2018-11-29 00:21:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vendedorId` int(11) DEFAULT NULL,
  `rolId` int(11) DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `vendedorId`, `rolId`, `estado`, `created_at`, `updated_at`, `remember_token`) VALUES
(12, 'vendedor1', '$2y$10$o4V0OwhwdA6zCnWk1hJHy.RTYTbj1UWIrUM4iWBVt2eVWwlmIBK8m', 13, NULL, 'Inactivo', '2018-11-20 06:16:49', '2018-11-20 06:16:49', NULL),
(13, 'vendedor2', '$2y$10$FBwM644UVMsBoCJ.qtQtVuZT/88.io1rrHGsbzWgacJkpPKvtxLle', 14, NULL, 'Inactivo', '2018-11-20 06:17:34', '2018-11-20 06:17:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES
(13, 'vendedor1', 'vendedor1', '2018-11-20 06:16:48', '2018-11-20 06:16:48'),
(14, 'Obed', 'Martinez', '2018-11-20 06:17:34', '2018-11-20 06:17:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cupones_anuales`
--
ALTER TABLE `cupones_anuales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cupones_diarios`
--
ALTER TABLE `cupones_diarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cupones_anuales`
--
ALTER TABLE `cupones_anuales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones_diarios`
--
ALTER TABLE `cupones_diarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
