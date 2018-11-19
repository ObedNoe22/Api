-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2018 a las 22:18:40
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
(2, 2, 'Codigo', 'Negocio2', 'Negocio2', 'mañana', 0, '2018-11-15 01:14:33', '2018-11-19 19:44:06');

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
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `disponibilidad` int(11) DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `nombre`, `direccion`, `longitud`, `latitud`, `disponibilidad`, `horario`, `created_at`, `updated_at`) VALUES
(2, 'Negocio2', 'Negocio2', 'Negocio2', 'Negocio2', 0, '', '2018-11-15 01:05:59', '2018-11-19 19:33:48'),
(3, 'Negocio3', 'Negocio3', 'Negocio3', 'Negocio3', NULL, NULL, '2018-11-19 19:19:20', '2018-11-19 19:19:20'),
(4, 'Negocio4', 'Negocio4', 'Negocio4', 'Negocio4', 0, '', '2018-11-19 19:19:58', '2018-11-19 19:19:58'),
(5, 'Negocio5', 'Negocio5', 'Negocio5', 'Negocio5', 0, '', '2018-11-19 20:30:28', '2018-11-19 20:30:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `costo` double NOT NULL,
  `disponible` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `costo`, `disponible`, `created_at`, `updated_at`) VALUES
(2, 'Actualizar', 500, 0, '0000-00-00 00:00:00', '2018-11-19 19:57:18'),
(3, 'No c xd33sad', 2000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `negocio_id`, `descripcion`, `created_at`, `updated_at`) VALUES
(2, 2, 'Cambio', '0000-00-00 00:00:00', '2018-11-19 19:48:43'),
(3, 3, 'prueba2', '2018-11-18 04:08:13', '2018-11-18 04:08:13'),
(4, 4, 'prueba3', '2018-11-18 04:08:30', '2018-11-18 04:08:30'),
(5, 5, 'prueba4', '2018-11-18 04:08:37', '2018-11-18 04:08:37');

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
(1, 'prueba', '$2y$10$W1VH1Zk8OL4aVZL0tnBfkeUycWgtKhmRuyvCeMRg.o5dBETKjzfFO', NULL, 0, '', '2018-11-14 22:11:51', '2018-11-14 22:11:51', NULL),
(2, 'prueba2', '$2y$10$WPm4cz9FbpvUJ6xbu47FHOSmutcskVm8WU3EqNEVzA3vKJSpr/RCe', NULL, 0, '', '2018-11-14 22:15:56', '2018-11-14 22:15:56', NULL),
(3, 'vendedor2', '$2y$10$3I.PB41b8EJtEWDX0f6G5.ZDve.x8TYf8bTmXV.SWOj6Jdqw.sYGq', 4, NULL, 'Inactivo', '2018-11-19 20:38:30', '2018-11-19 20:38:30', NULL);

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
(1, 'vendedor1', 'vendedor1', '2018-11-19 20:35:24', '2018-11-19 20:35:24'),
(2, 'vendedor3', 'vendedor3', '2018-11-19 20:36:57', '2018-11-19 20:36:57'),
(3, 'vendedor4', 'vendedor4', '2018-11-19 20:37:56', '2018-11-19 20:37:56'),
(4, 'vendedor5', 'vendedor5', '2018-11-19 20:38:30', '2018-11-19 20:38:30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
