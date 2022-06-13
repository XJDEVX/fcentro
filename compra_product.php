<?php
    session_start();
    include('php_conexion.php'); 
    if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
      header('location:error.php');
    }
    $usuario=$_SESSION['username'];$cans=mysql_query("SELECT * FROM usuarios where usu='$usuario'");if($datos=mysql_fetch_array($cans)){$nombre_usu=$datos['nom'];}if(!empty($_POST['tmp_cantidad']) and !empty($_POST['tmp_nombre']) and !empty($_POST['tmp_valor'])){ $tmp_cantidad=$_POST['tmp_cantidad'];
      $tmp_nombre=$_POST['tmp_nombre'];$tmp_valor=$_POST['tmp_valor'];$fechay=date("Y-m-d");$tmp_importe=$tmp_cantidad*$tmp_valor;$sql="INSERT INTO caja_tmp (cod, nom, venta, cant, importe, exitencia, usu) VALUES  ('0000','$tmp_nombre','$tmp_valor','$tmp_cantidad','$tmp_importe','$tmp_cantidad','$usuario')";mysql_query($sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'  ?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

    <div class="container-fluid">
      <div class="row justify-content-left">
        <div  class="col-6">

<form name="form1"  method="post" action="">
          <input type="submit" autofocus class="myinput form-control" id="codigo" name="codigo" list="characters" placeholder="Codigo de barra o Nombre del producto" autocomplete="off">
              <datalist id="characters">
              <?php $can=mysql_query("SELECT * FROM producto");while($dato=mysql_fetch_array($can)){echo '<option value="'.$dato['nom'].'">';}?>
          </datalist>
          
        </form>
      
      <?php 
      if(!empty($_POST['codigo'])){$codigo=$_POST['codigo'];$can=mysql_query("SELECT * FROM caja_tmp where cod='$codigo' or nom='$codigo'");
      if($dato=mysql_fetch_array($can)){$acant=$dato['cant']+1; $dcodigo=$dato['cod'];  $aventa=$dato['venta']*$acant;
        $sql="Update caja_tmp Set importe='$aventa', cant='$acant' Where cod='$dcodigo'";mysql_query($sql); 
      }else{$cans=mysql_query("SELECT * FROM producto where cod='$codigo' or nom='$codigo'"); if($datos=mysql_fetch_array($cans)){
          if($_SESSION['tventa']=="venta"){$importe=$datos['venta'];  $venta=$datos['venta']; }else{$importe=$datos['mayor']; $venta=$datos['mayor'];}$cod=$datos['cod'];$nom=$datos['nom'];$cant="1";$exitencia=$datos['cantidad'];$usu=$_SESSION['username'];$sql="INSERT INTO caja_tmp (cod, nom, venta, cant, importe, exitencia, usu) VALUES ('$cod','$nom','$venta','$cant','$importe','$exitencia','$usu')";mysql_query($sql);}else{echo '<div class="alert alert-danger" align="center"><button type="button" class="close" data-dismiss="alert">×</button><strong>Producto no encontrado en la base de datos<br><a href="#mycrear" role="button" class="btn btn-success" data-toggle="modal">Crear Nuevo Producto </a></strong></div>';}}}  ?> 
    </div>
<div class="col-3"></div>
  <td width="27%"><center>
      <!--  <a href="#mycrear" role="button" class="btn" data-toggle="modal">
          <i class="icon-tag"></i> Agregar Producto Común
        </a>-->
     
  <div class="col-12">
          <div  class="card">

            <div class="card-header" style="background-color: #ddd">
              <strong><i class="fa fa-user-circle"></i> Cajero/a: <?php echo $nombre_usu; ?></strong>
        </div>
        </div>
        </div>
</div>

<br>
        <div class="col-12">
        <div class="row justify-content-end">
          <?php   if(!empty($_SESSION['tventa'])){if($_SESSION['tventa']=='venta'){$vboton="btn btn-primary";
          }else{$vboton="btn";}if($_SESSION['tventa']=='mayoreo'){$mboton="btn btn-primary";
          }else{$mboton="btn";}}else{$_SESSION['venta'];  $vboton="btn btn-primary";}?>
                    <strong  class="alert alert-danger">Presione boton para precio de compra <i class="fa fa-arrow-circle-right"  style="font-size:48px;"></i> 
 
          <!--  <button type="button" class="<?php echo $vboton; ?>" onClick="window.location='php_caja_compra.php?tventa=venta'">P. Publico</button> -->
            <button type="button" class="<?php echo $mboton; ?>" style="font-size:15px;padding-down:50px;" onClick="window.location='php_caja_compra.php?tventa=mayoreo'">Precio de Compra</button></strong>
        </div>
      </div>
   
  
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
  $can=mysql_query("SELECT * FROM caja_tmp where usu='$usuario'");if($dato=mysql_fetch_array($can)){echo '<div style=" OVERFLOW: auto; WIDTH: 100%; TOP: 48px; HEIGHT: 200px">';}?>
<table width="00%" border="0" class="table table-hover">
  <tr class="bg-info">
    <td width="13%"><strong>Codigo</strong></td>
    <td width="27%"><strong>Descripcion del Producto</strong></td>
    <td width="15%"><strong>Valor Unitario</strong></td>
    <td width="13%"><strong><center>Cant.</center></strong></td>
    <td width="12%"><strong>Importe</strong></td>
    <td width="9%"><strong><center>Existencia</center></strong></td>
    <td width="11%">&nbsp;</td>
  </tr>
 
  <?php $na=0;$can=mysql_query("SELECT * FROM caja_tmp where usu='$usuario'");  while($dato=mysql_fetch_array($can)){ $na=$na+$dato['cant']; ?>
  <tr>
    <td><center><?php echo $dato['cod']; ?></center></td>
    <td><?php echo $dato['nom']; ?></td>
    <td><div align="right">₲ <?php echo number_format($dato['venta'],0,",","."); ?></div></td>
    <td><center><a href="compra_product.php?idd=<?php echo $dato['cod'].'&ddes='.$_SESSION['ddes']; ?>"><?php echo $dato['cant']; ?></a></center></td>
    <td bgcolor="#D9EDF7"><div align="right">$ <?php echo number_format($dato['importe'],0,",","."); ?></div></td>
    <td><center><?php 
  if(($dato['exitencia']+$dato['cant'])>0){
    echo $dato['exitencia']+$dato['cant'];
  }else{
    echo 0;
  }
   ?></center></td>
    <td> 
    <button type="button" class="btn btn-danger" onClick="window.location='php_eliminar_compra.php?id=<?php echo $dato['cod']; ?>'"><i class="fa fa-trash" style="font-size:23px; color:black"></i> Eliminar</button>
    </td>
  <?php } ?>
  
</table>

<?php $can=mysql_query("SELECT * FROM caja_tmp where usu='$usuario'");if($dato=mysql_fetch_array($can)){  echo '</div>';} //cierra el div?>
<?php if(!empty($_GET['id'])){ ?>
<!--<form name="form2" method="get" action="php_caja_act.php">
  <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['id'] ?>">
  Nuevo Precio o % Descuento: <input type="text" name="xdes" id="xdes" value="0" autocomplete="off">
  [ <input type="radio" name="tipo" id="optionsRadios1" value="p" checked>Descuento % ]
  [ <input type="radio" name="tipo" id="optionsRadios1" value="d" checked>Nuevo Precio ₲ ]
  <button type="submit" class="btn btn-success">Procesar</button>  
</form>-->
<?php } ?>
<?php if(!empty($_GET['idd'])){ ?>
<form name="form2" method="get" action="php_caja_compra.php">
  <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['idd'] ?>">
  Cantidad: <input type="text" name="cantidad" id="cantidad" value="0" autocomplete="off">
  <button type="submit" class="btn btn-success">Procesar</button>  
</form>
<?php } ?>
<br>
<table width="100%" border="0">
  <tr>
    <td width="35%"><pre style="font-size:24px;background-color:#ddd"><center><?php echo $na; ?> Articulos en Compra</center></pre></td>
    <td width="3%">&nbsp;</td>
    <td width="26%">    
  
   <!-- <form name="form3" method="get" action="compra_product.php">
    <label>Descuento al Neto</label>
      <div class="input-prepend input-append">
        <input type="number" class="span1" min="0" max="99" name="ddesc" id="ddes" value="<?php echo $_SESSION['ddes']; ?>">
        <span class="add-on">%</span>
      </div>
       <button type="submit" class="btn btn-mini">Aplicar Descuento</button>
    </form>
    </td>
    <td width="36%">-->

<br><br><br><br>
      <div align="right">
        <pre style="font-size:24px;background-color:#ddd">Total: <?php $can=mysql_query("SELECT SUM(importe) as neto FROM caja_tmp where usu='$usuario'");
        if($dato=mysql_fetch_array($can)){$NETO=$dato['neto']-($dato['neto']*$_SESSION['ddes']/100);  $_SESSION['neto']=$NETO;
        echo '₲ '.number_format($_SESSION['neto'],0,",",".");}?></pre>
        <div align="center">
          <form id="form1" name="contado" method="get" action="compra_contado.php">
                <label for="ccpago">Pagar</label>
                <input type="hidden" name="tpagar" id="tpagar" autofocus class="form-control" value="<?php echo $_SESSION['neto']; ?>">
                    <input type="number" placeholder="Ingrese el monto del efectivo" name="ccpago" class="form-control" id="ccpago" autocomplete="on" required />
                </div><br>
                <input type="submit" class="btn btn-success" name="button" id="button" value="Pagar Compra" />
          </form>
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td colspan="4">
    <?php if($NETO<>0){ ?>
    <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
        <div align="center">
        <!-- <a href="#myContado" role="button" class="btn btn-success" id="bt" data-toggle="modal"><i class=" icon-shopping-cart"></i> V. Contado</a> -->

       <!-- este es el codigo que realiza la funcion print con el teclado-->
        <script type="text/javascript">
        document.onkeydown=function(e){
          if(window.event){tecla=e.keyCode;}else if(e.which){tecla=e.which;}
          if(tecla==113){
              document.getElementById('bt').click();
        }
            
         }


        </script>
        </div>
    </div>

    <?php } ?>
    </td>
  </tr>
</table> 
<!-- Modal -- myContado -->
<!--<div id="myContado" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">COBRAR </h3>
  </div>
  <div class="modal-body">
      <p align="center" class="text-info"><strong>Total Cobrar</strong></p>
      <pre style="font-size:30px"><center><?php echo ' '.number_format($_SESSION['neto'],0,",","."), "₲ "; ?></center></pre>
    <p align="center" class="text-info"><strong>Forma de Pago "Contado"</strong></p>
        <div align="center">
          <form id="form1" name="contado" method="get" action="contado_credito.php">
                <label for="ccpago">Dinero Recibido</label>
                <input type="hidden" name="tpagar" id="tpagar" value="<?php echo $_SESSION['neto']; ?>">
                <div class="input-prepend input-append">
                    <span class="add-on">$</span>
                    <input type="number" name="ccpago" id="ccpago" autocomplete="on" required />
                    <span class="add-on">.00</span>
                </div><br>
                <input type="submit" class="btn btn-success" name="button" id="button" value="Cobrar Dinero Recibido" />
      
          </form>
        </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
</div>
</div>

<!-- Modal crear articulo -->
<div id="mycrear" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Agregar Producto en Comun</h3>
    </div>
   
    <div class="modal-body">
      <form id="form1" name="form1" method="post" action="">
        <center>
        <table width="80%" border="0">
          <tr>
            <td>Descripcion</td>
            <td><input type="text" autofocus name="tmp_nombre" id="tmp_nombre" /></td>
          </tr>
          <tr>
            <td>Cantidad</td>
            <td><input type="number" name="tmp_cantidad" id="tmp_cantidad" min="1" value="1" /></td>
          </tr>
          <tr>
            <td>valor</td>
            <td><input type="number" name="tmp_valor" id="tmp_valor" /></td>
          </tr>
          <tr>
            <td colspan="2"><div align="center">
              
            </div></td>
          </tr>
        </table>
        </center>
       
    </div>
    <div class="modal-footer" align="center">
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Guardar" />
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
    </div>
    </form>
</div> 
</div> 
<?php include( 'includes/scripts.php' ) ?>
</body>
</html>