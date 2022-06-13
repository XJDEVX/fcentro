<?php
require '../../vendor/autoload.php';

use Carbon\Carbon;

require_once '../php_conexion.php';
class User
{
	public function login($data)
	{
		$sql = "SELECT * FROM usuarios WHERE username='" . $data['username'] . "' AND password='" . $data['password'] . "'	AND estado='1'";
		return querySimple($sql);
	}
	public function enterCheck($id)
	{
		$getTime = Carbon::now();
		$sql = "UPDATE usuarios SET entrada='$getTime' WHERE id='$id'";
		return querySimple($sql);
	}
	public function outpoutCheck($id)
	{
		$getTime = Carbon::now();
		$sql = "UPDATE usuarios SET salida='$getTime' WHERE id='$id'";
		return querySimple($sql);
	}
	public function getUsers()
	{
		$sql = "SELECT * FROM usuarios ORDER BY id DESC";
		return querySimple($sql);
	}
	public function getUser($data)
	{
		$sql = "SELECT * FROM usuarios WHERE id='" . $data['id'] . "'";
		return queryRow($sql);
	}
	// public function addUser($data)
	// {
	// 	$sql = "INSERT INTO usuarios (nombre, email, username, password, cedula, rol, foto, status) 
	// 	VALUES ('" . $data['nombre'] . "','" . $data['email'] . "','" . $data['username'] . "','" . $data['password'] . "', '" . $data['cedula'] . "','" . $data['rol'] . "',
	// 	'" . $data['foto'] . "', '" . $data['status'] . "')";
	// 	return querySimple($sql);
	// }
	// public function updateUser($data)
	// {
	// 	$sql = "UPDATE users 
	// 	SET nombre='" . $data['nombre'] . "',email='" . $data['email'] . "',username='" . $data['username'] . "',
	// 	password='" . $data['password'] . "',cedula='" . $data['cedula'] . "',rol='" . $data['rol'] . "',foto='" . $data['foto'] . "',status='" . $data['status'] . "'
	// 	WHERE id='" . $data['id'] . "'";
	// 	return querySimple($sql);
	// }
	// public function deleteUser($data)
	// {
	// 	$sql = "DELETE FROM users WHERE id='" . $data['id'] . "'";
	// 	return querySimple($sql);
	// }

	// public function changePass($data)
	// {
	// 	$sql = "UPDATE users SET password='" . $data['password'] . "' WHERE id='" . $data['id'] . "'";
	// 	return querySimple($sql);
	// }
}
