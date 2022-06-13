<?php
session_start();
include('includes/header.php');
include('php_conexion.php');

$usu=$_SESSION['username'];

$tipo_usu=$_SESSION['tipo_usu'];
if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
    header('location:error.php');
}

?>



<form name="form3" class="form-inline" method="post" action="config.php">
    <label class=" fa fa-level-down" style="font-size:24px; color:red">Ingrese IVA<br> de la categoria  <br></label>


    <div class="input-prepend input-append">
       <?php $can=mysql_query("SELECT * FROM producto where estado='s'");?>
        <input  type="number" class="form-control form-control-sm" min="0" max="99" name="iva" id="iva" value=""/><button class="btn btn-danger" value=>"%"</button>
    </div>
    <label>Seccion del Articulo: </label>
    <select class=" form-control" name="seccion" id="seccion">
        <option
                value="0" selected> Seccion por defecto</option>
        <?php

            $can = mysql_query("SELECT * FROM seccion where estado='s'");

        while($dato=mysql_fetch_array($can)) {





            ?>

            <option value="<?php echo $dato['id']; ?>" <?php
            if (isset($_POST['seccion'])){

            if($seccion==$dato['id']){ echo 'selected'; }} ?>

            >
                <?php echo $dato['nombre'] ?></option>
        <?php } ?>
    </select>

    <button type="submit" class="btn btn-sm btn-dark"><i class="fa fa-tag "></i> Aplicar</button>


        <?php

    if(isset($_POST['iva'])) {
        $can=mysql_query("UPDATE producto set iva=".$_POST['iva']." where seccion=".$_POST['seccion']."");
        }


            ?>



</form>

</div>