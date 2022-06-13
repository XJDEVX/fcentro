<?php
error_reporting(0);
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('app/php_conexion.php');
$usuario = $_SESSION['username'];

// if ($_SESSION['rol'] !== 'Administrador') {
// 	header('location:error.php');
// }
$can = querySimple("SELECT MAX(factura) as maximo FROM factura"); //codigo de la factura
if ($datox = mysqli_fetch_array($can)) {
	$cfactura = $datox['maximo'] + 1;
}
if ($cfactura == 1) {
	$cfactura = 1000;
} //si es primera factura colocar que empieze en 1000
// $hoy=$fechay=date("Y-m-d");
// $fecha = date_format('Y-m-d', strtotime($_GET['fecha']));
$fecha = $_GET['fecha'] != 0 ? $_GET['fecha'] : strftime('%Y-%m-%d');
$tipo = $_GET['tipo'];
if ($_GET['button'] == 'TICKET') { //contado
	$ccpago = $_GET['ccpago'];
	$tpagar = $_GET['tpagar'];
	$nombrecli = $_GET['nombrecli'];
	$cedula = $_GET['cedula'];
	$t_importe = 0;
	if ($tpagar >= $ccpago or $tpagar <= $ccpago) {
		//guarda tabla factura
		$factura_sql = "INSERT INTO factura (factura,cajera,nombrecli,cedula,total,fecha,estado) VALUES ('$cfactura','$usuario','$nombrecli','$cedula','$tpagar','$fecha','s')";
		$queryFact  = querySimple($factura_sql);
		//codigo de la factura / guarda en detalles
		$can1 = querySimple("SELECT * FROM caja_tmp where usu='$usuario'");
		while ($dato = mysqli_fetch_array($can1)) {
			$cod = $dato['cod'];
			$nom = $dato['nom'];
			$cant = $dato['cant'];
			$venta = $dato['venta'];
			$importe = $dato['importe'];
			$t_importe = $t_importe + $importe;
			$iva = (int) $dato['iva'];

			//					$canVenta = querySimple("SELECT SUM(venta) FROM caja_tmp WHERE usu='$usuario'");
			//					while($data = mysqli_fetch_array($canVenta))
			//                    {
			//                        $venta = $data['venta'];
			//                    }
			$iva1 = 0;
			$iva2 = 0;
			if ($iva == '10') {
				$iva2 += $venta / 11;
			} else {
				$iva1 += $venta / 21;
			}
			$totalIva = $iva1 + $iva2;
			//                    $iva = $dato['iva'];
			// $total = querySimple();

			$detalle_sql = "INSERT INTO detalle (factura, codigo, nombre, cantidad, valor, importe,iva,iva1, iva2, totalIva, total, tipo)
						VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe','$iva','$iva1', '$iva2','$totalIva','$tpagar','$tipo')";
			$query2 = querySimple($detalle_sql);
			////ACTUALIZAR LA EXISTENCIA//////////////////

			$ca = querySimple("SELECT * FROM producto where cod='$cod'");
			if ($date = mysqli_fetch_array($ca)) {
				$e_actual = $date['cantidad'];
			}
			$n_cantidad = $e_actual - $cant;
			if ($n_cantidad < 0) {
				$n_cantidad = 0;
			} // si la cantidad da negativo ponerlo en 0
			$sql = "Update producto Set cantidad='$n_cantidad' Where cod='$cod'";
			$query3 = querySimple($sql);
			/////////////////////////////////////////////
		}
		$borrar_sql = "DELETE FROM caja_tmp WHERE usu='$usuario'"; //borrar todo de la caja temporal
		$query4 = querySimple($borrar_sql);

		// $sqLocalizarFact = "SELECT * FROM factura WHERE factura='$cfactura'";
		// $can2 = querySimple($sqLocalizarFact);
		// if($datos=mysqli_fetch_array($can2)){

		// 	$cajerax=$datos['cajera'];
		// 	$nombrecli2=$datos['nombrecli'];
		// 	var_dump('hola');
		// 	die();
		// }
		$can3 = queryRow("SELECT * FROM usuarios where username='$usuario'");
		$cajera = $can3['nombre'];
		// $datosa=mysqli_fetch_array($can3);
		// 	$cajera=$datosa['nombre'];
		$numero = 0;
		$valor = 0;
		$data = [];
		$can4 = querySimple("SELECT * FROM detalle where factura='$cfactura'");
		while ($datazo = mysqli_fetch_array($can4)) {
			$numero = $numero + 1;
			$valor = $valor + $datazo['valor'];
			// var_dump($datazo['cantidad']);
			// var_dump($datazo['nombre']);

			$data[] = [
				'0' => $datazo['cantidad'],
				'1' => $datazo['nombre'],
				'2' => $numero,
				'3' => $datazo['valor'],
				'4' => $datazo['importe']
			];
		}

		$data = serialize($data);
		$data = urlencode($data);
		echo '<script>
			fetch( "http://localhost/pprint/index.php?tpagar=' . $tpagar . '&ccpago=' . $ccpago . '&cajera=' . $cajera . '&nombrecli=' . $nombrecli . '&can=' . $data . '" )
				.then( res => res.json() )
				.then((data) => {
					location.href = "http://donpipo.jrdgsoluciones.com/Administrador.php"
					console.log("hola")
				})
				location.href = "http://donpipo.jrdgsoluciones.com/caja.php?ddes=0"
			</script>';
		// echo '<script>
		// </script>';
		// echo '<script>
		// 	fetch("http://localhost/fcentro/ticket.php?tpagar='.$tpagar.'&ccpago='.$ccpago.'&factura='.$cfactura.'")
		// 		.then( res => res.json() )
		// 		.then( data => {
		// 			console.log("")
		// 		})

		// </script>';
		// header('location:ticket.php?tpagar=' . $tpagar . '&ccpago=' . $ccpago . '&factura=' . $cfactura .'');
	} else {
		header('location:ticket.php?mensaje=error');
	}
} else {
	$ccpago = $_GET['ccpago'];
	$tpagar = $_GET['tpagar'];
	$nombrecli = $_GET['nombrecli'];
	$cedula = $_GET['cedula'];
	$t_importe = 0;

	if ($tpagar >= $ccpago or $tpagar <= $ccpago) {
		//guarda tabla factura
		$factura_sql = "INSERT INTO factura (factura,cajera,nombrecli,cedula,total,fecha,estado) VALUES ('$cfactura','$usuario','$nombrecli','$cedula','$tpagar','$fecha','s')";
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
			$iva = (int) $dato['iva'];

			//					$canVenta = querySimple("SELECT SUM(venta) FROM caja_tmp WHERE usu='$usuario'");
			//					while($data = mysqli_fetch_array($canVenta))
			//                    {
			//                        $venta = $data['venta'];
			//                    }
			$iva1 = 0;
			$iva2 = 0;
			if ($iva == '10') {
				$iva2 += $venta / 11;
			} else {
				$iva1 += $venta / 21;
			}
			$totalIva = $iva1 + $iva2;
			//                    $iva = $dato['iva'];
			$detalle_sql = "INSERT INTO detalle (factura, codigo, nombre, cantidad, valor, importe,iva,iva1, iva2, totalIva, total, tipo)
						VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe','$iva','$iva1', '$iva2','$totalIva','$tpagar','$tipo')";
			querySimple($detalle_sql);
			////ACTUALIZAR LA EXISTENCIA//////////////////
			$ca = querySimple("SELECT * FROM producto where cod='$cod'");
			if ($date = mysqli_fetch_array($ca)) {
				$e_actual = $date['cantidad'];
			}
			$n_cantidad = $e_actual - $cant;
			if ($n_cantidad < 0) {
				$n_cantidad = 0;
			} // si la cantidad da negativo ponerlo en 0
			$sql = "Update producto Set cantidad='$n_cantidad' Where cod='$cod'";
			querySimple($sql);
			/////////////////////////////////////////////
		}
		$borrar_sql = "DELETE FROM caja_tmp WHERE usu='$usuario'"; //borrar todo de la caja temporal
		querySimple($borrar_sql);
		header('location:facturaModelo2.php?tpagar=' . $tpagar . '&ccpago=' . $ccpago . '&factura=' . $cfactura);
	} else {
		header('location:realizadofact.php');
	}
}
$_SESSION['ddes'] = 0;
