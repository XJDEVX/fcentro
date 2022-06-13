-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2018 a las 00:35:20
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `santaclaradb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_tmp`
--

CREATE TABLE `caja_tmp` (
  `id` int(255) NOT NULL,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `venta` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `exitencia` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(255) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(255) NOT NULL,
  `empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tel1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tel2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `iva` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `empresa`, `nit`, `direccion`, `ciudad`, `tel1`, `tel2`, `web`, `correo`, `iva`, `tamano`) VALUES
(1, 'Autoservicio Santa Clara', '1', 'Ruta 1 c/Av Coronel Bogado', 'Coronel Bogado', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `factura` varchar(255) NOT NULL,
  `cajera` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_tmp`
--

CREATE TABLE `permisos_tmp` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `very` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `cprov` varchar(255) NULL,
  `nom` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL,
  `mayor` varchar(255) NOT NULL,
  `venta` varchar(255) NOT NULL,
  `iva` int(10) NULL,
  `cantidad` varchar(255) NOT NULL,
  `minimo` varchar(255) NOT NULL,
  `seccion` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `clase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codigo` int(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ced` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `cupo` varchar(255) NOT NULL,
  `barrio` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ced`, `estado`, `nom`, `dir`, `tel`, `cel`, `cupo`, `barrio`, `ciudad`, `usu`, `con`, `tipo`) VALUES
('1234', 's', 'Charlie', '', '', '', '0', '', '', 'charlie', '1234', 'a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`factura`);

--
-- Indices de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ced`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codigo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
