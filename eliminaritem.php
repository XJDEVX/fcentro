<?php 
session_start();
include ('php_conexion.php') ;



$id=$_GET['id'];

if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM detalle WHERE id=$id";
		mysql_query($xSQL);
		header('location:edit.php?ddes='.$_SESSION['ddes']);
}




 ?>

