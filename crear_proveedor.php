<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('app/php_conexion.php');
$usu = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:error.php');
}
$id = '';
$codigo = '';
$contacto = '';
$empresa = '';
$ciudad = '';
$correo = '';
$direccion = '';
$telefono = '';
$celular = '';
// $obs = '';
if (!empty($_GET['id'])) {
	$id = $_GET['id'];
	$can = querySimple("SELECT * FROM proveedor WHERE id=$id");
	if ($dato = mysqli_fetch_array($can)) {
		$id = $dato['id'];
		$codigo = $dato['codigo'];
		$empresa = $dato['empresa'];
		$contacto = $dato['nom'];
		$direccion = $dato['dir'];
		$ciudad = $dato['ciudad'];
		$telefono = $dato['tel'];
		$celular = $dato['cel'];
		$correo = $dato['correo'];
		// $obs = $dato['obs'];
		$boton = "Actualizar Proveedor";
	}
} else {
	$boton = "Guardar Proveedor";
}
require_once('partials/header.php'); ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
	<div class="container-fluid mt-4">
		<?php
		if (!empty($_POST['empresa']) and !empty($_POST['contacto'])) {
			$id = isset($_POST['id']) ? $_POST['id'] : '';
			$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
			$contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
			$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
			$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
			$celular = isset($_POST['celular']) ? $_POST['celular'] : '';
			// $obs = isset($_POST['obs']) ? $_POST['obs'] : '';
			$can = querySimple("SELECT * FROM proveedor WHERE id=$id");
			if ($dato = mysqli_fetch_array($can)) {
				if ($boton == 'Actualizar Proveedor') {
					$xSQL = "UPDATE proveedor SET empresa='$empresa',codigo='$codigo',nom='$contacto',dir='$direccion',ciudad='$ciudad',
							tel='$telefono',cel='$celular',correo='$correo'
							WHERE id=$id";
					querySimple($xSQL);
					echo '	<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">X</button>
							<strong>Proveedor! </strong> Actualizado con Exito
							</div>';
				}
			} else {
				$sql = "INSERT INTO proveedor (codigo, empresa, nom, dir, ciudad, tel, cel, correo, estado) 
					VALUES ('$codigo','$empresa','$contacto','$direccion','$ciudad','$telefono','$celular','$correo','s')";
				querySimple($sql);
				echo '	<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">X</button>
						<strong>Proveedor! </strong> Guardado con Exito
						</div>';
				$id = '';
				$codigo = '';
				$contacto = '';
				$empresa = '';
				$ciudad = '';
				$correo = '';
				$direccion = '';
				$telefono = '';
				$celular = '';
				// $obs = '';
			}
		}
		?>
		<div class="card mb-4">
			<div class="card-body">
				<form name="form1" method="post" action="">
					<div class="row ">
						<div class="col-md-6">
							<div class="form-group">
								<input type="hidden" name="id" value="<?= $id ?>">
								<label for="codigo">Codigo</label>
								<input type="text" name="codigo" id="codigo" class="form-control w-100"
									value="<?= $codigo ?>" placeholder="Codigo del proveedor">
							</div>
							<div class="form-group">
								<label for="empresa">Empresa o Nombre del Proveedor <small
										class="text-danger font-weight-bold">Campo
										Requerido</small></label>
								<input type="text" name="empresa" required id="empresa" value="<?= $empresa ?>"
									class="form-control"
									placeholder="Ingrese la empresa proveedora o el nombre del representante">
							</div>
							<div class="form-group">
								<label for="contacto">Cedula o Ruc <small class="text-danger font-weight-bold">Campo
										Requerido</small></label>
								<input type="text" name="contacto" id="contacto" required value="<?= $contacto ?>"
									class="form-control" placeholder="Ingrese el nro de documento(CI/RUC)">
							</div>
							<!-- <div class="form-group">
								<label for="obs">Observacion</label>
								<textarea name="obs" id="obs" cols="30" rows="4" class="form-control" value="<?= $obs ?>" placeholder="Ingrese alguna observacion si la hubiera"></textarea>
							</div> -->
							<div class="form-group">
								<label for="correo">Email</label>
								<input type="email" value="<?= $correo ?>" name="correo" id="correo"
									class="form-control w-100" placeholder="Email del proveedor">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="ciudad">Ciudad</label>
								<input type="text" name="ciudad" id="ciudad" class="form-control w-100"
									value="<?= $ciudad ?>" placeholder="Ingrese la ciudad">
							</div>
							<div class="form-group">
								<label for="telefono">Telefono</label>
								<input type="text" name="telefono" id="telefono" class="form-control w-100"
									value="<?= $telefono ?>" placeholder="Telefono del proveedor">
							</div>
							<div class="form-group">
								<label for="celular">Celular</label>
								<input type="text" name="celular" id="celular" class="form-control w-100"
									value="<?= $celular ?>" placeholder="celular del proveedor">
							</div>

							<div class="form-group">
								<label for="direccion">Direccion</label>
								<textarea name="direccion" id="direccion" cols="30" class="form-control" rows="4"
									placeholder="Ingrese la direccion"><?= $direccion ?></textarea>
							</div>
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-md-6">
							<button class="btn btn-lg btn-success mb-4" type="submit"><i class="fa fa-plus"></i>
								<?php echo $boton; ?></button>
							<a href="proveedor.php" class="btn btn-lg mb-4 btn-danger">Ver Listado de Proveedores</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	require_once('partials/feet.php');
	require_once('partials/footer.php');
	?>