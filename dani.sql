-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dani
CREATE DATABASE IF NOT EXISTS `dani` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dani`;

-- Dumping structure for table dani.caja_tmp
CREATE TABLE IF NOT EXISTS `caja_tmp` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cod` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `venta` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `exitencia` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dani.caja_tmp: ~2 rows (approximately)
DELETE FROM `caja_tmp`;
/*!40000 ALTER TABLE `caja_tmp` DISABLE KEYS */;
INSERT INTO `caja_tmp` (`id`, `cod`, `nom`, `venta`, `cant`, `importe`, `exitencia`, `usu`) VALUES
	(4, '001', 'Notebook Acer 8va generacion l', '2000000', '1', '2000000', '10', 'dani'),
	(5, '002', 'Teclado Razor mecanico', '250000', '1', '250000', '7', 'dani');
/*!40000 ALTER TABLE `caja_tmp` ENABLE KEYS */;

-- Dumping structure for table dani.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(100) NOT NULL,
  `nombrecli` varchar(255) NOT NULL,
  `celular` int(255) DEFAULT NULL,
  `direc` varchar(255) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.clientes: ~0 rows (approximately)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Dumping structure for table dani.detalle
CREATE TABLE IF NOT EXISTS `detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura` varchar(255) CHARACTER SET latin1 NOT NULL,
  `codigo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cantidad` varchar(255) CHARACTER SET latin1 NOT NULL,
  `valor` varchar(255) CHARACTER SET latin1 NOT NULL,
  `importe` varchar(255) CHARACTER SET latin1 NOT NULL,
  `iva` int(100) NOT NULL,
  `iva1` int(100) NOT NULL,
  `iva2` int(100) NOT NULL,
  `totalIva` int(100) NOT NULL,
  `total` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.detalle: ~0 rows (approximately)
DELETE FROM `detalle`;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;

-- Dumping structure for table dani.detallecompra
CREATE TABLE IF NOT EXISTS `detallecompra` (
  `id` int(11) NOT NULL,
  `factura` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `iva` int(10) NOT NULL,
  `iva1` int(10) NOT NULL,
  `iva2` int(10) NOT NULL,
  `totalIva` int(100) NOT NULL,
  `total` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.detallecompra: ~0 rows (approximately)
DELETE FROM `detallecompra`;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;

-- Dumping structure for table dani.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
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

-- Dumping data for table dani.empresa: ~0 rows (approximately)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id`, `empresa`, `nit`, `direccion`, `ciudad`, `tel1`, `tel2`, `web`, `correo`, `iva`, `tamano`) VALUES
	(1, 'Autoservicio Santa Clara', '1', 'Ruta 1 c/Av Coronel Bogado', 'Coronel Bogado', '', '', '', '', '', '');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Dumping structure for table dani.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `factura` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cajera` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nombrecli` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cedula` varchar(100) CHARACTER SET latin1 NOT NULL,
  `total` float DEFAULT NULL,
  `iva` int(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.factura: ~0 rows (approximately)
DELETE FROM `factura`;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

-- Dumping structure for table dani.facturacompra
CREATE TABLE IF NOT EXISTS `facturacompra` (
  `factura` int(100) NOT NULL,
  `cajera` varchar(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `rucprov` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.facturacompra: ~0 rows (approximately)
DELETE FROM `facturacompra`;
/*!40000 ALTER TABLE `facturacompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturacompra` ENABLE KEYS */;

-- Dumping structure for table dani.permisos_tmp
CREATE TABLE IF NOT EXISTS `permisos_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `very` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dani.permisos_tmp: ~0 rows (approximately)
DELETE FROM `permisos_tmp`;
/*!40000 ALTER TABLE `permisos_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos_tmp` ENABLE KEYS */;

-- Dumping structure for table dani.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `cod` varchar(255) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `cprov` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL,
  `mayor` varchar(255) DEFAULT NULL,
  `venta` varchar(255) NOT NULL,
  `venta2` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) NOT NULL,
  `minimo` varchar(255) DEFAULT '2',
  `seccion` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(50) DEFAULT NULL,
  `clase` varchar(255) DEFAULT NULL,
  `iva` varchar(255) DEFAULT '10',
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dani.producto: ~3 rows (approximately)
DELETE FROM `producto`;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`cod`, `prov`, `cprov`, `nom`, `costo`, `mayor`, `venta`, `venta2`, `cantidad`, `minimo`, `seccion`, `fecha`, `estado`, `clase`, `iva`) VALUES
	('001', '2', '1', 'Notebook Acer 8va generacion l', '2500000', NULL, '3000000', '2000000', '18', '6', '1', '2020-06-06 10:30:58', '0', NULL, '10'),
	('002', '1', '2', 'Teclado Razor mecanico', '230000', NULL, '260000', '250000', '8', '2', '1', '2020-06-11 00:43:28', '0', NULL, '10');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Dumping structure for table dani.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `cel` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 's',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dani.proveedor: ~2 rows (approximately)
DELETE FROM `proveedor`;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`id`, `codigo`, `empresa`, `nom`, `dir`, `ciudad`, `tel`, `cel`, `correo`, `obs`, `estado`) VALUES
	(1, '1', 'Proveedor por defecto', '5678909-2', '', '', '', '555', '', '', 's'),
	(2, '12', 'Proveedor 1', '534534534', 'Direccion', '', '', '646464', '', '', 's'),
	(5, '', 'fsdsfdsfsdfdsf', '4534545-2', '', '', '', '', '', '', 's');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Dumping structure for table dani.seccion
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dani.seccion: ~1 rows (approximately)
DELETE FROM `seccion`;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` (`id`, `nombre`, `estado`) VALUES
	(2, 'Categoria por defecto', 's');
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;

-- Dumping structure for table dani.temp
CREATE TABLE IF NOT EXISTS `temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `costo` varchar(100) NOT NULL,
  `cant` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `existencia` varchar(100) NOT NULL,
  `iva` int(10) NOT NULL,
  `usu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table dani.temp: ~1 rows (approximately)
DELETE FROM `temp`;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;

-- Dumping structure for table dani.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'E',
  `entrada` datetime NOT NULL,
  `salida` datetime NOT NULL,
  `foto` varchar(100) NOT NULL,
  `estado` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dani.usuarios: ~1 rows (approximately)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `direccion`, `telefono`, `celular`, `email`, `barrio`, `ciudad`, `username`, `password`, `rol`, `entrada`, `salida`, `foto`, `estado`) VALUES
	(1, '1234', 'Charlie', '', '', '', '0', '', '', 'dani', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'A', '2020-06-17 19:38:27', '2020-06-17 17:32:59', '', '1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
