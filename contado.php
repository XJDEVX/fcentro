<?php
if (strlen(session_id()) < 1) {
  session_start();
}
require_once('app/php_conexion.php');
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
if (!empty($_GET['tpagar']) and !empty($_GET['ccpago']) and !empty($_GET['factura'])) {
  $tpagar = $_GET['tpagar'];
  $ccpago = $_GET['ccpago'];
  $factura = $_GET['factura'];
  $cambio = $ccpago - $tpagar;
}
if (!empty($_GET['mensaje'])) {
  $error = 'si';
} else {
  $error = 'no';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Contado</title>
  <style type="text/css" media="print">
    #Imprime {
      height: auto;
      width: 310px;
      margin: 0px;
      padding: 0px;
      float: left;
      font-family: Arial, Helvetica, sans-serif;
      color: #000;
    }

    @page {
      margin: 0;
    }
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/docs.css" rel="stylesheet">
  <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
  <script language="javascript">
    function imprSelec(nombre) {
      ////////
      var ficha = document.getElementById(nombre);
      var ventimp = window.open(' ', 'popimpr');
      ventimp.document.write(ficha.innerHTML);
      ventimp.document.close();
      ventimp.print();
      ventimp.close();

    }
  </script>
  <script src="plugins/sweetalert/sweetalert2@9.js"></script>
</head>
<?php include "partials/footer.php" ?>
<script>
  Swal.fire({
    position: 'top',
    icon: 'success',
    title: 'COMPRA REALIZADA CON EXITO!!',
    showConfirmButton: false,
    timer: 2500
  })
  // alert("Compra realizada con exito");
  setTimeout(function() {
    window.location.href = "caja_compra.php";
  }, 1500);
</script>

</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
<center>
  <br>
</center>
</body>

</html>