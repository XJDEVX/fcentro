<?php
        session_start();
        include('php_conexion.php'); 
        $usu=$_SESSION['username'];
        $tipo_usu=$_SESSION['tipo_usu'];
        if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
            header('location:error.php');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/header.php'); ?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid">
    <div class="row justify-content-center">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="btn-group" data-toggle="buttons-checkbox">
          
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="tabla7" width="100%" class="table table-striped">
            <thead>
              <tr>
                <th width="16%"><strong>Codigo</strong></th>
                <th width="30%"><strong>Descripcion</strong></th>
                <th width="20%"></th>
                <th width="7%"><strong></strong></th>
              </tr>
            </thead>
              <?php 
            if(empty($_POST['bus'])){
            	$factura=$_GET['factura'];
            	
              $can=mysql_query("SELECT * from detalle  WHERE factura=$factura ");
            }elseif(empty($_POST['bus'])){
            	$can=mysql_query("SELECT * from detalle  WHERE factura=$factura ");
            	}else{
              $buscar=$_POST['bus'];
              $can=mysql_query("SELECT factu.fecha, factu.factura,factu.nombrecli, detalle.importe,detalle.codigo FROM factura as factu inner join detalle ON factu.factura=detalle.factura  WHERE  factu.nombrecli='$nombrecli'" );
            } 
            while($dato=mysql_fetch_array($can)){
             
            ?>
            <tr>
              <td>
                <?php  echo $dato['codigo']; ?></td>
                
        
                 
              <td><?php echo $dato['nombre']; ?></td>
              <td>
                <?php if($tipo_usu=='ca' and $dato['tipo']<>'a'){ ?>
                  <a href="edititem.php?id=<?php echo $dato['id']; ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar factura"><i class="fa fa-pencil"></i></a> 
                  <?php }elseif($tipo_usu=='a'){ ?>
                    <a href="edititem.php?id=<?php echo $dato['id']; ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar item"><i class="fa fa-pencil"></i></a> 
                  <?php }?>
              </td> 
               <!-- <td><a href="php_estado_cliente.php?id=<?php echo $dato['ced']; ?>"><?php echo $estado; ?></a></td> -->
             
             
             
             
               <td><button type="button" onClick="window.location='eliminaritem.php?id=<?php echo $dato['id']; ?>'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Borrar</button></td> 
              </tr>
              <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
<?php include('includes/scripts.php'); ?>
</body>
</html>