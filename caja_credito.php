<?php
error_reporting('E_NOTICE');
if (strlen(session_id()) < 1) {
    session_start();
}
require 'app/php_conexion.php';
// require_once 'helper/sessionCheck.php';
$usuario = $_SESSION['username'];
$aleatorio = mt_rand(20000, 40000);
$cans = mysqli_query($con, "SELECT * FROM usuarios WHERE username='$usuario'");
if ($datos = mysqli_fetch_array($cans)) {
    $nombre_usu = $datos['nombre'];
}
if (!empty($_POST['tmp_cantidad']) and !empty($_POST['tmp_nombre']) and !empty($_POST['tmp_valor'])) {
    $tmp_cantidad = $_POST['tmp_cantidad'];
    $tmp_codigo = $_POST['tmp_codigo'];
    $tmp_nombre = $_POST['tmp_nombre'];
    $tmp_valor = $_POST['tmp_valor'];
    $tmp_iva = $_POST['tmp_iva'];
    $fechay = date("d-m-Y");
    $tmp_importe = $tmp_cantidad * $tmp_valor;
    $sql = "INSERT INTO caja_tmp (cod, nom, venta, cant, importe, exitencia,iva ,usu) VALUES  ('$tmp_codigo','$tmp_nombre','$tmp_valor','$tmp_cantidad','$tmp_importe','$tmp_cantidad','$tmp_iva','$usuario')";
    mysqli_query($con, $sql);
}
require_once "partials/header.php";
?>
<style>
    .modal .modal-dialog {
        margin-top: 15px !important;
    }

    .select2-container {
        display: block !important;
    }

    li.item:hover {
        background: red !important;
    }
</style>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" id="body1">
    <div class="container-fluid pt-4 p-3">
        <div class="row mt-5 mt-lg-0 alig-items-center">
            <div class="col-md-7">
                <h4>Nueva Venta a Credito</h4>
                <form name="form" id="form1" class="d-flex" method="post" action="">
                    <input type="text" id="codigo" name="codigo" placeholder="Ingrese el codigo o el nombre del producto" class="form-control">
                    <button type="submit" class="btn btn-primary rounded-0">
                        <i class="fas fa-search"></i>
                    </button>
                    <!-- <datalist id="characters">
                        <?php
                        $can = mysqli_query($con, "SELECT * FROM producto");
                        while ($dato = mysqli_fetch_array($can)) {
                            echo '
                            <option id="' . $dato['cod'] . '" value="' . $dato['nom'] . '">
                                <span class="list-span"> ' . $dato['nom'] . '</span>
                                </option>
                                ';
                        }
                        ?>
                    </datalist> -->
                    <div class="alert alert-info alerta" style="display:none">
                        <span>A ALCANZADO EL MAXIMO DE FILAS PERMITIDO POR FACTURA</span>
                    </div>
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
                    } elseif (($todo1 == "21" or $todo1 == "25")) {
                        $cod == $cod;
                        $cant = $partes[10] . $partes[11];
                    } else {
                        $cod = $balanza;
                        $cant = $partes[12];
                    }
                    if ($_POST['codigo'] == 0) {
                        $cant = $partes[12];
                    }

                    // //unidad
                    //                 if($cod=="083" OR $cod=="224" OR $cod=="085" OR $cod=="126" OR $cod=="218" OR $cod=="123" OR $cod=="128" OR $cod=="220" OR $cod=="221" OR $cod=="222" OR $cod=="125" OR $cod=="122" OR $cod=="124" OR $cod=="127" OR $cod=="219" OR $cod=="121" OR $cod=="117" OR $cod=="098" OR $cod=="099" OR $cod=="129" OR $cod=="226" OR $cod=="236" OR $cod=="237" OR $cod=="238" OR $cod=="086" OR  $cod=="061" OR $cod=="084" OR $cod=="261" OR $cod=="152" OR $cod=="267" OR $cod=="82" OR $cod=="274"  OR $cod=="188" OR $cod=="191" OR $cod=="194" OR $cod=="195" OR $cod=="196" OR $cod=="199" OR $cod=="305" OR $cod=="306" OR $cod=="307" OR $cod=="002" OR $cod=="309" OR $cod=="329" OR $cod=="335" ){


                    //                     $cod==$cod;
                    //                     $cant=$partes[10].$partes[11];

                    //                 }
                }
                if (!empty($_POST['codigo'])) {
                    $codigo = $_POST['codigo'];
                    $can = mysqli_query($con, "SELECT * FROM caja_tmp where cod='$codigo' or cod='$cod' or nom='$codigo'");
                    if ($dato = mysqli_fetch_array($can)) {
                        $acant = $dato['cant'] + $cant;
                        $dcodigo = $dato['cod'];
                        $aventa = $dato['venta'] * $acant;
                        $sql = "UPDATE caja_tmp SET importe='$aventa', cant='$acant' WHERE cod='$dcodigo'";
                        mysqli_query($con, $sql);
                    } else {
                        $cans = mysqli_query($con, "SELECT * FROM producto WHERE cod='$cod' OR cod='$codigo' OR nom='$codigo' AND estado='s' ");
                        if ($datos = mysqli_fetch_array($cans)) {
                            if ($_SESSION['tventa'] == "venta") {
                                $importe = $datos['venta'] * $cant;
                                $venta = $datos['venta'];
                            } else {
                                $importe = $datos['importe'] * $datos['cant'];
                                $venta = $datos['venta'];
                                // $iva = $datos['iva'];
                            }
                            $cod = $datos['cod'];
                            $nom = $datos['nom'];
                            $cant = $cant;
                            $exitencia = $datos['cantidad'];
                            $usu = $_SESSION['username'];
                            $sql = "INSERT INTO caja_tmp (cod, nom, venta, cant, importe, exitencia, usu)
                         VALUES ('$cod','$nom','$venta','$cant','$importe','$exitencia','$usu') ";
                            mysqli_query($con, $sql);
                        } else {
                            echo '<br><div class="alert alert-danger" align="center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>El producto no cuenta con stock o no existe.<br>
                    <a href="crear_producto.php" target="admin" role="button" class="btn btn-success">Crear Nuevo Producto </a>
                    </strong></div>';
                        }
                    }
                }  ?>
            </div>
            <div class="col-md-5 ">
                <div class="text-center font-weight-bold">
                    <pre style="font-size:40px;letter-spacing: 2px;background-color: #ddd;color:red;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><strong>Total:</strong> <?php $can = mysqli_query($con, "SELECT SUM(importe) as neto FROM caja_tmp where usu='$usuario'");
                                                                                                                                                                                            if ($dato = mysqli_fetch_array($can)) {

                                                                                                                                                                                                $NETO = $dato['neto'] - ($dato['neto'] * $_SESSION['ddes'] / 100);
                                                                                                                                                                                                $_SESSION['neto'] = $NETO;
                                                                                                                                                                                                echo  '₲ ' . number_format($_SESSION['neto'], 0, ",", ".");
                                                                                                                                                                                            } ?></pre>


                    <div align="center">

                    </div>
                </div>
            </div>
        </div>
        <!-- fin de row 1 -->
        <br>
        <div class="row">
        </div>

        <div class="col-12">
            <div class="row justify-content-end">
                <?php if (!empty($_SESSION['tventa'])) {
                    if ($_SESSION['tventa'] == 'venta') {
                        $vboton = "btn btn-primary";
                    } else {
                        $vboton = "btn";
                    }
                    if ($_SESSION['tventa'] == 'mayoreo') {
                        $mboton = "btn btn-primary";
                    } else {
                        $mboton = "btn";
                    }
                } else {
                    $_SESSION['venta'];
                    $vboton = "btn btn-primary";
                } ?>
                <!-- <strong>Transaccion:
                <button type="button" class="btn btn-primary<?php echo $vboton; ?>" onClick="window.location='php_caja.php?tventa=venta'"><i class="fa fa-bars"></i> P. Publico</button>
                <button type="button" class="btn btn-primary<?php echo $mboton; ?>" onClick="window.location='php_caja.php?tventa=mayoreo'"><i class="fa fa-bars"></i> P. Costo</button>
            </strong> -->
            </div>
        </div>

        <br>
        <div class="row">

            <div class="col-md-12">
                <!-- tabla -->

                <style>
                    .table-wrapper-scroll-y {

                        display: block;
                        max-height: 400px;
                        overflow-y: auto;
                        -ms-overflow-style: -ms-autohinding-scrollbar;

                    }

                    .absolute-kp:hover {
                        background: red !important;
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

                    #cantidad {
                        max-width: 80px;
                    }

                    datalist #pepito:hover {
                        background: red !important;
                    }
                </style>
                <?php
                $can = mysqli_query($con, "SELECT * FROM caja_tmp  where  usu='$usuario'");
                if ($dato = mysqli_fetch_array($can)) ?>

                <div class=" table-wrapper-scroll-y">


                    <table width="100%" class="table table-sm table-bordered table-striped table-responsive">

                        <thead>

                            <tr class="text-white" style="background: #1e272e">
                                <td width="20%"><strong>Codigo</strong></td>
                                <td width="60%"><strong>Producto</strong></td>
                                <td width="12%"><strong>Valor Unitario</strong></td>
                                <td width="13%"><strong>Cantidad</strong></td>
                                <td width="20%"><strong>Importe</strong></td>
                                <td width="9%"><strong>Existencia</strong></td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="eliminarVenta()"><i class="fa fa-trash"></i> Limpiar venta</button>
                                </td>
                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $na = 0;
                            $can = mysqli_query($con, "SELECT * FROM caja_tmp  where usu='$usuario' ORDER BY id desc");
                            $numero = 0;
                            while ($dato = mysqli_fetch_array($can)) {
                                // $na=$na+$dato['cant'];
                                $numero++;
                            ?>
                                <tr id="<?= $dato['cod']; ?>" data-id="<?= $dato['cod']; ?>">
                                    <td><?= $dato['cod']; ?></td>
                                    <td><?= $dato['nom']; ?></td>
                                    <td>
                                        <form name="formPrecio" id="formPrecio" class="form-inline" method="GET" action="app/modificar_precio_venta_credito.php">
                                            <input type="hidden" name="xcodigo" id="xcodigo" autofocus value="<?php echo $dato['cod']; ?>">
                                            <input type="number" min="0" autocomplete="o-ff" class="form-control" name="venta" id="venta" value="<?php echo $dato['venta']; ?>" onkeyenter="">
                                            <input type="submit" style="display: none">
                                        </form>
                                    </td>
                                    <td>
                                        <form name="formCantidad" class="form-inline" method="GET" action="app/modificar_cantidad_venta_credito.php">
                                            <input type="hidden" name="xcodigo" id="xcodigo" autofocus value="<?php echo $dato['cod']; ?>">
                                            <input type="number" autocomplete="off" min="1" class="form-control" name="cantidad" id="cantidad" value="<?php echo  $dato['cant']; ?>" onkeyenter="">
                                            <input type="submit" style="display: none">
                                        </form>
                                        <!--  <button class="btn btn-block btnDesc" onclick="window.location=''">
                                 </button> -->
                                    </td>
                                    <td bgcolor="#D9EDF7">
                                        <div align="right">
                                            ₲<?php echo number_format($dato['importe'] = $dato['cant'] * $dato['venta'], 0, ",", "."); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <center>
                                            <?php
                                            if ($dato['exitencia']) {
                                                echo $dato['exitencia'];
                                            } else {
                                                echo '<button class=" btn btn- sm alert alert-danger" align="center">baja existencia</button>';
                                            }
                                            if (($dato['exitencia'] - $dato['cant']) <= 0) {
                                                echo '
                               <script>
                               alert("Producto sin stock en inventario")
                               </script>';
                                            }
                                            ?>
                                        </center>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" title="Eliminar" class="btn btn-inverse-danger" onclick="window.location='app/php_eliminar_caja_credito.php?id=<?php echo $dato['cod']; ?>'"><i class="fa fa-trash"></i> Eliminar</button>
                                    </td>
                                <?php
                                if ($numero >= 22) {
                                    // echo '<script>alert("se sobrepaso")</script>';
                                    echo '<style>
                            .myinput {
                                display: none !important;
                            }
                            .abrirModal {
                                display: none !important;
                            }
                            .alerta {
                                display: block !important;
                        </style>';
                                    // echo '<script>
                                    //     $("#codigo").prop("readonly", true)
                                    // </script>';
                                    break;
                                }
                            }
                                ?>
                        </tbody>
                    </table>

                </div>

                <?php $can = mysqli_query($con, "SELECT * FROM caja_tmp where usu='$usuario'");
                if ($dato = mysqli_fetch_array($can)) //cierra el div
                ?>
                <?php if (!empty($_GET['id'])) { ?>


                    <!-- <form  name="form2" class="form-inline" method="get" action="php_caja_act.php">
<style>
.mi-input::-webkit-input-placeholder{color:black;

}
</
</style>
<script>
</script>
  <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['id'] ?>">
 <strong> Nuevo Precio :</strong> <input class=" myinputu"  min="0" autofocus class="mi-input" style="background-color:#0069d9;color:white;" type="number" placeholder="ingrese el nuevo precio" class="form-control form-control-sm"   name="venta" id="venta"  autocomplete="off" >
  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-money"></i> Confirmar</button>
</form> -->
                <?php } ?>
            </div>
            <!-- FOTO PREVIEW -->
            <!-- <div class="col-md-3">
                <img src="https://carlitos.test/assets/images/lightbox/default.png" class="img-fluid shadow"
                    id="preview" alt="">

            </div> -->
            <div class="col-md-12">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <pre style="font-size:24px;background-color: #ddd"><center><?php echo $numero; ?> Articulos en venta</center></pre>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if (isset($_GET['ddes'])) {
                            if ($_GET['ddes'] >= 0) {
                                $_SESSION['ddes'] = $_GET['ddes'];
                            }
                        }

                        ?>
                        <form name="form3" class="form-inline" method="get" action="caja.php">
                            <label class=" fa fa-level-down" style="font-size:24px; color:red">Descuento % <br></label>
                            <div class="input-prepend input-append">
                                <input type="number" class="form-control form-control-sm rounded-0" min="0" max="99" name="ddes" id="ddes" value="<?php echo $_SESSION['ddes']; ?>">
                            </div>
                            <button type="submit" class="btn btn-sm btn-dark rounded-0"><i class="fa fa-tag "></i>
                                Aplicar</button>
                        </form>
                    </div>
                </div>

                <div class="row mt-5 ">
                    <div class="col-md-12 ">
                        <div class="text-center font-weight-bold">
                            <!-- <pre style="font-size:60px;letter-spacing: 5px;background-color: #ddd;color:red;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><strong>Total:</strong> <?php $can = mysqli_query($con, "SELECT SUM(importe) as neto FROM caja_tmp where usu='$usuario'");
                                                                                                                                                                                                        if ($dato = mysqli_fetch_array($can)) {

                                                                                                                                                                                                            $NETO = $dato['neto'] - ($dato['neto'] * $_SESSION['ddes'] / 100);
                                                                                                                                                                                                            $_SESSION['neto'] = $NETO;
                                                                                                                                                                                                            echo  '₲ ' . number_format($_SESSION['neto'], 0, ",", ".");
                                                                                                                                                                                                        } ?></pre>
 -->

                            <div align="center">

                            </div>
                        </div>
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
        <pre style="font-size:60px;letter-spacing: 5px;background-color: #ddd;color:red;font-family:Rockwell Extra Bold" ><strong>Total:</strong> <?php $can = mysqli_query($con, "SELECT SUM(importe) as neto FROM caja_tmp where usu='$usuario'");
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
                                    <!-- <a href="#myContado" role="button" class="btn btn-block btn-success btn-lg" id="bt" data-toggle="modal"><i class="fa fa-shopping-cart"></i> VENDER!</a> -->

                                    <a href="procesarCredito.php" class="btn btn-block btn-success btn-lg" target="admin"><i class="fa fa-shopping-cart"></i> Proceder a los detalles</a>

                                    <!-- este es el codigo que realiza la funcion print con el teclado-->
                                    <script type="text/javascript">
                                        document.onkeydown = function(e) {
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
    <div class="modal fade bd-example-modal-lg" id="myContado" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <!-- <div class="modal fade" id="myContado" tabindex="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myLargeModalLabel">
                        <span class="text-success">Monto:
                            <?php echo ' ' . number_format($_SESSION['neto'], 0, ",", "."), "₲ "; ?></span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form1" name="contado" method="get" action="contado_cuota.php">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NOMBRE DEL CLIENTE </label>
                                    <select id="nombrecli" class="form-control mySelect" required="" name="nombrecli">
                                        <?php
                                        $can = mysqli_query($con, "SELECT * FROM clientes where estado='1'");
                                        while ($dato = mysqli_fetch_array($can)) {
                                        ?>
                                            <option value="<?php echo $dato['nombrecli']; ?>" <?php if ($nombrecli == $dato['nombrecli']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $dato['nombrecli']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group m-0 p-0">
                                    <label for="cedula">Cedula/RUC</label>
                                    <input type="text" readonly name="cedula" id="cedula" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-2 p-0">
                                    <label for="cedula">Direccion</label>
                                    <input type="text" readonly name="direccion" id="direccion" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-1 p-0">
                                    <label for="celular">Telefono/celular</label>
                                    <input type="text" readonly name="celular" id="celular" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-4">
                                    <a href="crear_clientes.php" target="admin" class="btn btn-block btn-inverse-info">
                                        Crear Nuevo Cliente
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cuotas">Numero de Cuotas</label>
                                    <input name="cuotas" placeholder="Ingrese la cantidad" type="number" id="cuotas" class="form-control" required />
                                </div>
                                <!-- <div class="form-group">
                                    <label for="vencimiento">Vencimiento de la Primera cuota</label>
                                    <input name="vencimiento" id="vencimiento"
                                    type="text" disabled value="22/22/22" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="vencimiento_total">Vencimiento del Credito</label>
                                    <input name="vencimiento_total" id="vencimiento_total"
                                    type="text" disabled value="22/22/22" class="form-control" required />
                                </div>
                                       -->
                                <div class="form-group">
                                    <input type="hidden" name="tpagar" id="tpagar" value="<?php echo $_SESSION['neto']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="interes">TASA DE INTERES %:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="interes" id="interes">
                                </div>
                                <div class="form-group">
                                    <label for="monto_interes">MONTO MAS INTERES:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="monto_interes" id="monto_interes">
                                </div>
                                <div class="form-group">
                                    <label for="monto_por_cuota">MONTO POR CUOTA:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="monto_por_cuota" id="monto_por_cuota">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="d-flex">
                                        <button type="submit" class="mt-4 ml-2 btn btn-dark btn-lg btn-block" name="button" id="button" value="FACTURAR"><i class="fa fa-money" aria-hidden="true"></i> PROCESAR VENTA A CREDITO</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group" id='plan-pago'>
                                    <label for="plan_pago">Plan de Pago</label><br>
                                    <label for="">
                                        Con Entrega
                                        <input type="radio" name="entrega" value="Y" id="si_entrega">
                                    </label>
                                    <label for="">
                                        Sin Entrega
                                        <input type="radio" name="entrega" value="N" checked id="no_entrega">
                                    </label>
                                </div>
                                <div class="form-group" id='valor-entregar'>
                                    <label for="primera_entrega">Valor a Entregar</label>
                                    <input name="primera_entrega" id="primera_entrega" placeholder="Ingrese el monto" value="0" type="number" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                </div> -->
            </div>
        </div>
    </div>
    <?php
    // require_once('partials/feet.php');
    require_once "partials/footer.php" ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#codigo').focus()
            // $('.flexdatalist').flexdatalist({
            //     minLength: 1
            // });
            $("#codigo").autocomplete({
                source: 'php_action/actions.php?request=cargarFotoAjax',
                minLength: 1,
                select: function(e, ui) {
                    $('#codigo').val(ui.item.value)
                }
            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $('<li class="ui-autocomplete-row"></li>')
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul)
            }
        });

        $('#plan-pago').hide()
        $('#valor-entregar').hide()
        const tPagar = document.getElementById('tpagar')
        const cuotas = document.getElementById('cuotas')
        const interes = document.getElementById('interes')
        const montoInteres = document.getElementById('monto_interes')
        const montoPorCuota = document.getElementById('monto_por_cuota')
        const primeraEntrega = document.getElementById('primera_entrega')
        const siEntrega = document.getElementById('si_entrega')
        const noEntrega = document.getElementById('no_entrega')

        cuotas.addEventListener('change', () => {
            $('#plan-pago').show()
            $('#valor-entregar').show()
        })

        const percent = 100
        cuotas.addEventListener('input', () => {
            const cuotaValue = parseInt(cuotas.value)
            let actionPercent, action
            switch (cuotaValue) {
                case 1:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 2:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 3:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 4:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 5:
                    interes.value = 15
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 6:
                    interes.value = 18
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 7:
                    interes.value = 21
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 8:
                    interes.value = 24
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 9:
                    interes.value = 27
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 10:
                    interes.value = 30
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 11:
                    interes.value = 33
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 12:
                    interes.value = 36
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 13:
                    interes.value = 39
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 14:
                    interes.value = 42
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 15:
                    interes.value = 45
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 16:
                    interes.value = 48
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 17:
                    interes.value = 51
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 18:
                    interes.value = 54
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 19:
                    interes.value = 57
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 20:
                    interes.value = 60
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 21:
                    interes.value = 63
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 22:
                    interes.value = 66
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 23:
                    interes.value = 69
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 24:
                    interes.value = 72
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
            }

            const calcMontoValue = Math.round(parseInt(montoInteres.value / cuotaValue))
            montoPorCuota.value = calcMontoValue
            // Controlar si se realiza la primera entrega
            siEntrega.addEventListener('click', function() {
                $('#no_entrega').attr('checked', false)
                $('#si_entrega').attr('checked', true)
                primeraEntrega.value = calcMontoValue
            })
            noEntrega.addEventListener('click', function() {
                $('#si_entrega').attr('checked', false)
                $('#no_entrega').attr('checked', true)
                primeraEntrega.value = 0
            })

        })

        const ventas = document.querySelectorAll('.ventaInput'),
            selects = document.querySelectorAll('.selectVentaInput')

        ventas.forEach((venta) => {
            venta.style.borderTopLeftRadius = '0px'
            venta.style.borderBottomLeftRadius = '0px'
            venta.style.backgroundColor = '#fff'
            venta.style.width = '110px'
        })

        selects.forEach((select) => {
            select.style.width = '48px'
            select.style.paddingLeft = '0px'
            select.style.borderTopRightRadius = '0px'
            select.style.borderBottomRightRadius = '0px'
            select.style.borderRight = '0px'
            select.style.height = '47px'
        })

        $('#resetData').on('click', function() {
            const image = document.getElementById('preview')
            image.setAttribute('src', '/assets/images/lightbox/default.png')
        })


        let tbodys = document.querySelectorAll('tbody tr')
        tbodys.forEach(element => {
            console.log($(`#${element.id}`).attr('data-id'))
            let el = $(`#${element.id}`).attr('data-id')
            $('#' + el + ' #selectVenta').on('change', function(e) {
                e.preventDefault()
                let precioVal = $('#' + el + ' #selectVenta').val(),
                    venta = $('#' + el + ' #venta'),
                    precioFinal = venta.val(precioVal)
                venta.focus()
            })
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
        $('#nombrecli').select2()
        var cliente = $('#nombrecli');
        cliente.on('change', function(e) {
            e.preventDefault()
            var nombrecli = $('#nombrecli').val();
            $.ajax({
                url: 'helper/fetchClient.php',
                type: 'POST',
                data: {
                    nombrecli: nombrecli
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#cedula').val(data.cedula)
                    $('#direccion').val(data.direc)
                    $('#celular').val(data.celular)
                },
                error: function(msj) {
                    console.log(msj)
                }
            })
        })

        function eliminarVenta() {
            Swal.fire({
                position: 'top',
                title: 'DESEA BORRAR LOS DATOS DE ESTA VENTA?',
                text: "Se formateara la caja de la transaccion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No!',
            }).then((result) => {
                if (result.value) {
                    window.location = `app/php_limpiar_venta_credito.php`
                }
            })
        }



        $('#codigo').on('change', function() {
            if ($('#codigo').val()) {
                const param = $('#codigo').val()
                imageLoad(param)
            }

        })

        function imageLoad(param) {
            fetch(`php_action/actions.php?request=cargarFoto&foto=${param}&nombre=ricardo`)
                .then(res => res.text())
                .then(data => {
                    const image = document.getElementById('preview')
                    if (data !== 'vacio') {
                        image.setAttribute('src', data)
                    } else {
                        image.setAttribute('src', 'https://carlitos.test/assets/images/lightbox/default.png')
                    }

                })
                .catch(err => console.error(err))
        }
    </script>