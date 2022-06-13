<?php
if (strlen(session_id()) < 1) {
  session_start();
}
require_once 'php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
require_once('../partials/header.php');
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <?php
        // $detalle_sql="UPDATE factura ";
        // querySimple($detalle_sql);
        // ////ACTUALIZAR LA EXISTENCIA//////////////////
        // $ca=querySimple("SELECT * FROM producto where cod='$cod'");
        // if($date=mysql_fetch_array($ca)){
        // 	$e_actual=$date['cantidad'];
        // }
        // $n_cantidad=$e_actual-$cant;
        // if($n_cantidad<0){	$n_cantidad=0;	}// si la cantidad da negativo ponerlo en 0
        // $sql="Update producto Set cantidad='$n_cantidad' Where cod='$cod'";
        // querySimple($sql);
        $factura = $_GET['factura'];
        //   $sqlChangeStatus = "SELECT * FROM detalle WHERE factura='$factura'";
        //   $query = querySimple($sqlChangeStatus);
        //   while($detail = mysql_fetch_assoc($query)) {
        //       var_dump($detail['cantidad']);
        //   }
        $sqlChangeStatus = "UPDATE factura SET estado='Anulado' WHERE factura='$factura'";
        querySimple($sqlChangeStatus);
        $sqlPullDetail = "SELECT * FROM detalle WHERE factura='$factura'";
        $query = querySimple($sqlPullDetail);
        while ($data = mysqli_fetch_object($query)) {
          echo $data->nombre . '' . $data->cantidad . '<br>';
          $sqlTraerProduct = querySimple("SELECT * FROM producto WHERE nom='$data->nombre'");
          while ($data1 = mysqli_fetch_object($sqlTraerProduct)) {
            $reponer = $data1->cantidad + $data->cantidad;
            $sqlSumarStock = querySimple("UPDATE producto SET cantidad = '$reponer' WHERE nom='$data->nombre'");
          }
        }
        header('Location: ../facturas.php');
        ?>
      </div>
    </div>
  </div>
  <?php
  require_once '../partials/feet.php';
  require_once '../partials/footer.php';
  ?>