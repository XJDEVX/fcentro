<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('app/php_conexion.php');
$usuario = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:error.php');
}
$can = querySimple("SELECT MAX(factura) as maximo FROM factura"); //codigo de la factura	
if ($dato = mysqli_fetch_array($can)) {
	$cfactura = $dato['maximo'] + 1;
}
if ($cfactura == 1) {
	$cfactura = 1000;
}
$hoy = $fechay = date("Y-m-d");
if ($_GET['button'] == 'Pagar Compra') { //contado
	$ccpago = $_GET['ccpago'];
	$tpagar = $_GET['tpagar'];
	$t_importe = 0;
	if ($tpagar <= $ccpago) {
		//guarda tabla factura
		$factura_sql = "INSERT INTO factura (factura, cajera, fecha, estado) VALUES ('$cfactura','$usuario','$hoy','s')";
		querySimple($factura_sql);
		//codigo de la factura / guarda en detalles
		$can = querySimple("SELECT * FROM caja_tmp where usu='$usuario'");
		while ($dato = mysqli_fetch_array($can)) {
			$cod = $dato['cod'];
			$nom = $dato['nom'];
			$cant = $dato['cant'];
			$venta = $dato['venta'];
			$importe = $dato['importe'];
			$t_importe = $t_importe + $importe;

			$detalle_sql = "INSERT INTO detalle (factura, codigo, nombre, cantidad, valor, importe, tipo)
							VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe','CONTADO')";
			querySimple($detalle_sql);
			////ACTUALIZAR LA EXISTENCIA//////////////////
			$ca = querySimple("SELECT * FROM producto where cod='$cod'");
			if ($date = mysqli_fetch_array($ca)) {
				$e_actual = $date['cantidad'];
			}
			$n_cantidad = $e_actual + $cant;
			if ($n_cantidad < 0) {
				$n_cantidad = 0;
			} // si la cantidad da negativo ponerlo en 0
			$sql = "Update producto Set cantidad='$n_cantidad' Where cod='$cod'";
			querySimple($sql);
			/////////////////////////////////////////////
		}

		$borrar_sql = "DELETE FROM caja_tmp WHERE usu='$usuario'"; //borrar todo de la caja temporal
		querySimple($borrar_sql);

		header('location:compra.php?tpagar=' . $tpagar . '&ccpago=' . $ccpago . '&factura=' . $cfactura);
	} else {
		header('location:compra.php?mensaje=error');
	}
}
$_SESSION['ddes'] = 0;
