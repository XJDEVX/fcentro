<?php
        session_start();
        include('php_conexion.php'); 
        
        $usu=$_SESSION['username'];
        $tipo_usu=$_SESSION['tipo_usu'];
        if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
            header('location:error.php');
        }
       
   $id='' ;  $factura='';  $codigo='';$nombre=''; $cantidad='' ;$valor='';$importe='';    
        if(!empty($_GET['id'])){    
            $id=$_GET['id'];
            
            $can=mysql_query("SELECT * FROM detalle where id='$id' ");
        if($dato=mysql_fetch_array($can)){
            $id=$dato['id']; $factura=$dato['factura'];
            $codigo=$dato['codigo'];
            $nombre=$dato['nombre'];
            $cantidad=$dato['cantidad'];
            $valor=$dato['valor'];
            $importe=$dato['importe'];
                $boton="Actualizar factura";    
            }
        }else{
            $boton="Guardar factura";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/header.php'); ?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid">
        <?php 
            if(!empty($_POST['id']) ) {

   $id=$_POST['id'];  $factura=$_POST['factura'] ; $codigo=$_POST['codigo'];$nombre=$_POST['nombre'];$cantidad=$_POST['cantidad'];$valor=$_POST['valor'];$importe=$_POST['importe'];


               $can=mysql_query("SELECT * FROM detalle where id='$id'");
                if($dato=mysql_fetch_array($can)){
                    if($boton=='Actualizar factura'){
                        $xSQL="Update detalle Set  factura='$factura',codigo='$codigo',nombre='$nombre',cantidad='$cantidad',valor='$valor',importe='$importe'

                                                     Where id=$id";
                        mysql_query($xSQL); echo '  <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">X</button>
                                  <strong>detalle</strong> Actualizado con Exito</div>';}
                                  else{echo ' <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">X</button><strong>Error! </strong>El numero de documento que ingreso le pertenece al cliente '.$dato['detalle'].'</div>';
                }
}


                              
                               }
        ?>
         <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fa fa-user-plus"></i> </h5>
                    </div>
                    <div class="card-body">
                        <!-- Formulario -->
                        <form name="form1" method="post" action="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="textfield">id: </label>
                                            <input type="text" class="form-control form-control-sm" placeholder="" name="id" id="id"  value="<?php echo $id ;?>" readonly autocomplete="off" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="textfield">factura: </label>
                                            <input type="text" class="form-control form-control-sm" placeholder="" name="factura" id="factura" readonly  value="<?php echo $factura; ?>" autocomplete="off" required> 
                                    </div>
                                    <div class="form-group">
                                       
                                      <label for="textfield">codigo: </label><input type="text" name="codigo" class="form-control form-control-sm" placeholder="" readonly="" id="codigo" value="<?php echo $codigo; ?>" autocomplete="off" required>  
                                    </div>
                                    <div class="form-group">
                                      <label for="textfield">Detalle: </label><input type="text" class="form-control form-control-sm" placeholder="" name="nombre" id="nombre" value="<?php echo $nombre; ?>" autocomplete="off">  
                                    </div>
                                   
                                   
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="textfield">Cantidad: </label><input type="text" name="cantidad" id="cantidad" class="form-control form-control-sm" placeholder="" value="<?php echo $cantidad; ?>" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label class="textfield">Valor</label>
                                       <input type="text" name="valor" id="valor" class="form-control form-control-sm" placeholder="" value="<?php echo $valor; ?>" autocomplete="off"></input>
                                    </div>
                                     <div class="form-group">

                                         <label class="textfield">Importe</label>
                                       <input type="text" name="importe" id="importe" class="form-control form-control-sm" placeholder="" <?php if ($boton=='Actualizar factura') {
                                               $importe=$cantidad*$valor;
                                           } ?>     value="<?php  echo $importe; ?>" autocomplete="off">
                                           
                                       </input>
                                    </div>
                                    
                                       
                            <hr>
                         <div class="row justify-content-center">
                           <button class="btn btn-lg btn-success" type="submit"><i class="fa fa-plus"></i> <?php echo $boton; ?></button>
                         <?php if($boton=='Actualizar factura'){ 

                            ?> <a href="edititem.php" class="btn btn-lg btn-danger">Cancelar</a>
                     <?php }  ?>
                            </div> 
                        </form>
                        <!-- formulario============== -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>

 
<!-- <div class="control-group info">
  <form name="form1" method="post" action="">
<table width="80%" border="0" class="table">
  <tr class="info">
    <td colspan="2"><center><strong>Crear Cliente / Usuario</strong></center></td>
  </tr>
  <tr>
    <td>
        <label for="textfield">Documento / Cedula: </label>
        <input type="text" name="cedula" id="cedula" <?php if(!empty($cedula)){echo 'readonly';} ?> value="<?php echo $cedula; ?>" autocomplete="off" required>
        <label for="textfield">Nombre y Apellido: </label><input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" autocomplete="off" required>
        
        <label for="textfield">Ciudad: </label><input type="text" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>" autocomplete="off" required><br>
        <div class="input-prepend input-append">
            <label for="textfield">Cupo: </label>
            <span class="add-on">$</span><input type="text" name="cupo" id="cupo" value="<?php echo $cupo; ?>" autocomplete="off" required><span class="add-on">.00</span>
        </div>
        <label for="textfield">Cuenta de Usuario: </label>
        <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" <?php if(!empty($usuario)){echo 'readonly';} ?> autocomplete="off" required>
        <?php if($boton=='Actualizar Usuario' and $tipo_usu=='a'){ ?>
            <a href="#myModal" role="button" class="btn btn-mini" data-toggle="modal">Ver Contraseña</a>
        <?php } ?>
        <br><br>
        <button class="btn btn-large btn-primary" type="submit"><?php echo $boton; ?></button>
        <?php if($boton=='Actualizar Usuario'){ ?> <a href="crear_clientes.php" class="btn">Cancelar</a><?php }  ?>
    </td>
    <td>
        <label for="textfield">Direccion: </label><input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>" autocomplete="off" required>
        <label for="textfield">Barrio / Localidad: </label><input type="text" name="barrio" id="barrio" value="<?php echo $barrio; ?>" autocomplete="off">
        <label for="textfield">Telefono: </label><input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>" autocomplete="off" required>
        <label for="textfield">Celular / Mobil: </label><input type="text" name="celular" id="celular" value="<?php echo $celular; ?>" autocomplete="off">
        <label for="radio">Tipo de Usuario</label>
        <?php if($tipo_usu=='a'){ ?>
        <label class="radio">
        <input type="radio" name="tipo" id="optionsRadios1" value="a" <?php if($tipo=="a"){ echo 'checked'; } ?>>Administrador</label>
        <?php } ?>
        <label class="radio">
        <input type="radio" name="tipo" id="optionsRadios2" value="cl" <?php if($tipo=="cl"){ echo 'checked'; } if(empty($_GET['codigo'])){ echo 'checked';} ?>>Cliente</label>
        <label class="radio">
        <input type="radio" name="tipo" id="optionsRadios3" value="ca" <?php if($tipo=="ca"){ echo 'checked'; } ?>>Cajera</label>
    </td>
  </tr>
</table>
</form>
</div>

    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Recordar Contraseña</h3>
            </div>
            <div class="modal-body">
            <p><?php echo $nombre; ?></p>
            <p>Contraseña:<strong> <?php echo $dato['con']; ?></strong></p>
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div> -->
    <?php include('includes/scripts.php'); ?>
</body>
</html>
