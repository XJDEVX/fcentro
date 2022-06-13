-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2018 a las 00:19:18
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datos`
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

--
-- Volcado de datos para la tabla `caja_tmp`
--

INSERT INTO `caja_tmp` (`id`, `cod`, `nom`, `venta`, `cant`, `importe`, `exitencia`, `usu`) VALUES
(14, '2', 'CPU de Lujo', '80000', '16', '1280000', '0', 'ff'),
(15, '3', 'Impresora HP', '120000', '7', '840000', '15', 'ff'),
(86, '10', 'kamby', '5000', '1', '5000', '0', 'jorgejulio');

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

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id`, `factura`, `codigo`, `nombre`, `cantidad`, `valor`, `importe`, `tipo`) VALUES
(125, '1000', '2', 'CPU de Lujo', '1', '80000', '80000', 'CONTADO'),
(126, '1000', '3', 'Impresora HP', '1', '120000', '120000', 'CONTADO'),
(127, '1001', '1', 'Pantalla de Computador', '3', '200000', '600000', 'CONTADO'),
(128, '1001', '2', 'CPU de Lujo', '1', '80000', '80000', 'CONTADO'),
(129, '1002', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(130, '1002', '2', 'CPU de Lujo', '3', '80000', '240000', 'CONTADO'),
(131, '1003', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(132, '1003', '2', 'CPU de Lujo', '1', '80000', '80000', 'CONTADO'),
(133, '1003', '3', 'Impresora HP', '5', '120000', '600000', 'CONTADO'),
(134, '1004', '1', 'Pantalla de Computador', '2', '200000', '400000', 'CONTADO'),
(135, '1004', '2', 'CPU de Lujo', '3', '80000', '240000', 'CONTADO'),
(136, '1004', '3', 'Impresora HP', '2', '120000', '240000', 'CONTADO'),
(137, '1005', '2', 'CPU de Lujo', '1', '80000', '80000', 'CONTADO'),
(138, '1005', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(139, '1006', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(140, '1007', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(141, '1008', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(142, '1009', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(143, '1010', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(144, '1011', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(145, '1012', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(146, '1013', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(147, '1014', '1', 'Pantalla de Computador', '2', '200000', '400000', 'CONTADO'),
(148, '1015', '1', 'Pantalla de Computador', '1', '100000', '100000', 'CONTADO'),
(149, '1016', '1', 'Pantalla de Computador', '2', '100000', '200000', 'CONTADO'),
(150, '1017', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(151, '1018', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(152, '1019', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(153, '1020', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(154, '1021', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(155, '1022', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(156, '1023', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(157, '1024', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(158, '1025', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(159, '1026', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(160, '1027', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(161, '1028', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(162, '1029', '1', 'Pantalla de Computador', '2', '200000', '400000', 'CONTADO'),
(163, '1030', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(164, '1031', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(165, '1032', '1', 'Pantalla de Computador', '1', '200000', '200000', 'CONTADO'),
(166, '1033', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(167, '1034', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(168, '1035', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(169, '1036', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(170, '1037', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(171, '1038', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(172, '1039', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(173, '1040', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(174, '1041', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(175, '1042', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(176, '1043', '9789686321265', 'diccionario', '2', '15000', '30000', 'CONTADO'),
(177, '1044', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(178, '1045', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(179, '1046', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(180, '1047', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(181, '1048', '6935364091057', 'Tp-Link', '1', '200000', '200000', 'CONTADO'),
(182, '1048', '7840235002898', 'Kampito Citrus 2 litros', '1', '3500', '3500', 'CONTADO'),
(183, '1048', '6978661000711', 'Cargador Ecopwer', '1', '30000', '30000', 'CONTADO'),
(184, '1048', '7840294002983', 'Avon Flex 20 hojas', '1', '5000', '5000', 'CONTADO'),
(185, '1049', '6978661000711', 'Cargador Ecopwer', '1', '30000', '30000', 'CONTADO'),
(186, '1049', '7840294002983', 'Avon Flex 20 hojas', '1', '5000', '5000', 'CONTADO'),
(187, '1049', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(188, '1049', '6935364091057', 'Tp-Link', '1', '200000', '200000', 'CONTADO'),
(189, '1049', '7840235002898', 'Kampito Citrus 2 litros', '1', '3500', '3500', 'CONTADO'),
(190, '1050', '6978661000711', 'Cargador Ecopwer', '1', '30000', '30000', 'CONTADO'),
(191, '1050', '7840294002983', 'Avon Flex 20 hojas', '1', '5000', '5000', 'CONTADO'),
(192, '1050', '7840235002898', 'Kampito Citrus 2 litros', '1', '3500', '3500', 'CONTADO'),
(193, '1050', '6935364091057', 'Tp-Link', '1', '200000', '200000', 'CONTADO'),
(194, '1051', '6935364091057', 'Tp-Link', '1', '200000', '200000', 'CONTADO'),
(195, '1051', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(196, '1051', '7840235002898', 'Kampito Citrus 2 litros', '1', '3500', '3500', 'CONTADO'),
(197, '1051', '6978661000711', 'Cargador Ecopwer', '1', '30000', '30000', 'CONTADO'),
(198, '1051', '7840294002983', 'Avon Flex 20 hojas', '1', '5000', '5000', 'CONTADO'),
(199, '1052', '7840235002898', 'Kampito Citrus 2 litros', '2', '3500', '7000', 'CONTADO'),
(200, '1053', '9789686321265', 'diccionario', '2', '15000', '30000', 'CONTADO'),
(201, '1054', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(202, '1055', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(203, '1056', '9789686321265', 'diccionario', '1', '15000', '15000', 'CONTADO'),
(204, '1056', '6978661000711', 'Cargador Ecopwer', '1', '30000', '30000', 'CONTADO'),
(205, '1056', '7840294002983', 'Avon Flex 20 hojas', '1', '5000', '5000', 'CONTADO'),
(206, '1056', '6935364091057', 'Tp-Link', '2', '200000', '400000', 'CONTADO'),
(207, '1056', '7840235002898', 'Kampito Citrus 2 litros', '1', '3500', '3500', 'CONTADO'),
(208, '1056', '7898422746759', 'jabon dove original', '1', '4000', '4000', 'CONTADO'),
(209, '1056', '78923423', 'desodorante rexona a bolilla men', '1', '5000', '5000', 'CONTADO'),
(210, '1056', '7891150040175', 'sedal crema para peinar', '1', '5000', '5000', 'CONTADO'),
(211, '1057', '7840235002898', 'Kampito Citrus 2 litros', '6', '3500', '21000', 'CONTADO'),
(212, '1058', '7840235002898', 'Kampito Citrus 2 litros', '3', '5000', '15000', 'CONTADO'),
(213, '1059', '7840235002898', 'Kampito Citrus 2 litros', '2', '5000', '10000', 'CONTADO'),
(214, '1059', '6935364091057', 'Tp-Link', '1', '400000', '400000', 'CONTADO'),
(215, '1059', '7840294002983', 'Avon Flex 20 hojas', '1', '6000', '6000', 'CONTADO'),
(216, '1059', '9789686321265', 'diccionario', '1', '20000', '20000', 'CONTADO'),
(217, '1059', '6978661000711', 'Cargador Ecopwer', '1', '50000', '50000', 'CONTADO'),
(218, '1059', '7898422746759', 'jabon dove original', '1', '6500', '6500', 'CONTADO'),
(219, '1059', '7891150040175', 'sedal crema para peinar', '2', '6500', '13000', 'CONTADO'),
(220, '1059', '78923423', 'desodorante rexona a bolilla men', '1', '8000', '8000', 'CONTADO'),
(221, '1060', '7840235002898', 'Kampito Citrus 2 litros', '1', '5000', '5000', 'CONTADO'),
(222, '1061', '10', 'kamby', '2', '6000', '12000', 'CONTADO'),
(223, '1062', '7840235002898', 'Kampito Citrus 2 litros', '2', '5000', '10000', 'CONTADO');

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
(1, 'Soft Unicorn', '1234566789', 'Colombia', 'Cartagena', '66 000 00', '300 000 0000', 'facebook.com/soft.unicorn', 'facebook.com/soft.unicorn', '0', '15');

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

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`factura`, `cajera`, `fecha`, `estado`) VALUES
('1000', 'jorgejulio', '2013-07-07', 's'),
('1001', 'jorgejulio', '2013-07-08', 's'),
('1002', 'jorgejulio', '2013-07-08', 's'),
('1003', 'jorgejulio', '2013-07-08', 's'),
('1004', 'jorgejulio', '2018-05-18', 's'),
('1005', 'jorgejulio', '2018-05-22', 's'),
('1006', 'jorgejulio', '2018-05-23', 's'),
('1007', 'jorgejulio', '2018-05-24', 's'),
('1008', 'jorgejulio', '2018-05-24', 's'),
('1009', 'jorgejulio', '2018-05-24', 's'),
('1010', 'jorgejulio', '2018-05-24', 's'),
('1011', 'jorgejulio', '2018-05-24', 's'),
('1012', 'jorgejulio', '2018-05-24', 's'),
('1013', 'jorgejulio', '2018-05-24', 's'),
('1014', 'jorgejulio', '2018-05-24', 's'),
('1015', 'jorgejulio', '2018-05-25', 's'),
('1016', 'jorgejulio', '2018-05-25', 's'),
('1017', 'jorgejulio', '2018-05-25', 's'),
('1018', 'jorgejulio', '2018-05-25', 's'),
('1019', 'jorgejulio', '2018-05-25', 's'),
('1020', 'jorgejulio', '2018-05-25', 's'),
('1021', 'jorgejulio', '2018-05-25', 's'),
('1022', 'jorgejulio', '2018-05-25', 's'),
('1023', 'jorgejulio', '2018-05-25', 's'),
('1024', 'jorgejulio', '2018-05-25', 's'),
('1025', 'jorgejulio', '2018-05-25', 's'),
('1026', 'jorgejulio', '2018-05-25', 's'),
('1027', 'jorgejulio', '2018-05-25', 's'),
('1028', 'jorgejulio', '2018-05-25', 's'),
('1029', 'jorgejulio', '2018-05-25', 's'),
('1030', 'jorgejulio', '2018-05-25', 's'),
('1031', 'jorgejulio', '2018-05-25', 's'),
('1032', 'jorgejulio', '2018-05-25', 's'),
('1033', 'jorgejulio', '2018-06-07', 's'),
('1034', 'jorgejulio', '2018-06-07', 's'),
('1035', 'jorgejulio', '2018-06-07', 's'),
('1036', 'jorgejulio', '2018-06-07', 's'),
('1037', 'jorgejulio', '2018-06-07', 's'),
('1038', 'jorgejulio', '2018-06-07', 's'),
('1039', 'jorgejulio', '2018-06-07', 's'),
('1040', 'jorgejulio', '2018-06-07', 's'),
('1041', 'jorgejulio', '2018-06-07', 's'),
('1042', 'jorgejulio', '2018-06-07', 's'),
('1043', 'jorgejulio', '2018-06-07', 's'),
('1044', 'jorgejulio', '2018-06-07', 's'),
('1045', 'jorgejulio', '2018-06-07', 's'),
('1046', 'jorgejulio', '2018-06-07', 's'),
('1047', 'jorgejulio', '2018-06-07', 's'),
('1048', 'jorgejulio', '2018-06-07', 's'),
('1049', 'jorgejulio', '2018-06-07', 's'),
('1050', 'jorgejulio', '2018-06-07', 's'),
('1051', 'jorgejulio', '2018-06-07', 's'),
('1052', 'jorgejulio', '2018-06-07', 's'),
('1053', 'jorgejulio', '2018-06-07', 's'),
('1054', 'jorgejulio', '2018-06-07', 's'),
('1055', 'jorgejulio', '2018-06-07', 's'),
('1056', 'jorgejulio', '2018-06-07', 's'),
('1057', 'jorgejulio', '2018-06-07', 's'),
('1058', 'jorgejulio', '2018-06-07', 's'),
('1059', 'jorgejulio', '2018-06-07', 's'),
('1060', 'jorgejulio', '2018-06-07', 's'),
('1061', 'jorgejulio', '2018-06-07', 's'),
('1062', 'jorgejulio', '2018-06-07', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `cprov` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL,
  `mayor` varchar(255) NOT NULL,
  `venta` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `minimo` varchar(255) NOT NULL,
  `seccion` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `clase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod`, `prov`, `cprov`, `nom`, `costo`, `mayor`, `venta`, `cantidad`, `minimo`, `seccion`, `fecha`, `estado`, `clase`) VALUES
('10', '2', '34535', 'kamby', '5000', '5000', '6000', '0', '5', '0', '2018-05-29', 's', ''),
('6935364091057', '1', '', 'Tp-Link', '200000', '200000', '400000', '23', '5', '7', '2018-06-07', 's', ''),
('6978661000711', '1', '', 'Cargador Ecopwer', '30000', '30000', '50000', '44', '10', '0', '2018-06-07', 's', ''),
('7790240017090', '1', '', 'vino tinto', '6000', '6000', '7000', '50', '10', '0', '2018-06-07', 's', ''),
('7840235002898', '1', '', 'Kampito Citrus 2 litros', '3500', '3500', '5000', '35', '10', '0', '2018-06-07', 's', ''),
('7840294002983', '1', '', 'Avon Flex 20 hojas', '5000', '5000', '6000', '194', '10', '0', '2018-06-07', 's', ''),
('7891150040175', '1', '', 'sedal crema para peinar', '5000', '5000', '6500', '47', '5', '0', '2018-06-07', 's', ''),
('78923423', '1', '', 'desodorante rexona a bolilla men', '5000', '5000', '8000', '18', '10', '0', '2018-06-07', 's', ''),
('7898422746759', '1', '', 'jabon dove original', '4000', '4000', '6500', '10', '5', '0', '2018-06-07', 's', ''),
('9789686321265', '1', '34535', 'diccionario', '15000', '15000', '20000', '6', '5', '0', '2018-06-07', 's', '');

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

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codigo`, `empresa`, `nom`, `dir`, `ciudad`, `tel`, `cel`, `correo`, `obs`, `estado`) VALUES
(1, 'distribuidora jr', 'jorge Vasquez', 'Caracoles Manzana 36 lote 10', 'Cartagena - Colombia', '6679159', '3156856245', 'jlvasquez63@gmail.com', '', 's'),
(2, 'Umbrella', 'Vasquez', 'campestre', 'Medellin', '667198', '30000000', 'umbrella@hotmail.com', 'vende medicinas', 's'),
(3, 'Soft Unicorn colombia', 'jorge Vasquez', 'caracoles', 'Cartagena - Colombia', '6679159', '3156856245', 'jlvasquez63@gmail,com', '', 's'),
(4, 'lactolanda', '454545', 'encarnacion', 'encarnacion', '454545', '454545', 'lacto@gmail.com', 'buen producto', 's'),
(5, 'distribuidora jr', 'tu', 'hjk', 'hjk', '', '', '', '', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `nombre`, `estado`) VALUES
(6, 'Articulo Temporal', 's');

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
('12345678', 's', 'Charlie', 'Caracoles ', '6667776', '', '0', 'Caracoles', 'Cartagena', 'jorgejulio', '123', 'a'),
('2288300098', 's', 'Maria Julio', 'Centro Ciudad', '777366', '88847764', '0', 'Centro de la Ciudad #1', 'Barranquilla', 'mariajulio', '123', 'cl'),
('533', 's', 'fari', 'ewr', '5345', '345345', '1', 'erw', 'hh', 'ff', 'ff', 'ca'),
('6456456', 's', 'rata', 'fgdgd', '4535453', '65464564', '0', 'dfgdfg', 'fgdfg', 'rata', '123456', 'a'),
('76588477', 's', 'Daniela Herrera', 'Nuevo Bosque', '77849948', '99948877746', '0', 'caracoles', 'Bogota', 'dherrera', '123', 'ca'),
('rtjh', 's', 'ht', 'jk', '45', '5243', '0', 'k', 'ht', '02', 'rtjh', 'ca');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
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
