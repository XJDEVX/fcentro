<?php
error_reporting( E_ERROR );
if (strlen(session_id()) < 1) {
    session_start();
}
require_once 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($tipo_usu !== 'Administrador' && $tipo_usu !== 'Empleado' ) {
    header('location:error.php');
}
$id = '';
$nombrecli = '';
$cedula = '';
$celular = '';
$direc = '';
$estado = '';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $can = querySimple("SELECT * FROM clientes where id=$id");
    if ($dato = mysqli_fetch_array($can)) {
        $id = $dato['id'];
        $cedula = $dato['cedula'];
        $nombrecli = $dato['nombrecli'];
        $celular = $dato['celular'];
        $direc = $dato['direc'];
        $boton = "Actualizar Cliente";
    }
} else {
    $boton = "Guardar Cliente";
}
require 'partials/header.php'; ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid my-4">
        <?php
        if (!empty($_POST['nombrecli'])) {
            $id = isset( $_POST['id'] )? $_POST['id']: '';
            $cedula = isset( $_POST['cedula'] )? $_POST['cedula']: '';
            $nombrecli = isset( $_POST['nombrecli'] )? $_POST['nombrecli']: '';
            $celular = isset( $_POST['celular'] )? $_POST['celular']: '';
            $direc = isset( $_POST['direc'] )? $_POST['direc']: '';

            // $variables = [
            //     'id' => $id,
            //     'nombre' => $nombrecli,
            //     'cedula' => $cedula,
            //     'celular' => $celular,
            //     'direc' => $direc
            // ];
            // var_dump( $variables );
            // die();


            $can = querySimple("SELECT * FROM clientes WHERE id=$id");
            if ($dato = mysqli_fetch_array($can)) {
                if ($boton == 'Actualizar Cliente') {
                    $xSQL = "UPDATE clientes 
                    SET nombrecli='$nombrecli',cedula='$cedula',direc='$direc',celular='$celular' 
                    WHERE id=$id";
                    querySimple($xSQL);
                    echo '  <div class="alert alert-success my-2"><button type="button" class="close" data-dismiss="alert">x</button>
                                  <strong>Cliente!</strong> Actualizado con Exito</div>';
                } else {
                    echo ' <div class="alert alert-danger my-2"><button type="button" class="close" data-dismiss="alert">x</button><strong>Error! </strong>El numero de documento que ingreso le pertenece al cliente ' . $dato['nombrecli'] . '</div>';
                }
            } else {
                $sql = "INSERT INTO clientes (nombrecli, cedula, celular, direc) 
                             VALUES ('$nombrecli','$cedula','$celular','$direc')";
                querySimple($sql);
                
                echo '  <div class="alert alert-success my-2"><button type="button" class="close" data-dismiss="alert">x</button>
                                  <strong>Cliente!</strong> Guardado con Exito</div>';
                $id = '';
                $nombrecli = '';
                $cedula = '';
                $celular = '';
                $direc = '';
            }
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-4">
                    <!-- <div class="card-header bg-dark text-white">
                        <h5><i class="fa fa-user-plus"></i> Agregar Nuevo Cliente</h5>
                    </div> -->
                    <div class="card-body">
                        <form name="form1" method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <label for="textfield">Nombre y apellido: <small class="text-danger">Texto
                                                Requerido</small></label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Ingrese el nombre y apellido" name="nombrecli" id="nombrecli"
                                            value="<?= empty($nombrecli) ? '' : $nombrecli ?>" autocomplete="off"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="textfield">Cedula: <small class="text-danger">Texto
                                                Requerido</small></label>
                                        <input type="text" name="cedula" class="form-control form-control-sm"
                                            placeholder="Ingrese cedula " id="cedula" value="<?= $cedula; ?>"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="textfield">Direccion: </label><input type="text" name="direc"
                                            id="direc" class="form-control form-control-sm"
                                            placeholder="Ingrese la direccion" value="<?php echo $direc; ?>"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="textfield">celular: </label><input type="text"
                                            class="form-control form-control-sm" placeholder="Ingrese celular"
                                            name="celular" id="celular" value="<?php echo $celular; ?>"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-lg btn-success mb-4" type="submit"><i class="fa fa-plus"></i>
                                        <?php echo $boton; ?></button>
                                    <?php if ($boton == 'Guardar Cliente') { ?> <a href="clientes.php"
                                        class="btn btn-lg btn-danger ml-2 mb-4">Ver el listado de Clientes</a><?php }  ?>
                                    <?php if ($boton == 'Actualizar Cliente') { ?> <a href="clientes.php"
                                        class="btn btn-lg btn-danger ml-2 mb-4">Ver el listado de Clientes</a><?php }  ?>
                                </div>
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