<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
  session_start();
}
require 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
$id = '';
$cedula = '';
$nombre = '';
$usuario = '';
$ciudad = '';
$direccion = '';
$telefono = '';
$celular = '';
$tipo = '';
$barrio = '';
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
  $can = querySimple("SELECT * FROM usuarios where id=$id");
  if ($dato = mysqli_fetch_array($can)) {
    $id = $dato['id'];
    $cedula = $dato['cedula'];
    $nombre = $dato['nombre'];
    $usuario = $dato['username'];
    $ciudad = $dato['ciudad'];
    // $cupo = $dato['cupo'];
    $direccion = $dato['direccion'];
    $telefono = $dato['telefono'];
    $celular = $dato['celular'];
    $tipo = $dato['rol'];
    $barrio = $dato['barrio'];
    $boton = "Actualizar Usuario";
  }
} else {
  $boton = "Guardar Usuario";
}
require_once('partials/header.php'); ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4">
    <?php
    if (!empty($_POST['cedula']) and !empty($_POST['nombre'])) {
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $cedula = isset($_POST['cedula']) ? $_POST['cedula']: '';
      $nombre = isset($_POST['nombre'])? $_POST['nombre'] : '';
      $usuario = isset( $_POST['usuario'] )? $_POST['usuario']: '';
      $ciudad = isset( $_POST['ciudad']) ? $_POST['ciudad'] : '';
      $contra = isset($_POST['clave']) ? hash('SHA256', $_POST['clave']): '';
      $direccion = isset( $_POST['direccion'] )? $_POST['direccion'] : '';
      $telefono = isset( $_POST['telefono'] )? $_POST['telefono']: '';
      $celular = isset( $_POST['celular'] )? $_POST['celular']: '';
      $tipo = isset( $_POST['tipo'] )? $_POST['tipo']: '';
      $barrio = isset( $_POST['barrio'] )? $_POST['barrio']: '';
      $can = querySimple("SELECT * FROM usuarios WHERE id=$id");
      if ($dato = mysqli_fetch_array($can)) {
        if ($boton == 'Actualizar Usuario') {
          $xSQL = "UPDATE usuarios 
          SET cedula='$cedula', nombre='$nombre',direccion='$direccion',telefono='$telefono',
          celular='$celular',barrio='$barrio',
          username='$usuario',ciudad='$ciudad', password='$contra', rol='$tipo'
          Where id=$id";
          querySimple($xSQL);
          echo '  <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button>
          <strong>Usuario!</strong> Actualizado con Exito</div>';
        } else {
          echo ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">X</button><strong>Error! </strong>El numero de documento que ingreso le pertenece al usuario ' . $dato['nombre'] . '</div>';
        }
      } else {
        if (preg_match("/\\s/", $usuario)) {
          echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">X</button><strong>Error!</strong> No se permiten espacios en la cuenta de usuario.</div>';
          $usuario = '';
        } else {
          $sql = "INSERT INTO 
          usuarios (cedula, nombre, direccion, telefono, celular, barrio, ciudad, username, password, rol) 
          VALUES ('$cedula','$nombre','$direccion','$telefono','$celular','$barrio','$ciudad','$usuario','$contra','$tipo')";
          querySimple($sql);
          $numero = 0;
          $ca = querySimple("SELECT * FROM permisos_tmp");
          while ($dat = mysqli_fetch_array($ca)) {
            $numero = $numero + 1;
            if ($tipo == 'A' or $tipo == 'C') {
              if ($tipo == 'C') {
                if ($numero == 4 or $numero == 5 or $numero == 6 or $numero == 7 or $numero == 8 or $numero == 14) {
                  $very = 1;
                } else {
                  $very = 0;
                }
              } else {
                $very = 1;
              }
              $sql = "INSERT INTO permisos (usu,per,est) VALUES ('$usuario','$numero','$very')";
              querySimple($sql);
            }
          }
          $id = '';
          $cedula = '';
          $nombre = '';
          $usuario = '';
          $ciudad = '';
          // $cupo = '0';
          $direccion = '';
          $telefono = '';
          $celular = '';
          $tipo = '';
          $barrio = '';
          echo '  <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button>
                                  <strong>Usuario!</strong> Guardado con Exito</div>';
        }
      }
    }
    ?>
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-dark text-light">
            <div class="row">
              <div class="col-md-6">
                <h5>Acciones | Usuarios</h5>
              </div>
              <div class="col-md-6 text-right">
                <a href="usuarios.php" class="btn btn-sm btn-secondary">Listado de Usuarios</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Formulario -->
            <form name="form1" method="post" action="">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <label for="textfield">Cedula: <small class="text-danger font-weight-bold">Campo
                        Requerido</small></label>
                    <input type="number" class="form-control form-control-sm" placeholder="Ingrese el numero de cedula"
                      name="cedula" id="cedula" value="<?php echo $cedula; ?>" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="textfield">Nombre y Apellido: <small class="text-danger font-weight-bold">Campo
                        Requerido</small></label>
                    <input type="text" name="nombre" class="form-control form-control-sm"
                      placeholder="Ingrese Nombre y Apellido" id="nombre" value="<?php echo $nombre; ?>"
                      autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="textfield">Ciudad: </label>
                    <input type="text" class="form-control form-control-sm" placeholder="Ingrese la ciudad"
                      name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="textfield">Nombre de Usuario: <small class="text-danger font-weight-bold">Campo
                        Requerido</small></label>
                    <input type="text" class="form-control form-control-sm" name="usuario" placeholder="Username"
                      id="usuario" value="<?php echo $usuario; ?>" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="textfield">Direccion: </label><input type="text" name="direccion" id="direccion"
                      class="form-control form-control-sm" placeholder="Ingrese la direccion"
                      value="<?php echo $direccion; ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="textfield">Barrio / Localidad: </label><input type="text" name="barrio" id="barrio"
                      class="form-control form-control-sm" placeholder="Ingrese el barrio"
                      value="<?php echo $barrio; ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="textfield">Telefono: </label><input type="number" name="telefono" id="telefono"
                      class="form-control form-control-sm" placeholder="Ingrese el telefono"
                      value="<?php echo $telefono; ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="textfield">Celular / Movil: </label><input type="number" name="celular"
                      placeholder="Ingrese el celular" class="form-control form-control-sm" id="celular"
                      value="<?php echo $celular; ?>" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="clave">Clave <small class="text-danger font-weight-bold">Campo Requerido</small></label>
                    <input type="password" name="clave" id="clave" class="form-control"
                      placeholder="Ingrese su clave de usuario" required>
                  </div>

                  <div class="form-group">
                    <label for="">Rol de Usuario <small class="text-danger font-weight-bold">Campo
                        Requerido</small></label>
                    <?php if ($tipo_usu == 'Administrador') { ?>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" required name="tipo" id="optionsRadios1" value="A"
                        <?php if ($tipo == "A") {
                                                                                                                          echo 'checked';
                                                                                                                        } ?>>
                      <label class="form-check-label" for="exampleRadios1">
                        Administrador/a
                      </label><?php } ?>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipo" id="optionsRadios3" value="C" <?php if ($tipo == "C") {
                                                                                                                  echo 'checked';
                                                                                                                } ?>>
                      <label class="form-check-label" for="exampleRadios2">
                        Cajero/a
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row justify-content-center">
                <button class="btn btn-lg btn-success" type="submit"><i class="fa fa-plus"></i>
                  <?php echo $boton; ?></button>
                <?php if ($boton == 'Guardar Usuario') { ?>
                <a href="usuarios.php" class="btn btn-lg btn-danger ml-2">Volver al listado de Usuarios</a>
                <?php }  ?>
                <?php if ($boton == 'Actualizar Usuario') { ?>
                <a href="usuarios.php" class="btn btn-lg btn-danger ml-2">Volver al listado de Usuarios</a>
                <?php }  ?>
              </div>
            </form>
            <!-- formulario============== -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once('partials/feet.php'); 
  require_once('partials/footer.php'); 
  ?>