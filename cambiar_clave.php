<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
  session_start();
}
require_once('app/php_conexion.php');
if ($_SESSION['rol'] !== 'Administrador' && $_SESSION['rol'] !== 'Empleado' ) {
  header('location:error.php');
} 
$usuario = $_SESSION['username'];
require_once('partials/header.php');
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4">
    <table width="80%" border="0" class="table">
      <tr class="info">
        <td colspan="2">
          <center><strong><i class="fa fa-lock"></i> Cambiar Contraseña</strong></center>
        </td>
      </tr>
      <tr>
        <td width="50%">
          <?= $_SESSION['rol'] ?>
          <form name="form1" method="post" action="">
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
                required><br><br>
            </div>
            <div class="form-group">
              <button type="submit" name="button" id="button" class="btn btn-primary"><i class="fa fa-unlock-alt"></i>
                Cambiar Contraseña</button>
            </div>
          </form>
        </td>
        <td width="50%">
          <br><br><br><br><br><br>
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
                      <strong>Contraseña!</strong> Actualizada con exito
                    </div>';
              } else {
                echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Contraseña!</strong> Digitada no corresponde a la antigua
                    </div>';
              }
            } else {
              echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Las dos Contraseña!</strong> Digitadas no soy iguales
                    </div>';
            }
          }
          ?>
        </td>
      </tr>
    </table>
  </div>
  <?php
  require_once('partials/feet.php');
  require_once('partials/footer.php');
  ?>