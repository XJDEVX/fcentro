-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for fcentro
CREATE DATABASE IF NOT EXISTS `fcentro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fcentro`;

-- Dumping structure for table fcentro.caja_tmp
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.caja_tmp: ~2 rows (approximately)
DELETE FROM `caja_tmp`;
/*!40000 ALTER TABLE `caja_tmp` DISABLE KEYS */;
INSERT INTO `caja_tmp` (`id`, `cod`, `nom`, `venta`, `cant`, `importe`, `exitencia`, `usu`) VALUES
	(1, '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '110000', '1', '110000', '990', 'empleado');
/*!40000 ALTER TABLE `caja_tmp` ENABLE KEYS */;

-- Dumping structure for table fcentro.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(100) NOT NULL,
  `nombrecli` varchar(255) NOT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `direc` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.clientes: ~8 rows (approximately)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `cedula`, `nombrecli`, `celular`, `direc`, `estado`) VALUES
	(1, '123456', 'Cliente por Defecto', '', '', 1),
	(2, '5248934', 'Juan Esteban Rodriguez Garcia', '0986236788', 'Calle Sargento Dure Casi Ruta Nro 1', 1),
	(3, '5613789', 'Sara Miranda', '', '', 1),
	(4, '1260770', 'Toni Gambino', '', '', 1),
	(5, '2424234234', 'Carlo Gambino', '', '', 1),
	(6, '7787687', 'Jose Heredia', '', '', 1),
	(7, '32137', 'Raul Salinas', '', '', 1),
	(8, '346238', 'Sabrina Goncalves', '', '', 1),
	(9, '123456', 'diego valenzuwela', '', 'san', 1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Dumping structure for table fcentro.credito
CREATE TABLE IF NOT EXISTS `credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(50) NOT NULL,
  `usuario_caja` varchar(50) NOT NULL,
  `detalle_id` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `entrega` enum('Y','N') NOT NULL DEFAULT 'N',
  `interes` int(11) NOT NULL,
  `total_cuotas` int(11) NOT NULL,
  `total_con_interes` int(11) NOT NULL,
  `saldo` varchar(50) DEFAULT NULL,
  `estado` enum('PAGADO','PENDIENTE') NOT NULL DEFAULT 'PENDIENTE',
  PRIMARY KEY (`id`),
  KEY `FK_credito_detalle` (`detalle_id`),
  CONSTRAINT `FK_credito_detalle` FOREIGN KEY (`detalle_id`) REFERENCES `detalle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.credito: ~0 rows (approximately)
DELETE FROM `credito`;
/*!40000 ALTER TABLE `credito` DISABLE KEYS */;
INSERT INTO `credito` (`id`, `cliente`, `usuario_caja`, `detalle_id`, `fecha_inicio`, `fecha_fin`, `entrega`, `interes`, `total_cuotas`, `total_con_interes`, `saldo`, `estado`) VALUES
	(1, 'Sara Miranda', 'admin', 31, '2021-08-02 07:46:51', '2021-10-02 07:46:51', 'Y', 0, 2, 650000, '325000', 'PENDIENTE');
/*!40000 ALTER TABLE `credito` ENABLE KEYS */;

-- Dumping structure for table fcentro.cuotas
CREATE TABLE IF NOT EXISTS `cuotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credito_id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `monto` int(11) NOT NULL,
  `fecha_a_pagar` date NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `vencimiento` date NOT NULL,
  `estado` enum('PAGADO','PENDIENTE') NOT NULL DEFAULT 'PENDIENTE',
  PRIMARY KEY (`id`),
  KEY `FK_cuotas_credito` (`credito_id`),
  CONSTRAINT `FK_cuotas_credito` FOREIGN KEY (`credito_id`) REFERENCES `credito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.cuotas: ~2 rows (approximately)
DELETE FROM `cuotas`;
/*!40000 ALTER TABLE `cuotas` DISABLE KEYS */;
INSERT INTO `cuotas` (`id`, `credito_id`, `numero`, `monto`, `fecha_a_pagar`, `fecha_pago`, `vencimiento`, `estado`) VALUES
	(1, 1, '1', 325000, '2021-09-02', '2021-10-02', '2021-09-07', 'PAGADO'),
	(2, 1, '2', 325000, '2021-10-02', NULL, '2021-10-07', 'PENDIENTE');
/*!40000 ALTER TABLE `cuotas` ENABLE KEYS */;

-- Dumping structure for table fcentro.detalle
CREATE TABLE IF NOT EXISTS `detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura` varchar(255) CHARACTER SET latin1 NOT NULL,
  `codigo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cantidad` varchar(255) CHARACTER SET latin1 NOT NULL,
  `valor` varchar(255) CHARACTER SET latin1 NOT NULL,
  `importe` varchar(255) CHARACTER SET latin1 NOT NULL,
  `iva` int(100) DEFAULT NULL,
  `iva1` int(100) DEFAULT NULL,
  `iva2` int(100) DEFAULT NULL,
  `totalIva` int(100) DEFAULT NULL,
  `total` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.detalle: ~25 rows (approximately)
DELETE FROM `detalle`;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
INSERT INTO `detalle` (`id`, `factura`, `codigo`, `nombre`, `cantidad`, `valor`, `importe`, `iva`, `iva1`, `iva2`, `totalIva`, `total`, `tipo`, `fecha_ingreso`) VALUES
	(5, '1000', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-06-18 08:13:23'),
	(6, '1001', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-06-30 20:13:33'),
	(7, '1002', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-06-30 20:52:03'),
	(8, '1003', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-06-30 20:52:18'),
	(9, '1004', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-06-30 21:05:57'),
	(10, '1005', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '650000', '', '2021-06-30 21:07:41'),
	(11, '1006', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:31:14'),
	(12, '1007', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-07-16 19:33:27'),
	(13, '1008', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-07-16 19:33:38'),
	(14, '1009', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '650000', '', '2021-07-16 19:33:54'),
	(15, '1010', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:34:24'),
	(16, '1011', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:38:11'),
	(17, '1012', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:38:31'),
	(18, '1013', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:41:18'),
	(19, '1014', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:43:45'),
	(20, '1015', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '110000', '', '2021-07-16 19:44:02'),
	(21, '1016', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 19:56:12'),
	(22, '1017', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '10000', '', '2021-07-16 20:33:17'),
	(23, '1018', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '760000', '', '2021-07-16 21:21:32'),
	(24, '1018', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '760000', '', '2021-07-16 21:21:32'),
	(25, '1019', '118', 'coquito', '1', '50000', '50000', 0, 2381, 0, 2381, '50000', '', '2021-07-16 21:21:33'),
	(26, '1020', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '110000', '110000', 0, 5238, 0, 5238, '760000', '', '2021-07-16 21:25:39'),
	(27, '1020', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '760000', '', '2021-07-16 21:25:39'),
	(28, '1021', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '660000', '', '2021-07-16 21:25:40'),
	(29, '1021', '118', 'coquito', '1', '10000', '10000', 0, 476, 0, 476, '660000', '', '2021-07-16 21:25:40'),
	(30, '1022', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '650000', '', '2021-08-02 07:31:05'),
	(31, '1023', '10', 'Chapa', '1', '650000', '650000', 0, 30952, 0, 30952, '650000', '', '2021-08-02 07:46:51');
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;

-- Dumping structure for table fcentro.detallecompra
CREATE TABLE IF NOT EXISTS `detallecompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `iva` int(10) DEFAULT NULL,
  `iva1` int(10) DEFAULT NULL,
  `iva2` int(10) DEFAULT NULL,
  `totalIva` int(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.detallecompra: ~5 rows (approximately)
DELETE FROM `detallecompra`;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
INSERT INTO `detallecompra` (`id`, `factura`, `codigo`, `nombre`, `cantidad`, `valor`, `importe`, `iva`, `iva1`, `iva2`, `totalIva`, `total`, `tipo`) VALUES
	(1, '1000', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '60000', '60000', 10, 0, 5455, 5455, '60000', 'CONTADO'),
	(2, '1001', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '1', '60000', '60000', 10, 0, 5455, 5455, '60000', 'CONTADO'),
	(3, '1002', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '100', '60000', '6000000', 10, 0, 5455, 5455, '6000000', 'CONTADO'),
	(4, '1003', '0123', 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '2', '60000', '120000', 10, 0, 5455, 5455, '120000', 'CONTADO'),
	(5, '1003', '10', 'dasdasd', '3', '0', '0', 10, 0, 0, 0, '120000', 'CONTADO');
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;

-- Dumping structure for table fcentro.empresa
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

-- Dumping data for table fcentro.empresa: ~0 rows (approximately)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Dumping structure for table fcentro.factura
CREATE TABLE IF NOT EXISTS `factura` (
  `factura` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cajera` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nombrecli` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cedula` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `total` float DEFAULT NULL,
  `iva` int(100) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.factura: ~21 rows (approximately)
DELETE FROM `factura`;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` (`factura`, `cajera`, `nombrecli`, `cedula`, `total`, `iva`, `fecha`, `estado`) VALUES
	('1000', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 110000, NULL, '2021-06-18 00:00:00', 's'),
	('1001', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 110000, NULL, '2021-06-30 00:00:00', 's'),
	('1002', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 110000, NULL, '2021-06-30 00:00:00', 's'),
	('1003', 'admin', 'Sara Miranda', '5613789', 110000, NULL, '2021-06-30 00:00:00', 's'),
	('1004', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 110000, NULL, '2021-06-30 00:00:00', 's'),
	('1005', 'admin', 'Sara Miranda', '5613789', 650000, NULL, '2021-06-30 00:00:00', 's'),
	('1006', 'empleado', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1007', 'empleado', 'Cliente por Defecto', '', 110000, NULL, '2021-07-16 00:00:00', 's'),
	('1008', 'empleado', 'Cliente por Defecto', '', 110000, NULL, '2021-07-16 00:00:00', 's'),
	('1009', 'empleado', 'Cliente por Defecto', '', 650000, NULL, '2021-07-16 00:00:00', 's'),
	('1010', 'admin', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1011', 'empleado', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1012', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1013', 'empleado', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1014', 'empleado', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1015', 'empleado', 'Cliente por Defecto', '', 110000, NULL, '2021-07-16 00:00:00', 's'),
	('1016', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1017', 'admin', 'Cliente por Defecto', '', 10000, NULL, '2021-07-16 00:00:00', 's'),
	('1018', 'empleado', 'Cliente por Defecto', '', 760000, NULL, '2021-07-16 00:00:00', 's'),
	('1019', 'admin', 'Sara Miranda', '5613789', 50000, NULL, '2021-07-16 00:00:00', 's'),
	('1020', 'empleado', 'Juan Esteban Rodriguez Garcia', '5248934', 760000, NULL, '2021-07-16 00:00:00', 's'),
	('1021', 'admin', 'diego valenzuwela', '123456', 660000, NULL, '2021-07-16 00:00:00', 's'),
	('1022', 'admin', 'Juan Esteban Rodriguez Garcia', '5248934', 650000, NULL, '2021-08-02 00:00:00', 's'),
	('1023', 'admin', 'Sara Miranda', '5613789', 650000, NULL, '2021-08-02 00:00:00', 's');
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

-- Dumping structure for table fcentro.facturacompra
CREATE TABLE IF NOT EXISTS `facturacompra` (
  `factura` int(100) NOT NULL,
  `cajera` varchar(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `rucprov` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fcentro.facturacompra: ~3 rows (approximately)
DELETE FROM `facturacompra`;
/*!40000 ALTER TABLE `facturacompra` DISABLE KEYS */;
INSERT INTO `facturacompra` (`factura`, `cajera`, `prov`, `rucprov`, `fecha`, `estado`) VALUES
	(1000, 'admin', 'Proveedor por Defecto', '5789043-2', '2021-01-14', 's'),
	(1001, 'admin', 'Proveedor por Defecto', '5789043-2', '2021-02-11', 's'),
	(1002, 'admin', 'Proveedor por Defecto', '5789043-2', '2021-02-11', 's'),
	(1003, 'admin', 'Proveedor por Defecto', '5789043-2', '2021-02-15', 's');
/*!40000 ALTER TABLE `facturacompra` ENABLE KEYS */;

-- Dumping structure for table fcentro.permisos_tmp
CREATE TABLE IF NOT EXISTS `permisos_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `very` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.permisos_tmp: ~0 rows (approximately)
DELETE FROM `permisos_tmp`;
/*!40000 ALTER TABLE `permisos_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos_tmp` ENABLE KEYS */;

-- Dumping structure for table fcentro.producto
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
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.producto: ~0 rows (approximately)
DELETE FROM `producto`;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`cod`, `prov`, `cprov`, `nom`, `costo`, `mayor`, `venta`, `venta2`, `cantidad`, `minimo`, `seccion`, `fecha`, `estado`, `clase`, `iva`, `foto`) VALUES
	('0123', '0', NULL, 'Llaves Combinadas Black+Decker Pro 7pzs 15-22mm', '60000', NULL, '110000', '', '990', '2', '0', '2021-01-14 15:35:51', 's', NULL, '10', 'articulo/0123.jpg'),
	('10', '0', NULL, 'Chapa', '500000', NULL, '650000', '', '993', '2', '0', '2021-02-08 22:33:32', 's', NULL, '10', ''),
	('118', '0', NULL, 'coquito', '0', NULL, '10000', NULL, '40', '2', '0', '2021-07-15 22:54:22', 's', NULL, '10', ''),
	('63651', '0', NULL, 'fsdf', '50000', NULL, '65000', NULL, '1000', '2', '0', '2021-02-10 16:06:16', 's', NULL, '10', '');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Dumping structure for table fcentro.proveedor
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.proveedor: ~0 rows (approximately)
DELETE FROM `proveedor`;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`id`, `codigo`, `empresa`, `nom`, `dir`, `ciudad`, `tel`, `cel`, `correo`, `obs`, `estado`) VALUES
	(1, '', 'Proveedor por Defecto', '5789043-2', '', '', '', '', '', NULL, 's');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Dumping structure for table fcentro.seccion
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.seccion: ~3 rows (approximately)
DELETE FROM `seccion`;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` (`id`, `nombre`, `estado`) VALUES
	(6, 'TORNILLOS', 's'),
	(7, 'CONECTORES', 's'),
	(8, 'MANGUERAS', 's');
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;

-- Dumping structure for table fcentro.temp
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

-- Dumping data for table fcentro.temp: ~0 rows (approximately)
DELETE FROM `temp`;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;

-- Dumping structure for table fcentro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) DEFAULT 'C',
  `entrada` datetime DEFAULT NULL,
  `salida` datetime DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table fcentro.usuarios: ~2 rows (approximately)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `direccion`, `telefono`, `celular`, `email`, `barrio`, `ciudad`, `username`, `password`, `rol`, `entrada`, `salida`, `foto`, `estado`) VALUES
	(1, '12345678', 'Administrador del Sistema ', 'Direccion del usuario', '', '0986236788', 'fghfghfg', 'Barrio San Blas', 'Coronel Bogado', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'A', '2021-10-19 20:43:00', '2021-10-19 20:45:25', '', '1'),
	(2, '53453453453', 'Nuevo Usuario', '', '', '', NULL, '', '', 'empleado', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'C', '2021-08-27 18:23:19', '2021-07-15 22:07:17', NULL, '1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
