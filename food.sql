-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2020 a las 20:54:58
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `food`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_negocio`
--

CREATE TABLE `comentario_negocio` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario_negocio`
--

INSERT INTO `comentario_negocio` (`id`, `id_usuario`, `id_negocio`, `puntuacion`, `comentario`, `updated_at`, `created_at`) VALUES
(1, 54, 13, 3, 'Super Recomendado', '2020-05-19 18:41:49', '2020-05-19 18:41:49');

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
  `caducidad` date DEFAULT NULL,
  `usos` int(11) DEFAULT NULL,
  `activo` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cupones_diarios`
--

INSERT INTO `cupones_diarios` (`id`, `negocio_id`, `tipo`, `codigo`, `descripcion`, `caducidad`, `usos`, `activo`, `created_at`, `updated_at`) VALUES
(4, 13, 'codigo', 'xdddd', '4562', '2018-12-13', 0, 1, '2018-12-12 23:06:58', '2018-12-12 23:06:58'),
(5, 13, 'codigo', 'aaaaaa', 'prueba', NULL, NULL, 1, '2019-01-05 06:45:03', '2019-01-05 06:48:14');

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
(3, 13, 2, '2018-11-18 04:03:31', '2018-11-18 04:03:31'),
(4, 4, 3, '2018-11-18 04:04:00', '2018-11-18 04:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id` int(11) NOT NULL,
  `vendedorId` tinyint(4) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `correo` varchar(30) NOT NULL,
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

INSERT INTO `negocios` (`id`, `vendedorId`, `nombre`, `direccion`, `correo`, `longitud`, `latitud`, `disponibilidad`, `horario`, `created_at`, `updated_at`) VALUES
(13, 13, 'bbbbbb', 'Tecamac', 'correonegocio1@gmail.com', '-98.96830729999999', '19.7122732', '1', '02', '2018-11-22 05:57:26', '2019-01-08 03:19:49'),
(14, 13, 'PruebaUsuarios', 'Tecamac', 'pruebausu@gmail.com', '-98.9751502', '19.7732223', '0', '', '2019-01-09 22:17:29', '2019-01-09 22:17:29');

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
(3, 'Si cxdxd', 3000, 1, 13, '0000-00-00 00:00:00', '2018-12-12 04:23:29'),
(4, 'Productoaadsdsa', 4000, 1, 13, '2018-11-30 03:52:34', '2019-01-05 20:44:46'),
(5, 'aaaa', 200, 1, 13, '2018-12-12 20:55:30', '2018-12-12 20:55:30');

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
(3, 3, 'prueba2', 1, '2018-11-18 04:08:13', '2018-11-18 04:08:13'),
(4, 4, 'prueba3', 1, '2018-11-18 04:08:30', '2018-11-18 04:08:30'),
(6, 13, 'Prueba55j', 1, '2020-05-19 00:07:47', '2018-12-12 04:23:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `vendedorId` int(11) NOT NULL,
  `rol` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `vendedorId`, `rol`, `created_at`, `updated_at`) VALUES
(1, 13, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 13, 'Prueba', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `negocioId` int(11) DEFAULT NULL,
  `rolId` int(11) DEFAULT NULL COMMENT '0 Es para compradores,1 vendedores',
  `estado` tinyint(4) NOT NULL COMMENT '0 Inactivo,1 Activo',
  `correo` varchar(30) NOT NULL,
  `imagenPerfil` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `negocioId`, `rolId`, `estado`, `correo`, `imagenPerfil`, `created_at`, `updated_at`, `remember_token`) VALUES
(12, 'vendedor1', '$2y$10$o4V0OwhwdA6zCnWk1hJHy.RTYTbj1UWIrUM4iWBVt2eVWwlmIBK8m', 13, 2, 0, '', '', '2018-11-20 06:16:49', '2018-11-20 06:16:49', NULL),
(13, 'vendedor2', '$2y$10$h2Zyvn2YAshtZX8EDOoko.xwsCig4sVV43Lg4LHZsesu.rtF7daLW', 14, 1, 1, 'usuario1@hotmail.com', '13.png', '2018-11-20 06:17:34', '2019-02-21 00:26:37', NULL),
(14, 'xdxdxd', '$2y$10$e97URrfhG0c1l.dh8AHChO9L2/UockfKw9AV5DrLogMYYSlxe0f.S', 17, 2, 0, '', '', '2018-12-12 23:48:49', '2018-12-12 23:52:30', NULL),
(15, 'Prueba22', '$2y$10$K75HJLwZnKUAVDRVxX5xnOawjpDw/fiecBjhg5ZmH6HbajNiY4fM2', 14, 2, 1, 'usuarioprueba@gmail.com', '', '2019-01-01 21:41:40', '2019-01-09 23:48:27', NULL),
(17, 'Prueba222', '$2y$10$3xAQ2EY6RMMOkV38gl4Lp.O/zBfy.w/bSGj4BSEp68/0ZI6oxViAS', 15, 1, 0, '', '', '2019-01-01 22:17:06', '2019-01-01 22:17:06', NULL),
(45, 'sadfdfsgddfh', '$2y$10$IOt5dDO6FNgCyItkepekB.48NEQE53rriKySWqymLAIp4P/k.ae1u', NULL, 1, 0, 'sadfdfsgddfh', '45.jpeg', '2019-02-27 23:51:21', '2019-02-27 23:51:21', NULL),
(46, 'asdfdaasf', '$2y$10$102TddDxj26tVsHvte3GHOrjcS/KuuPbSI9ppFA276O8d/SpWyTv.', NULL, 1, 0, 'asdfdaasf', '46.jpeg', '2019-02-28 00:01:55', '2019-02-28 00:01:56', NULL),
(47, 'afssdfsagsaffsd', '$2y$10$IKGw8E5c169P.G5K9.4ULedyea7dYBR2QyucLLstnk5oDKukaifoC', NULL, 1, 0, 'afssdfsagsaffsd', '', '2019-02-28 00:11:26', '2019-02-28 00:11:26', NULL),
(51, 'kypergio', '$2y$10$QNrTBW2LZUN1XSLtNn2T7.Ro26KNsLQHHObursyZbAWE3UOqKAFLm', NULL, 1, 0, 'kypergio@gmail.com', '', '2019-03-04 21:42:45', '2019-03-04 21:42:45', NULL),
(54, 'obednoe22', '$2y$10$W31IlmPg240RpASKJrJl0OEhtYfjNNrnpT31MtPBB2.viuD5MiTdG', NULL, 0, 1, 'obednoe22@gmail.com', '', '2019-03-11 23:58:27', '2019-03-11 23:58:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id`, `usuarioId`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES
(13, 13, 'Obed Noe', 'Martinez', '2018-11-20 06:16:48', '2018-11-20 06:16:48'),
(45, 0, 'sadfdfsgddfh', 'sadfdfsgddfh', '2019-02-27 23:51:21', '2019-02-27 23:51:21'),
(46, 0, 'aaaaaaaaaaaaaaa', 'asdfdaasf', '2019-02-28 00:01:56', '2019-02-28 00:01:56'),
(47, 0, 'afssdfsagsaffsd', 'afssdfsagsaffsd', '2019-02-28 00:11:26', '2019-02-28 00:11:26'),
(48, 51, 'Giovanni', 'Prueba', '2019-03-04 21:42:45', '2019-03-04 21:42:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario_negocio`
--
ALTER TABLE `comentario_negocio`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT de la tabla `comentario_negocio`
--
ALTER TABLE `comentario_negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cupones_anuales`
--
ALTER TABLE `cupones_anuales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones_diarios`
--
ALTER TABLE `cupones_diarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
