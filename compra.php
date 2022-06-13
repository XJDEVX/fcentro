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

  <!-- Le styles -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/docs.css" rel="stylesheet">
  <link href="js/google-code-prettify/prettify.css" rel="stylesheet">

  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap-transition.js"></script>
  <script src="js/bootstrap-alert.js"></script>
  <script src="js/bootstrap-modal.js"></script>
  <script src="js/bootstrap-dropdown.js"></script>
  <script src="js/bootstrap-scrollspy.js"></script>
  <script src="js/bootstrap-tab.js"></script>
  <script src="js/bootstrap-tooltip.js"></script>
  <script src="js/bootstrap-popover.js"></script>
  <script src="js/bootstrap-button.js"></script>
  <script src="js/bootstrap-collapse.js"></script>
  <script src="js/bootstrap-carousel.js"></script>
  <script src="js/bootstrap-typeahead.js"></script>
  <script src="js/bootstrap-affix.js"></script>
  <script src="js/holder/holder.js"></script>
  <script src="js/google-code-prettify/prettify.js"></script>
  <script src="js/application.js"></script>
  <!-- Le fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/ico/favicon.png">
</head>
<?php
if ($error == 'si') {
?>
  <div class="alert alert-error" align="center">
    <strong>El dinero recibido es menor al valor a pagar</strong> <br>
    <strong><a href="compra_product.php">Regresar a la compra</a></strong>
  </div>
<?php }
if ($error == 'num') {
  echo '<div class="alert alert-error" align="center">
                      <strong>Solo debe de ingresar numeros en este campo</strong> <br>
                      <strong><a href="compra_product.php?ddes=' . $_SESSION['ddes'] . '">Regresar a la compra</a></strong>
                    </div>';
}
?>
<?php
if ($error == 'no') {

  echo '<div class="alert alert-success" align="center">
                      <strong>La compra se realizo con exito</strong> <br>
                       <strong><a href="compra_product.php">Regresar</a></strong>
                    </div>';
} ?>


</center>
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