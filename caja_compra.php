<?php
error_reporting(E_ERROR);
session_start();
require_once('app/php_conexion.php');
if ($_SESSION['rol'] !== 'Administrador' && $_SESSION['rol'] !== 'Empleado' ) {
    header('location:error.php');
}
$usuario = $_SESSION['username'];
$aleatorio = mt_rand(20000, 40000);
$cans = querySimple("SELECT * FROM usuarios where usu='$usuario'");
// if ($datos = mysqli_fetch_array($cans)) {
//     $nombre_usu = $datos['nom'];
// }
if (!empty($_POST['tmp_cantidad']) and !empty($_POST['tmp_nombre']) and !empty($_POST['tmp_valor'])) {
    $tmp_cantidad = $_POST['tmp_cantidad'];
    $tmp_codigo = $_POST['tmp_codigo'];
    $tmp_nombre = $_POST['tmp_nombre'];
    $tmp_valor = $_POST['tmp_valor'];
    $tmp_iva = $_POST['tmp_iva'];
    $fechay = date("d-m-Y");
    $tmp_importe = $tmp_cantidad * $tmp_valor;
    $sql = "INSERT INTO temp
 (cod, nom, costo, cant, importe, existencia,iva, usu) 
 VALUES  ('$tmp_codigo','$tmp_nombre','$tmp_valor','$tmp_importe','$tmp_cantidad','$tmp_iva','$usuario')";
    querySimple($sql);
}
require_once "partials/header.php"
?>
</head>
<style>
    .modal .modal-dialog {
        margin-top: 15px !important;
    }
</style>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid my-4">
        <div class="row justify-content-center mt-5 mt-lg-0">
            <div class="col-md-6">
                <h4>Nueva Compra</h4>
                <form name="form1" method="post" action="">
                    <input type="text" class=" myinput form-control form-control-lg" id="codigo" name="codigo"
                        list="characters" placeholder="Filtre por codigo de barra o Nombre del producto"
                        autocomplete="on" />
                    <input type="submit" value="" style="display:none">
                    <datalist id="characters">
                        <?php
                        $can = querySimple("SELECT * FROM producto");
                        while ($dato = mysqli_fetch_array($can)) {
                            echo '<option value="' . $dato['nom'] . '">';
                        }
                        ?>
                    </datalist>
                </form>
                <?php
                if (isset($_POST['codigo'])) {
                    $balanza = $_POST['codigo'];
                    $partes = preg_split('//', $balanza, -1, PREG_SPLIT_NO_EMPTY);
                    $todo1 = $partes[0] . $partes[1];
                    $cod = $partes[4] . $partes[5] . $partes[6];
                    $cant = $partes[7] . $partes[8] . $partes[9] . $partes[10] . $partes[11];
                    $partes[12] = 1;
                    if ($todo1 == "20" or $todo1 == "25") {
                        $cod = $cod;
                        $cant = $cant * 0.001;
                    } else {
                        $cod = $balanza;
                        $cant = $partes[12];
                    }
                    if ($_POST['codigo'] == 0) {
                        $cant = $partes[12];
                    }
                    //unidad
                    if ($cod == "083" or $cod == "224" or $cod == "085" or $cod == "126" or $cod == "218" or $cod == "123" or $cod == "128" or $cod == "220" or $cod == "221" or $cod == "222" or $cod == "125" or $cod == "122" or $cod == "124" or $cod == "127" or $cod == "219" or $cod == "121" or $cod == "117" or $cod == "098" or $cod == "099" or $cod == "129" or $cod == "226" or $cod == "236" or $cod == "237" or $cod == "238" or $cod == "086" or  $cod == "061" or $cod == "084" or $cod == "261" or $cod == "152" or $cod == "267" or $cod == "82" or $cod == "274"  or $cod == "188" or $cod == "191" or $cod == "194" or $cod == "195" or $cod == "196" or $cod == "199" or $cod == "305" or $cod == "306" or $cod == "307" or $cod == "002" or $cod == "309" or $cod == "329" or $cod == "335") {
                        $cod == $cod;
                        $cant = $partes[10] . $partes[11];
                    }
                }
                if (!empty($_POST['codigo'])) {

                    $codigo = $_POST['codigo'];

                    $can = querySimple("SELECT * FROM temp
 where cod='$codigo' or cod='$cod' or nom='$codigo'");
                    if ($dato = mysqli_fetch_array($can)) {
                        $acant = $dato['cant'] + $cant;
                        $dcodigo = $dato['cod'];
                        $aventa = $dato['costo'] * $acant;
                        $sql = "Update temp
 Set importe='$aventa', cant='$acant' Where cod='$dcodigo'";
                        querySimple($sql);
                    } else {
                        $cans = querySimple("SELECT * FROM producto where cod='$cod' or cod='$codigo' or nom='$codigo'");
                        if ($datos = mysqli_fetch_array($cans)) {
                            if ($_SESSION['tventa'] == "venta") {
                                $importe = $datos['costo'] * $cant;
                                $venta = $datos['costo'];
                            } else {
                                $importe = $datos['importe'] * $datos['cant'];
                                $venta = $datos['costo'];
                                $iva = $datos['iva'];
                            }
                            $cod = $datos['cod'];
                            $nom = $datos['nom'];
                            $cant = $cant;
                            $exitencia = $datos['cantidad'];
                            $iva = $datos['iva'];
                            $usu = $_SESSION['username'];
                            //                        if($datos['iva'] == 10)
                            //                        {
                            //                            $dataIva= $datos['venta']/11;
                            //                        } else {
                            //                            $dataIva= $datos['venta']/21;
                            //                        }
                            $sql = "INSERT INTO temp (cod, nom, costo, cant, importe, existencia,iva, usu)  VALUES ('$cod','$nom','$venta','$cant','$importe','$exitencia','$iva','$usu') ";
                            querySimple($sql);
                        } else {
                            echo '<br><div class="alert alert-danger" align="center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Producto no encontrado en la base de datos<br>
                            <a href="crear_producto.php" target="admin" role="button" class="btn btn-success">
                            Crear Nuevo Producto 
                            </a></strong>
                            </div>';
                        }
                    }
                }  ?>
            </div>
            <div class="col-md-6">
                <div class="text-center font-weight-bold">
                    <pre
                        style="font-size:40px;letter-spacing: 2px;background-color: #ddd;color:red;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>Total:</strong> <?php $can = querySimple("SELECT SUM(importe) as neto FROM temp
 where usu='$usuario'");
                                                                                                                                                                                            if ($dato = mysqli_fetch_array($can)) {

                                                                                                                                                                                                $NETO = $dato['neto'] - ($dato['neto'] * $_SESSION['ddes'] / 100);
                                                                                                                                                                                                $_SESSION['neto'] = $NETO;
                                                                                                                                                                                                echo  '₲ ' . number_format($_SESSION['neto'], 0, ",", ".");
                                                                                                                                                                                            } ?></pre>
                    <div align="center">

                    </div>
                </div>
            </div>

            <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="background-color: #ddd">
                    <strong><i class="fa fa-user-circle"></i> Cajero/a: <?php echo $nombre_usu; ?></strong>
                </div>
            </div>
        </div> -->
        </div>
        <!-- fin de row 1 -->
        <br>
        <!--    <div class="col-12">-->
        <!--        <div class="row justify-content-end">-->
        <!--            --><?php //  if(!empty($_SESSION['tventa'])){if($_SESSION['tventa']=='venta'){$vboton="btn btn-primary";
                            //            }else{$vboton="btn";}if($_SESSION['tventa']=='mayoreo'){$mboton="btn btn-primary";
                            //            }else{$mboton="btn";}}else{$_SESSION['venta'];  $vboton="btn btn-primary";}
                            ?>
        <!--            <strong>Transaccion:-->
        <!--                <button type="button" class="btn btn-primary--><?php //echo $vboton; 
                                                                            ?>
        <!--" onClick="window.location='php_caja.php?tventa=venta'"><i class="fa fa-bars"></i> P. Publico</button>-->
        <!--                <button type="button" class="btn btn-primary--><?php //echo $mboton; 
                                                                            ?>
        <!--" onClick="window.location='php_caja.php?tventa=mayoreo'"><i class="fa fa-bars"></i> P. Costo</button></strong>-->
        <!--        </div>-->
        <!--    </div>-->
        <br>
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- tabla -->
                <style>
                    .table-wrapper-scroll-y {
                        display: block;
                        max-height: 400px;
                        overflow-y: auto;
                        -ms-overflow-style: -ms-autohinding-scrollbar;

                    }

                    .ver {
                        position: fixed;
                        margin-top: 190px;
                    }

                    .ver1 {
                        margin-top: 250px;
                        position: fixed;
                    }

                    .ver2 {
                        position: fixed;
                    }
                </style>
                <?php
                $can = querySimple("SELECT * FROM temp
  where  usu='$usuario'");
                if ($dato = mysqli_fetch_array($can)) ?>
                <div class=" table-wrapper-scroll-y">
                    <table width="100%" class="table table-sm table-bordered table-striped table-responsive">
                        <thead>
                            <tr class="bg-dark text-white">
                                <td width="13%"><strong>Codigo</strong></td>
                                <td width="27%"><strong>Producto</strong></td>
                                <td width="15%"><strong>Valor Unitario</strong></td>
                                <td width="13%"><strong>
                                        <center>Cantidad</center>
                                    </strong></td>
                                <td width="12%"><strong>Importe</strong></td>
                                <td width="9%"><strong>
                                        <center>Existencia</center>
                                    </strong></td>
                                <td>
                                    <button type="button" class="btn btn-danger" onClick="limpiarCompra()"><i
                                            class="fa fa-trash"></i> Limpiar Compra</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $na = 0;
                            $can = querySimple("SELECT * FROM temp
  where usu='$usuario' ORDER BY id desc");
                            while ($dato = mysqli_fetch_array($can)) {
                                $na = $na + $dato['cant'];
                            ?>
                            <tr>
                                <td><?php echo $dato['cod']; ?></td>
                                <td><?php echo $dato['nom']; ?></td>
                                <td>
                                    <!-- <center>
                    <button class="btn btn-block" onclick="window.location='caja.php?id=<?php echo $dato['cod'] . '&ddes=' . $_SESSION['ddes']; ?>'">₲
                    <?php echo number_format($dato['costo'], 0, ",", "."); ?></a></button>
                  </center> -->
                                    <form name="formPrecio" id="formPrecio" class="form-inline" method="GET"
                                        action="app/caja_act_compra.php">
                                        <input type="hidden" name="xcodigo" id="xcodigo" autofocus
                                            value="<?php echo $dato['cod']; ?>">
                                        <input type="number" autocomplete="off" min="0" class="form-control"
                                            name="venta" id="venta" value="<?php echo $dato['costo']; ?>" onkeyenter="">
                                        <input type="submit" style="display: none">
                                    </form>
                                    <!--  <button class="btn btn-block btnDesc" onclick="window.location=''">
                                 </button> -->
                                    <!-- <form  name="form2" class="form-inline" method="get" action="php_caja_act.php">
                    <style>
                    .mi-input::-webkit-input-placeholder{color:black;

                    }
                    </style>
                    <script>
                    </script>
                      <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['id'] ?>">
                    <strong> Nuevo Precio :</strong> <input class=" myinputu"  min="0" autofocus class="mi-input" style="background-color:#0069d9;color:white;" type="number" placeholder="ingrese el nuevo precio" class="form-control form-control-sm"   name="venta" id="venta"  autocomplete="off" >
                      <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-money"></i> Confirmar</button>
                    </form> -->
                                </td>
                                <td>
                                    <center>
                                        <form name="formCantidad" class="form-inline" method="get"
                                            action="app/php_caja_compra_cant.php">
                                            <input type="hidden" name="xcodigo" id="xcodigo" autofocus
                                                value="<?php echo $dato['cod']; ?>">
                                            <input type="number" autocomplete="off" class="form-control" name="cantidad"
                                                id="cantidad" value="<?php echo  $dato['cant']; ?>" onkeyenter="">
                                            <input type="submit" style="display: none">
                                        </form>
                                        <!--  <button class="btn btn-block btnDesc" onclick="window.location=''">
                                 </button> -->
                                    </center>

                                </td>
                                <td bgcolor="#D9EDF7">
                                    <div align="right">
                                        ₲<?php echo number_format($dato['importe'] = $dato['cant'] * $dato['costo'], 0, ",", "."); ?>
                                    </div>
                                </td>
                                <td>
                                    <center><?php
                                                if (($dato['existencia'] - $dato['cant']) > 0) {
                                                    echo $dato['existencia'];
                                                } else {
                                                    echo 0;
                                                }
                                                ?></center>
                                </td>
                                <td>
                                    <button type="button" title="Eliminar" class="btn btn-inverse-danger float-right"
                                        onClick="window.location='app/php_eliminar_caja_compra.php?id=<?php echo $dato['cod']; ?>'"><i
                                            class="fa fa-trash"></i> Quitar</button>
                                </td>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php $can = querySimple("SELECT * FROM temp
 where usu='$usuario'");
                if ($dato = mysqli_fetch_array($can)) //cierra el div
                ?>
                <?php if (!empty($_GET['id'])) { ?>
                <!-- <form  name="form2" class="form-inline" method="get" action="php_caja_act.php">
<style>
.mi-input::-webkit-input-placeholder{color:black;

}



</style>
<script>



</script>

  <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['id'] ?>">
 <strong> Nuevo Precio :</strong> <input class=" myinputu"  min="0" autofocus class="mi-input" style="background-color:#0069d9;color:white;" type="number" placeholder="ingrese el nuevo precio" class="form-control form-control-sm"   name="venta" id="venta"  autocomplete="off" >
  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-money"></i> Confirmar</button>


</form> -->
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">
                        <pre
                            style="font-size:24px;background-color: #ddd"><center><?php echo $na; ?> Articulos en Compra</center></pre>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if ($_GET['ddes'] >= 0) {
                            $_SESSION['ddes'] = $_GET['ddes'];
                        }
                        ?>
                        <!-- <form name="form3" class="form-inline" method="get" action="caja.php">
                        <label class=" fa fa-level-down" style="font-size:24px; color:red">Descuento % <br></label>


                        <div class="input-prepend input-append">
                            <input type="number" class="form-control form-control-sm" min="0" max="99" name="ddes" id="ddes" value="<?php echo $_SESSION['ddes']; ?>">
                        </div>
                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa fa-tag "></i> Aplicar</button>
                    </form> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <!-- <div class="text-center font-weight-bold">
                            <pre style="font-size:60px;letter-spacing: 5px;background-color: #ddd;color:red;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><strong>Total:</strong> <?php $can = querySimple("SELECT SUM(importe) as neto FROM temp
 where usu='$usuario'");
                                                                                                                                                                                                    if ($dato = mysqli_fetch_array($can)) {

                                                                                                                                                                                                        $NETO = $dato['neto'] - ($dato['neto'] * $_SESSION['ddes'] / 100);
                                                                                                                                                                                                        $_SESSION['neto'] = $NETO;
                                                                                                                                                                                                        echo  '₲ ' . number_format($_SESSION['neto'], 0, ",", ".");
                                                                                                                                                                                                    } ?></pre>


                            <div align="center">

                            </div>
                        </div> -->
                    </div>
                </div>
                <br>
                <!-- <table width="100%" border="0"> -->
                <!-- <tr>
    <td width="35%"><pre style="font-size:24px;background-color: #ddd"><center><?php echo $na; ?> Articulos en venta</center></pre></td>
    <td width="3%">&nbsp;</td>
    <td width="26%">
    -->
                <!-- <?php
                        if ($_GET['ddes'] >= 0) {
                            $_SESSION['ddes'] = $_GET['ddes'];
                        }
                        ?> -->
                <!-- <form name="form3" class="form-inline" method="get" action="caja.php">
    <label class=" fa fa-level-down" style="font-size:24px; color:red">Descuento % <br></label>


      <div class="input-prepend input-append">



        <input type="number" class="form-control form-control-sm" min="0" max="99" name="ddes" id="ddes" value="<?php echo $_SESSION['ddes']; ?>">
      </div>
       <button type="submit" class="btn btn-sm btn-dark"><i class="fa fa-tag "></i> Aplicar</button>
    </form> -->
                <!-- </td>
    <td width="5%" class="col-md-6">
      <div style="margin-top:-25px;" align="right">
        <pre style="font-size:60px;letter-spacing: 5px;background-color: #ddd;color:red;font-family:Rockwell Extra Bold" ><strong>Total:</strong> <?php $can = querySimple("SELECT SUM(importe) as neto FROM temp
 where usu='$usuario'");
                                                                                                                                                    if ($dato = mysqli_fetch_array($can)) {

                                                                                                                                                        $NETO = $dato['neto'] - ($dato['neto'] * $_SESSION['ddes'] / 100);
                                                                                                                                                        $_SESSION['neto'] = $NETO;
                                                                                                                                                        echo  '₲ ' . number_format($_SESSION['neto'], 0, ",", ".");
                                                                                                                                                    } ?></pre>


        <div align="center">

        </div>
      </div>
    </td>
  </tr> -->
                <tr>
                    <td colspan="4">
                        <?php if ($NETO <> 0) { ?>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <a href="#myContado" class="btn btn-block btn-success btn-lg" id="bt"
                                    data-toggle="modal"><i class="fa fa-truck"></i>
                                    DATOS DEL PROVEEDOR
                                </a>
                                <!-- este es el codigo que realiza la funcion print con el teclado-->
                                <script type="text/javascript">
                                    document.onkeydown = function (e) {
                                        if (window.event) {
                                            tecla = e.keyCode;
                                        } else if (e.which) {
                                            tecla = e.which;
                                        }
                                        if (tecla == 16) {
                                            document.getElementById('bt').click();
                                        }
                                    }
                                </script>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <?php } ?>
            </div>
        </div>
        <!-- row =================================== -->
    </div>
    <!-- Content Fluid =-=================================== -->
    </div>
    </div>
    </tr>
    </table>
    <style type="text/css">
        .my {
            margin-left: 250px;
        }
    </style>
    <div class="modal fade bd-example-modal-lg" id="myContado" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <!-- <div class="modal fade" id="myContado" tabindex="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Cobrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form1" name="contado" method="get" action="contado_credito_compra.php">
                        <div class="row">

                            <div class="col-md-12">
                                <label>NOMBRE del Proveedor </label>
                                <select id="nombrecli" class="form-control" required="" name="nombrecli">
                                    <option selected>Despliegue para seleccionar al proveedor</option>
                                    <?php
                                    $can = querySimple("SELECT * FROM proveedor where estado='s'");
                                    while ($dato = mysqli_fetch_array($can)) {
                                    ?>
                                    <option value="<?php echo $dato['empresa']; ?>" <?php if ($nombrecli == $dato['empresa']) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                        <?php echo $dato['empresa']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="cedula">Cedula/RUC</label>
                                <input type="text" readonly name="nom" id="cedula" class="form-control">
                                <label for="direccion">Direccion</label>
                                <input type="text" readonly name="dir" id="direccion" class="form-control">
                            </div>
                        </div>
                        <center>
                        </center>
                        <center>
                            <div class="input-group mb-3">
                                <!-- <div class="input-group-prepend">
                                <span class="input-group-text"><STRONG><H4>₲</H4></STRONG></span>
                            </div> -->
                                <input type="hidden" style="font-size: 35px;" name="tpagar" readonly=""
                                    onkeyup="vuelto()" value="<?php echo $_SESSION['neto']; ?>" class="form-control"
                                    id="tpagar" autocomplete="off" required autofocus />
                                <!-- <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div> -->
                                <div class="input-group mb-3">
                                    <!-- <div class="input-group-prepend">
                                    <span class="input-group-text"><STRONG><H4>₲</H4></STRONG></span>
                                </div> -->
                                    <input type="hidden" style="font-size: 35px;" name="ccpago" onkeyup="vuelto()"
                                        class="form-control" value="<?php echo $_SESSION['neto']; ?>" id="ccpago"
                                        autocomplete="off" required autofocus />
                                    <!-- <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div> -->
                                    <div class="input-group mt-2">
                                        <!-- <div class="input-group-prepend">
                                        <span class="input-group-text"><strong><H4>VUELTO-></H4></strong></strong></span>
                                    </div> -->
                                        <input type="hidden" readonly="" style="font-size: 35px;color:blue"
                                            name="resultado" class="form-control" autocomplete="off" required value=""
                                            autofocus />
                                        <!-- <div class="input-group-append">
                                        <span class="input-group-text"><h2>₲</h2></span></span>
                                    </div> -->
                                    </div>
                                    <input type="submit" class="btn btn-info btn-block text-uppercase" name="button"
                                        id="button" value="guardar compra" />
                    </form>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>
                        Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "partials/feet.php";
    require_once 'partials/footer.php';
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#codigo').focus()
            //             $('#codigo').flexdatalist({ minLength: 3,

            // noResultsText: '<div class="alert alert-danger" align="center"><button type="button" class="close" data-dismiss="alert">×</button><strong>Producto no encontrado en la base de datos</strong>',
            //  toggleSelected: true, 
            //  searchContain: true,
            //  toggleSelected: true,


            //  selectionRequired: false,


            // });
        })

        function vuelto() {
            caja = document.forms["contado"].elements;
            var ccpago = Number(caja["ccpago"].value);
            var tpagar = Number(caja["tpagar"].value);
            resultado = ccpago - tpagar;
            if (!isNaN(resultado)) {
                caja["resultado"].value = ccpago - tpagar;
            }
        }

        var cliente = $('#nombrecli');

        cliente.on('change', function (e) {
            e.preventDefault()
            var clienteVal = $(this).val();
            $.ajax({
                url: 'helper/prov.php',
                type: 'POST',
                data: {
                    empresa: clienteVal
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#cedula').val(data.nom)
                    $('#direccion').val(data.dir)
                },
                error: function (msj) {
                    console.log(msj)
                }
            })

        })

        function limpiarCompra() {
            Swal.fire({
                position: 'top',
                title: 'DESEA BORRAR LOS DATOS DE ESTA COMPRA?',
                text: "Se formateara la caja de la transaccion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No!',
            }).then((result) => {
                if (result.value) {
                    window.location = `app/php_limpiar_compra.php`
                    $('#codigo').focus()
                }
            })
        }
    </script>