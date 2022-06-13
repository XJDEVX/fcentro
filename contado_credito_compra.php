<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require_once('app/php_conexion.php');
$usuario = $_SESSION['username'];
if (!$_SESSION['rol'] == 'Administrador' && !$_SESSION['rol'] == 'Empleado' ) {
    header('location:error.php');
}
$can = querySimple("SELECT MAX(factura) as maximo FROM facturacompra"); //codigo de la factura
if ($dato = mysqli_fetch_array($can)) {
    $cfactura = $dato['maximo'] + 1;
}
if ($cfactura == 1) {
    $cfactura = 1000;
} //si es primera factura colocar que empieze en 1000
$hoy = $fechay = date("Y-m-d");
if ($_GET['button'] == 'guardar compra') { //contado
    $ccpago = $_GET['ccpago'];
    $tpagar = $_GET['tpagar'];
    $nombrecli = $_GET['nombrecli'];
    // var_dump($nombrecli);
    // die();
    $cedula = $_GET['nom'];
    $t_importe = 0;
    if ($tpagar >= $ccpago or $tpagar <= $ccpago) {
        $ccpago = $_GET['ccpago'];
        $tpagar = $_GET['tpagar'];
        $nombrecli = $_GET['nombrecli'];
        $cedula = $_GET['nom'];
        $t_importe = 0;
        if ($tpagar >= $ccpago or $tpagar <= $ccpago) {
            //guarda tabla factura
            $factura_sql = "INSERT INTO facturacompra (factura,cajera,prov,rucprov,fecha,estado) VALUES ('$cfactura','$usuario','$nombrecli','$cedula','$hoy','s')";
            querySimple($factura_sql);
            //codigo de la factura / guarda en detalles
            $can = querySimple("SELECT * FROM temp where usu='$usuario'");
            while ($dato = mysqli_fetch_array($can)) {
                $cod = $dato['cod'];
                $nom = $dato['nom'];
                $cant = $dato['cant'];
                $venta = $dato['costo'];
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
                if ($iva == 10) {
                    $iva2 += $venta / 11;
                } else {

                    $iva1 += $venta / 21;
                }
                $totalIva = $iva1 + $iva2;
                //                    $iva = $dato['iva'];
                $detalle_sql = "INSERT INTO detallecompra (factura, codigo, nombre, cantidad, valor, importe,iva,iva1, iva2, totalIva, total, tipo)
							VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe','$iva','$iva1', '$iva2','$totalIva','$tpagar','CONTADO')";
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
            $borrar_sql = "DELETE FROM temp WHERE usu='$usuario'"; //borrar todo de la caja temporal
            querySimple($borrar_sql);
            header('location:contado.php?tpagar=' . $tpagar . '&ccpago=' . $ccpago . '&factura=' . $cfactura);
        } else {
            // header('location:ticket.php?mensaje=error');
            // echo `<script>
            // Swal.fire({
            //     position: 'top',
            //     icon: 'success',
            //     title: 'Compra Realizada con exito',
            //     showConfirmButton: false,
            //     timer: 1500
            //   })
            // setTimeout(function(){
            //     window.location.href='caja_compra.php'
            // },1600)
            // </script>`;
        }
    }
}
$_SESSION['ddes'] = 0;