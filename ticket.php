<?php

if (strlen(session_id()) < 1) {
	session_start();
}
require_once('app/php_conexion.php');
$usuario = $_SESSION['username'];

if ($_SESSION['rol'] !== 'Administrador') {
	header('location:error.php');
}
		//contado.php?tpagar='.$tpagar.'&ccpago='.$ccpago)
		if(!empty($_GET['tpagar']) and !empty($_GET['ccpago']) and !empty($_GET['factura'])){
			$tpagar=$_GET['tpagar'];
			$ccpago=$_GET['ccpago'];
			$factura=$_GET['factura'];
			$cambio=$ccpago-$tpagar;
		}
		
		if(!empty($_GET['mensaje'])){
			$error='si';
		}else{
			$error='no';
		}

		// Seccion de datos factura y caja

			$can=querySimple("SELECT * FROM factura where factura='$factura'");	
			    if($datos=mysqli_fetch_array($can)){	
					$cajera=$datos['cajera'];
					$nombrecli=$datos['nombrecli'];
					$can=querySimple("SELECT * FROM usuarios where username='$cajera'");	
					if($datos=mysqli_fetch_array($can)){	
						// var_dump( $datos );
						$cajera=$datos['nombre'];
				}}

require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


$nombre_impresora = "epson"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);


/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);

/*
	Intentaremos cargar e imprimir
	el logo
*/
// try{
// 	$logo = EscposImage::load("logo.png", false);
//     $printer->bitImage($logo);
// }catch(Exception $e){/*No hacemos nada si hay error*/}



	//Ahora vamos a imprimir un encabezado

$printer->text("AUTOSERVICIO SANTA Rita" . "\n");
$printer->text("Ruta nro 1 c/Av Coronel Bogado" . "\n");
$printer->text("Comprobante" . "\n");
$printer->text("WhatsApp:(0985)-764-239" . "\n");
$printer->text("---------------------------------------" . "\n");
#La fecha también
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Fecha y Hora:             Cajero/a:\n");
$printer->text(date("Y-m-d H:i:s")."       ". $cajera . "\n");
$printer->text(date("Y-m-d H:i:s")."       ". $nombrecli . "\n");



// $printer->text("Fecha:       " . date("Y-m-d H:i:s") . "\n");



/*
	Ahora vamos a imprimir los
	productos
*/

# Para mostrar el total	
$numero=0;$valor=0;
	  	$can=querySimple("SELECT * FROM detalle where factura='$factura'");	
	  	
	  	$printer->text("---------------------------------------\n");
	  	$printer->text("| Cant | Descripción     |      Precio |\n");
	  	$printer->text("---------------------------------------\n");
    	while($dato=mysqli_fetch_array($can)){
			$numero=$numero+1;
			$valor=$valor+$dato['valor'];
			$tipo=$dato['tipo'];

	/*Alinear a la izquierda para la cantidad y el nombre*/
	$printer->setJustification(Printer::JUSTIFY_LEFT);
		
		
		
    	$printer->text( $dato['cantidad'] . "- " .  $dato['nombre'] .  "\n");
    

    	

    /*Y a la derecha para el importe*/
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text("x".' Gs ' .  number_format($dato['valor'],0,",",".") . "\n");
    $printer->text("Subtotal:".' Gs ' .  number_format($dato['importe'],0,",",".") . "\n");
}

/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("========================================\n");

$printer->setJustification(Printer::JUSTIFY_RIGHT);
	$printer->text("Numero de Productos: ". $numero . "\n");
	$printer->text("TOTAL Gs: ".  number_format($tpagar,0,",",".") ."\n");
	$printer->text("Efectivo Gs: ".  number_format($ccpago,0,",",".") ."\n");
	$printer->text("Vuelto Gs: ".  number_format($cambio,0,",",".") ."\n");


/*
	Podemos poner también un pie de página
*/
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("========================================\n"); 
$printer->text("Muchas Gracias por su compra !!!");
/*Alimentamos el papel 3 veces*/
$printer->feed(4);

/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();

/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();

/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();

header('location:caja.php?ddes=0');
?>