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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <form name="form1" method="post" action="">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" id="genCode" type="button">
                                                Generar Codigo
                                            </button>
                                        </div>
                                        <input type="text" id="ccodigo" name="ccodigo" list="characters"
                                            placeholder="Ingrese el codigo del Producto a crear o editar"
                                            class="form-control" autofocus>
                                        <datalist id="characters">
                                            <?php
                                            $can = querySimple("SELECT * FROM producto");
                                            while ($dato = mysqli_fetch_array($can)) {
                                                echo '<option value="' . $dato['cod'] . '">' . $dato['nom'] . '</option>';
                                                // echo '<option value="'.$dato['nom'].'">','<option value="'.$dato['cod'].'">';
                                            }
                                            ?>
                                        </datalist>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-barcode"></i>
                                                Confirmar Codigo</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- BLOQUE PHP -->
                        <?php
                        if (!empty($_POST['ccodigo']) or !empty($_GET['codigo'])) {
                            $prov = '';
                            $nom = '';
                            $costo = '0';
                            $cantidad = '0';
                            $minimo = '2';
                            $seccion = '';
                            $codigo = '';
                            $venta = '0';
                            // $fechax = date("d") . '/' . date("m") . '/' . date("Y");
                            // $fechay = date("Y-m-d");
                            if (!empty($_GET['codigo'])) {
                                $codigo = $_GET['codigo'];
                            }
                            if (!empty($_POST['ccodigo'])) {
                                $codigo = $_POST['ccodigo'];
                            }
                            $can = querySimple("SELECT * FROM producto where cod='$codigo'");
                            if ($dato = mysqli_fetch_array($can)) {
                                $prov = $dato['prov'];
                                $nom = $dato['nom'];
                                $costo = $dato['costo'];
                                $venta = $dato['venta'];
                                // $venta2 = $dato['venta2'];
                                $cantidad = $dato['cantidad'];
                                $minimo = $dato['minimo'];
                                $seccion = $dato['seccion'];
                                $foto = $dato['foto'];
                                // $fechay = $dato['fecha'];
                                $boton = "Actualizar Producto";
                                //  echo '  <div class="alert alert-success">
                                //           <button type="button" class="close" data-dismiss="alert">X</button>
                                //           <strong>Producto / Articulo '.$nom.' </strong> con el codigo '.$codigo.' ya existe
                                //     </div>';

                            } else {
                                $boton = "Guardar Producto";
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <form name="form2" method="post" enctype="multipart/form-data" action="">
                                    <div class="form-group">
                                        <div class="codigo">Codigo</div>
                                        <input type="text" name="codigo" value="<?= $codigo ?>" required
                                            class="form-control" autofocus id="codigo" placeholder="Codigo de Barras">
                                    </div>
                                    <div class="form-group">
                                        <div class="nombre">Nombre</div>
                                        <input type="text" name="nom" id="nom" autocomplete="off"
                                            value="<?php echo $nom; ?>" required class="form-control"
                                            placeholder="Nombre del Producto">
                                    </div>
                                    <div class="form-group">
                                        <div class="label">Proveedor</div>
                                        <select class="miselect form-control" name="prov" id="prov">
                                            <option value="0" selected> Proveedor por defecto</option>
                                            <?php
                                                $can = querySimple("SELECT * FROM proveedor WHERE estado='s'");
                                                while ($dato = mysqli_fetch_array($can)) {
                                                ?>
                                            <option value="<?php echo $dato['id']; ?>" <?php if ($prov == $dato['id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $dato['empresa']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" name="fecha" value="<?php echo $fechay; ?>" id="fecha" class="form-control">
                                        </div> -->
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class=" form-control" name="seccion" id="seccion">
                                            <option value="0" selected> Seccion por defecto</option>
                                            <?php
                                                $can = querySimple("SELECT * FROM seccion WHERE estado='s'");
                                                while ($dato = mysqli_fetch_array($can)) {

                                                ?>
                                            <option value="<?php echo $dato['id']; ?>" <?php if ($seccion == $dato['id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $dato['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="costo">Precio de Costo</label>
                                    <input type="number" min="0" value="<?php echo $costo; ?>" name="costo" required
                                        placeholder="Ingrese precio de costo" id="costo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="porcentajee">Porcentaje de Recargo</label>
                                    <div class="input-group">
                                    <input type="number" class="form-control" id="porcentajee" name="porcentajee" value="30" placeholder="%">
                                    <button id="recargo" class="btn btn-dark" style="border-radius: 0% !important">Calcular</button> 
                                    </div>                                                            
                                </div>
                                <div class="form-group">
                                    <label for="venta">Precio de venta</label>
                                    <input type="number" min="0" value="<?php echo $venta; ?>" name="venta" required
                                        placeholder="Ingrese precio de venta" id="venta" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="venta2">Precio de venta 2</label>
                                    <input type="number" min="0" value="<?php echo $venta2; ?>" name="venta2" required
                                        placeholder="Ingrese precio de venta 2" id="venta2" class="form-control">
                                </div> -->
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" min="0" value="<?php echo $cantidad; ?>" name="cantidad"
                                        required placeholder="Ingrese la cantidad" id="cantidad" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="minimo">Cantidad minima</label>
                                    <input type="number" min="0" value="<?php echo $minimo; ?>" name="minimo"
                                        placeholder="Ingrese la cantidad minima" id="minimo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="hidden" name="foto_actual" value="<?= isset($foto)? $foto : null ?>">
                                    <input class="form-control" type="file" name="imagen" id="imagen"></>
                                </div>

                                <?php
                                if(  isset($foto) && $foto !== '' ) {
                                    echo '<img class="img-fluid shadow rounded" src="'.$foto.'" >';
                                } else {
                                    echo '<img class="img-fluid shadow rounded" src="articulo/producto.png" >';
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-database"></i>
                                    <?php echo $boton; ?></button>
                                <a class="btn btn-lg btn-danger" href="producto.php" target="admin">Volver al Listado de
                                    Productos</a>
                            </div>
                            </form>
                            <?php } ?>
                        </div>
                        <?php
                        
                            if (!empty($_POST['nom'])) {
                                $gnom = $_POST['nom'];
                                $gprov = $_POST['prov'];
                                $gcosto = $_POST['costo'];
                                $gventa = $_POST['venta'];
                                // $gventa2 = $_POST['venta2'];
                                $gcantidad = $_POST['cantidad'];
                                $gminimo = $_POST['minimo'];
                                $gseccion = $_POST['seccion'];
                                $gcodigo = $_POST['codigo'];
                                $imgTmp = $_FILES['imagen']['tmp_name'];
                                $imgName = $_FILES['imagen']['name'];
                                $imgType = $_FILES['imagen']['type'];
                                    if( file_exists( $imgTmp ) || is_uploaded_file( $imgTmp ) )
                                    {
                                        list($ancho, $alto) = getimagesize($imgTmp);
                                        $nuevoAncho = 160;
                                        $nuevoAlto = 160;
                                        // $rand = mt_rand(100, 999);
                                        if ($imgType == 'image/jpg' || $imgType == 'image/jpeg'){
                                            $gfoto = 'articulo/'.$gcodigo.'.jpg';
                                            $foto = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                            $origen = imagecreatefromjpeg($imgTmp);
                                            imagecopyresized($foto, $origen, '0', '0', '0', '0', $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                            imagejpeg($foto, $gfoto);			
                                        } elseif ($imgType == 'image/png') {
                                            $gfoto = 'articulo/'.$gcodigo.'.png';
                                            $foto = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                            $origen = imagecreatefrompng($imgTmp);
                                            imagecopyresized($foto, $origen, '0', '0', '0', '0', $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                            imagepng($foto, $gfoto);
                                        }
                                    } else {
                                        $gfoto = $_POST['foto_actual'];
                                    }
                                // $gfoto = $foto;
                                $can = querySimple("SELECT * FROM producto WHERE cod='$gcodigo'");
                                if ($dato = mysqli_fetch_array($can)) {
                                    $sql = "UPDATE producto SET prov='$gprov',
                                            nom='$gnom',
                                            costo='$gcosto',
                                            venta='$gventa',
                                            venta2='$gventa2',
                                            cantidad='$gcantidad',
                                            minimo='$gminimo',
                                            seccion='$gseccion',
                                            foto='$gfoto' 
                                            WHERE cod='$gcodigo'";
                                    querySimple($sql);

                                    echo "
                                    <script>
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: 'Los Datos han sido actualizados',
                                        showConfirmButton: false,
                                        timer: 2000
                                      })
                                      setTimeout( ()=> { location.href='producto.php' }, 2200)
                                    </script>
                                    ";
                                    $prov = '';
                                    $nom = '';
                                    $costo = '0';
                                    $cantidad = '0';
                                    $minimo = '2';
                                    $seccion = '';
                                    $fecha = '';
                                    $codigo = '';
                                    $venta = '0';
                                    $foto = '';
                                } else {
                                    $sql = "INSERT INTO producto (cod, prov, nom, costo, venta, cantidad, minimo, seccion, estado, foto) 
                             VALUES ('$gcodigo','$gprov','$gnom','$gcosto','$gventa','$gcantidad','$gminimo','$gseccion','s', '$gfoto')";
                                    querySimple($sql);
                                    echo "
                                    <script>
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: 'Los Datos han sido registrados',
                                        showConfirmButton: false,
                                        timer: 2000
                                      })
                                      setTimeout( ()=> { location.href='producto.php' }, 2200)
                                    </script>
                                    ";
                                }
                                //subir la imagen del articulo
                                // $nameimagen = $_FILES['imagen']['name'];
                                // $tmpimagen = $_FILES['imagen']['tmp_name'];
                                // $extimagen = pathinfo($nameimagen);
                                // $ext = array("png", "jpg");
                                // $urlnueva = "articulo/" . $gcodigo . ".png";
                                // if (is_uploaded_file($tmpimagen)) {
                                //     if (array_search($extimagen['extension'], $ext)) {
                                //         copy($tmpimagen, $urlnueva);
                                //     }
                                // }

                                
                            
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    require_once 'partials/feet.php';
    require 'partials/footer.php';
    ?>
    <script>
        $(function () {
            $('#ccodigo').focus()

        const costo = document.getElementById('costo').value
        const porcentajee = document.getElementById('porcentajee').value
        const venta = document.getElementById('venta').value
        })
        $('#ccodigo').on('change', function () {
            document.form1.submit()
        })
        $('#genCode').on('click', function(){
            const random = parseInt( Math.floor( Math.random() * 100000 ) )
            $('#ccodigo').val( random )
            $('#ccodigo').focus()
        })

        $('#recargo').on('click', function(e){
            e.preventDefault()
            let convertPercent = parseInt(porcentajee.value) + 100
            let calculo = (parseInt(costo.value) * convertPercent / 100)
            venta.value = calculo
        })

        // const calValores = () => {
        //     let calculo = costo + porcentajee
        //     console.log(calculo);
        // }
        // calcValores()

        porcentajee.addEventListener('change', calValores)


    </script>