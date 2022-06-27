<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
  session_start();
}
require_once('app/php_conexion.php');
require_once 'helper/sessionCheck.php';
$usuario = $_SESSION['username'];
require_once('partials/header.php');
?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4 px-4">
    <h2>Cambia tu clave o contraseña</h2>
    <div class="row">
      <div class="col-md-6">
         <form name="form1" method="post" class="my-4" >
            <div class="form-group">
              <label>Contraseña Antigua: </label>
              <input type="password" placeholder="Ingrese su Contraseña Actual" name="contra" class="form-control"
                id="contra">
            </div>
            <div class="form-group">
              <label>Nueva Contraseña: </label>
              <input type="password" placeholder="Ingrese su nueva Contraseña" name="c1" class="form-control" id="c1"
                required>
            </div>
            <div class="form-group">
              <label>Repita Nueva Contraseña: </label>
              <input type="password" placeholder="Repita su nueva Contraseña" name="c2" class="form-control" id="c2"
                required>
            </div>
            <div class="form-group">
              <button type="submit" name="button" id="button" class="btn btn-primary btn-block"><i class="fa fa-unlock-alt"></i>
                Cambiar Contraseña</button>
            </div>
          </form>
          <?php
          if (!empty($_POST['c1']) and !empty($_POST['c2']) and !empty($_POST['contra'])) {
            if ($_POST['c1'] == $_POST['c2']) {
              $contra = hash('SHA256', $_POST['contra']);
              $can = querySimple("SELECT * FROM usuarios WHERE username='" . $usuario . "'
              and password='" . $contra . "'");
              if ($dato = mysqli_fetch_array($can)) {
                $cnueva = hash('SHA256', $_POST['c2']);
                $sql = "UPDATE usuarios Set password='$cnueva' Where username='$usuario'";
                querySimple($sql);
                echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>La Contraseña!</strong> ha sido actualizada con exito
                    </div>';
              } else {
                echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>La Contraseña!</strong> Digitada no corresponde a la antigua
                    </div>';
              }
            } else {
              echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Las Contraseñas!</strong> Digitadas no soy iguales
                    </div>';
            }
          }
          ?>
      </div>
    </div>
  </div>
  <?php
  require_once('partials/feet.php');
  require_once('partials/footer.php');
  ?>