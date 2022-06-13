<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require '../../vendor/autoload.php';

use Carbon\Carbon;

require_once '../models/User.php';
require_once '../helpers/functions.php';
$user = new User();
$id = isset($_POST['id']) ? escapeCharacters($_POST['id']) : '';
$nombre = isset($_POST['nombre']) ? escapeCharacters($_POST['nombre']) : '';
$email = isset($_POST['email']) ? escapeCharacters($_POST['email']) : '';
$username = isset($_POST['username']) ? escapeCharacters($_POST['username']) : '';
$password = isset($_POST['password']) ? escapeCharacters($_POST['password']) : '';
$confirm = isset($_POST['confirm_password']) ? escapeCharacters($_POST['confirm_password']) : '';
$cedula = isset($_POST['cedula']) ? escapeCharacters($_POST['cedula']) : '';
$rol = isset($_POST['rol']) ? escapeCharacters($_POST['rol']) : '';
$status = isset($_POST['status']) ? escapeCharacters($_POST['status']) : '';
$foto = isset($_POST['foto']) ? escapeCharacters($_POST['foto']) : '';
$req = $_GET['req'];
switch ($req) {
    case 'login':
        $crypt = hash('SHA256', $password);
        $data = [
            'username' => $username,
            'password' => $crypt
        ];
        $res = $user->login($data);
        if ($res->num_rows > 0) {
            $fetch = $res->fetch_object();
            if ($fetch) {
                $user->enterCheck($fetch->id);
                $_SESSION['id'] = $fetch->id;
                $_SESSION['nombre'] = $fetch->nombre;
                $_SESSION['email'] = $fetch->email;
                $_SESSION['tventa'] = "venta";
                $_SESSION['ddes'] = 0;
                $_SESSION['username'] = $fetch->username;
                $_SESSION['cedula'] = $fetch->cedula;
                $fetch->rol == 'A'
                    ? $_SESSION['rol'] = 'Administrador'
                    : $_SESSION['rol'] = 'Empleado';
                $_SESSION['entrada'] = date('d-m-Y H:i:s', strtotime(Carbon::now()));
                $_SESSION['salida'] = date('d-m-Y H:i:s', strtotime($fetch->salida));
                $fetch->foto == ''
                    ? $_SESSION['foto'] = '/upload/users/avatar.png'
                    : $_SESSION['foto'] = $fetch->foto;
                $fetch->estado == 1
                    ? $_SESSION['estado'] = 'Activo'
                    : $_SESSION['estado'] = 'Inactivo';
            } else {
                $fetch = null;
            }
        } else {
            $fetch = null;
        }
        echo json_encode($fetch);
        break;
        

    case 'logout':
        $user->outpoutCheck($_SESSION['id']);
        $_SESSION['username'] = NULL;
        $_SESSION['rol'] = NULL;
        // session_destroy();
        header('Location: ../../');
        break;

    case 'getUsers':
        $users = $user->getUsers();
        $data = [];
        foreach ($users as $user) {
            $btnShow = '<button type="button" class="btn btn-inverse-info py-2" onclick="openDetails(' . $user['id'] . ')"><i class="fas fa-eye"></i></button>';
            $btnUpdate = '<button type="button" onclick="openEdit(' . $user['id'] . ')" class="btn btn-inverse-warning py-2"><i class="fas fa-edit"></i></button>';
            $btnDelete = '<button type="button" onclick="deleteUser(' . $user['id'] . ')" class="btn btn-inverse-danger py-2"><i class="fas fa-trash"></i></button>';
            $rol = '';
            $status = '';
            if ($user['status'] === '1') {
                $status = '<span class="badge badge-sm badge-success">Activo</span>';
            } else {
                $status = '<span class="badge badge-sm badge-danger">Inactivo</span>';
            }
            if ($user['rol'] === 'A') {
                $rol = 'Administrador';
            } else {
                $rol = 'Empleado';
            }
            $data[] = [
                '0' => $user['foto'] == ''
                    ? '<img class="img-fluid rounded-circle shadow" src="../upload/users/avatar.png">'
                    : '<img class="img-fluid rounded-circle shadow" src="' . $user['foto'] . '">',
                '1' => $user['nombre'],
                '2' => $user['username'],
                '3' => '<span class="badge badge-light badge-pill">' . $rol . '</span>',
                '4' => $status,
                '5' => $btnShow . ' ' . $btnUpdate . ' ' . $btnDelete
            ];
        }
        $json = [
            'sEcho'                 => 1,
            'iTotalRecords'         => count($data),
            'iTotalDisplayRecords'  => count($data),
            'aaData'                => $data
        ];
        echo json_encode($json);
        break;
    case 'getUser':
        $data = [
            'id' => $id
        ];
        $res = $user->getUser($data);
        echo json_encode($res);
        break;
    case 'addAndEdit':
        $crypt = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        $imgTmp = $_FILES['foto']['tmp_name'];
        $imgName = $_FILES['foto']['name'];
        $imgType = $_FILES['foto']['type'];
        if (!file_exists($imgTmp) || !is_uploaded_file($imgTmp)) {
            $foto = $_POST['fotoActual'];
        } else {
            $nuevoAncho = '200';
            $nuevoAlto = '200';
            list($ancho, $alto) = getimagesize($imgTmp);
            $ext = explode('.', $imgName);
            $foto = '../upload/users/' . $username . '.' . end($ext);
            if ($imgType == 'image/jpg' || $imgType == 'image/jpeg') {
                $origen = imagecreatefromjpeg($imgTmp);
                $destine = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destine, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destine, $foto);
            }
            if ($imgType == 'image/png') {
                $origen = imagecreatefrompng($imgTmp);
                $destine = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destine, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destine, $foto);
            }
        }
        if (empty($id)) {
            $data = [
                'nombre'    => $nombre,
                'email'     => $email,
                'username'  => $username,
                'password'  => $crypt,
                'cedula'    => $cedula,
                'foto'      => $foto,
                'rol'       => $rol,
                'status'    => $status
            ];
            $res = $user->addUser($data);
            echo $res ? 'Success' : 'False';
        } else {
            $data = [
                'id'        => $id,
                'nombre'    => $nombre,
                'email'     => $email,
                'username'  => $username,
                'password'  => $crypt,
                'cedula'    => $cedula,
                'foto'      => $foto,
                'rol'       => $rol,
                'status'    => $status
            ];
            $res = $user->updateUser($data);
            echo $res ? 'Success' : 'False';
        }
        break;

    case 'deleteUser':
        $data = [
            'id' => $id
        ];
        $res = $user->deleteUser($data);
        echo $res ? 'Success' : 'False';
        break;

    case 'changePass':
        $res = '';
        if ($password !== $confirm) {
            $res = 'Not Coincidence';
        } else {
            $crypt = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
            $data = [
                'id' => $_SESSION['id'],
                'password' => $crypt
            ];
            $user->changePass($data);
            $res = 'Success';
        }
        echo $res;
        break;
}
