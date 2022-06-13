<?php
if (strlen(session_id()) < 1) {
  session_start();
}
require 'app/php_conexion.php';
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
require 'partials/header.php';
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4 ">
    <h3>Categorias</h3>
    <div class="row">
      <div class="col-md-8">
        <table width="80%" border="0" class="table table-striped" id="tablaSeccion">
          <tr>
            <!-- <td width="8%"><strong>
                <center>ID</center>
              </strong></td> -->
            <td width="54%"><strong>Nombre</strong></td>
            <td width="38%">
              <center><strong>Estado</strong></center>
            </td>
            <td></td>
          </tr>
          <?php
          $can = querySimple("SELECT * FROM seccion");
          while ($dato = mysqli_fetch_array($can)) {
            $nombre = $dato['nombre'];
            $id = $dato['id'];
            if ($dato['estado'] == "n") {
              $estado = '<span class="badge badge-danger"><i class="fa fa-close"></i> Inactivo</span>';
            } else {
              $estado = '<span class="badge badge-success"><i class="fa fa-check"></i> Activo</span>';
            }
          ?>
          <tr>
            <!-- <td><?php echo $id; ?></td> -->
            <td><a class="btn btn-sm btn-secondary" href="seccion.php?codigo=<?php echo $id; ?>" data-toggle="tooltip"
                data-placement="top" title="Editar Seccion"><i class="fa fa-edit"></i></a> <?php echo $nombre; ?></td>
            <td>
              <center><a href="app/php_estado_seccion.php?id=<?php echo $id; ?>"><?php echo $estado; ?></a></center>
            </td>
            <td>
              <button type="button"
                onClick="window.location='app/php_eliminar_seccion.php?id=<?php echo $dato['id']; ?>'"
                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <div class="col-md-4">
        <?php
        if (empty($_GET['codigo'])) {
          $can = querySimple("SELECT MAX(id) as numero FROM seccion");
          if ($dato = mysqli_fetch_array($can)) {
            $s_codigo = $dato['numero'] + 1;
            $s_nombre = "";
            $boton = "Guardar Seccion";
          }
        } else {
          $s_codigo = $_GET['codigo'];
          $can = querySimple("SELECT * FROM seccion WHERE id=$s_codigo");
          if ($dato = mysqli_fetch_array($can)) {
            $s_nombre = $dato['nombre'];
          }
          $boton = "Actualizar Seccion";
        }

        ?>
        <div class="control-group info">
          <form name="form1" method="post" action="">
            <label for="textfield">Codigo:</label>
            <input type="hidden" class="form-control" name="s_codigo" id="s_codigo" value="<?php echo $s_codigo; ?>">
            <label for="textfield2">Nombre</label>
            <input type="text" autocomplete="off" placeholder="Ingrese el nombre de la categoria" class="form-control"
              name="s_nombre" id="s_nombre" value="<?php echo $s_nombre; ?>" required><br><br>
            <button tabindex="submit" class="btn btn-success btn-lg mb-3"><i class="fa fa-plus"></i>
              <?php echo $boton; ?></button>
            <?php if ($boton == 'Actualizar Seccion') { ?> <a href="seccion.php" class="btn btn-danger btn-lg mb-3"><i
                class="fa fa-close"></i> Cancelar</a><?php } ?>
          </form>
        </div>
        <?php
        if (!empty($_POST['s_nombre'])) {
          $ss_codigo = $_POST['s_codigo'];
          $ss_nombre = strtoupper($_POST['s_nombre']);

          $can = querySimple("SELECT * FROM seccion WHERE id=$ss_codigo");
          if ($dato = mysqli_fetch_array($can)) {
            //actualizar seccion
            $xSQL = "UPDATE seccion SET nombre='$ss_nombre' WHERE id=$ss_codigo";
            querySimple($xSQL);
            echo '  <br><div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">X</button>
                              <strong>Seccion!</strong> Actualizado con Exito <a href="seccion.php" class="btn btn-sm btn-primary text-white "><i class="fa fa-refresh"></i> Actualizar</a>
                        </div>';
          } else {
            //guardar seccion
            $sql = "INSERT INTO seccion (nombre, estado) VALUES ('$ss_nombre','s')";
            querySimple($sql);
            echo '  <br><div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                          <strong>Seccion!</strong> Guardado con Exito <a href="seccion.php" class="btn btn-sm btn-primary text-white "><i class="fa fa-refresh"></i> Actualizar</a>
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
  <script>
    $('#tablaSeccion').DataTable()
    alert('hola')
  </script>