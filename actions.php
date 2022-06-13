<?php
require_once '../app/php_conexion.php';
$actionRequest = isset($_GET['request']) ? $_GET['request'] : '';
switch ($actionRequest) {
    case 'allInvoices':
        // $sql = "SELECT d.id, d.factura as factura, f.cajera as cajero, f.nombrecli as cliente, f.estado, f.fecha, d.tipo, d.total
        // FROM detalle d INNER JOIN factura f ON d.factura=f.factura GROUP BY factura";
        $sql = "SELECT d.factura as factura, f.cajera as cajero, f.nombrecli as cliente, f.estado, f.fecha, f.total
        FROM (
            SELECT factura FROM detalle GROUP BY factura
        )
        as d INNER JOIN factura f ON d.factura=f.factura";
        $query = querySimple($sql);
        $outpout = array();
        while ($invoice = mysqli_fetch_object($query)) {
            $btnDetalle = '<a class="btn btn-sm btn-secondary px-2 py-2 text-dark" target="admin" href="invoiceDetail.php?factura=' . $invoice->factura . '"><i class="fa fa-eye"></i> Detalle</a>';
            $btnReimprimir = '<a class="btn btn-sm btn-success px-2 py-2 text-light" href="" target="admin"><i class="fa fa-print"></i> Reimprimir</a>';
            $btnEditar = '<a class="btn btn-sm btn-info px-2 py-2 text-light"><i class="fa fa-pencil"></i> Editar</a>';
            $btnAnular = '<a class="btn btn-sm btn-danger px-2 py-2 text-light" onclick="anularVenta(' . $invoice->factura . ')"><i class="fa fa-trash"></i> Anular</a>';
            $btnAnulado = '<a class="btn btn-sm btn-danger px-2 py-2 text-light disabled">Anulado</a>';
            if ($invoice->estado === 's') {
                $estado = '<span class="badge badge-success">Aprobado</span>';
            } else {
                $estado = '<span class="badge badge-danger">Anulado</span>';
            }
            if ($invoice->estado === 'Anulado') {
                $mostrarBtn = $btnAnulado;
            } else {
                $mostrarBtn = $btnAnular;
            }
            $outpout[] = [
                '0' => $invoice->factura,
                '1' => $invoice->cajero,
                '2' => $invoice->cliente,
                // '3' => $invoice->tipo,
                '3' => date('d-m-Y', strtotime($invoice->fecha)),
                '4' => $invoice->total . ' Gs',
                '5' => $estado,
                '6' => $btnDetalle . ' ' . $mostrarBtn
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allInvoicesCompra':
        // $sql = "SELECT d.factura as factura, d.total AS total, f.cajera as cajero, f.prov as cliente, f.estado, f.fecha
        FROM (
            SELECT factura, total FROM detallecompra GROUP BY factura, total
        ) as d INNER JOIN facturacompra f ON d.factura=f.factura";
        $query = querySimple($sql);
        $outpout = array();
        while ($invoice = mysqli_fetch_object($query)) {
            $btnDetalle = '<a class="btn btn-sm btn-secondary px-2 py-2" target="admin" href="invoiceDetailCompra.php?factura=' . $invoice->factura . '"><i class="fa fa-eye"></i> Detalle</a>';
            $btnReimprimir = '<a class="btn btn-sm btn-success text-light" href="" target="admin"><i class="fa fa-print"></i> Reimprimir</a>';
            $btnEditar = '<a class="btn btn-sm btn-info text-light"><i class="fa fa-pencil"></i> Editar</a>';
            $btnAnular = '<a class="btn btn-sm btn-danger text-light" onclick="anularVenta(' . $invoice->factura . ')"><i class="fa fa-trash"></i> Anular</a>';
            $btnAnulado = '<a class="btn btn-sm btn-danger text-light disabled">Anulado</a>';
            if ($invoice->estado === 's') {
                $estado = '<span class="badge badge-success">Aprobado</span>';
            } else {
                $estado = '<span class="badge badge-danger">Anulado</span>';
            }
            if ($invoice->estado === 'Anulado') {
                $mostrarBtn = $btnAnulado;
            } else {
                $mostrarBtn = $btnAnular;
            }
            $outpout[] = [
                '0' => $invoice->factura,
                '1' => $invoice->cajero,
                '2' => $invoice->cliente,
                // '3' => $invoice->tipo,
                '3' => date('d-m-Y', strtotime($invoice->fecha)),
                '4' => $invoice->total . ' Gs',
                '5' => $estado,
                '6' => $btnDetalle
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allProducts':
        $sql = "SELECT * FROM producto";
        $query = querySimple($sql);
        $outpout = array();
        while ($product = mysqli_fetch_object($query)) {
            if ($product->estado == 'a') {
                $estado = '<span class="badge badge-danger"><i class="fa fa-times"></i> Inactivo</span>';
            } else {
                $estado = '<span class="badge badge-success"><i class="fa fa-check"></i> Activo</span>';
            }
            $btnEditar = '<a class="btn btn-sm btn-info text-light px-2 py-2" data-toggle="tooltip" data-placement="top" title="Editar Producto" href="crear_producto.php?codigo=' . $product->cod . '">
            <i class="fa fa-edit"></i> </a>';

            if( $product->foto !== '' )
            {
                $foto = '<img class="img-fluid rounded-circle shadow" width="120px" src="'.$product->foto.'" >';
            } else {
                $foto = '<img class="img-fluid rounded-circle shadow" width="120px" src="/articulo/producto.png" >';
            }

            $btnEliminar = "<a onclick='deleteProductAjax(`$product->cod`)' target='admin' class='btn btn-danger text-light px-2 py-2'><i class='fa fa-trash'></i></a>";
            $queryProv = querySimple("SELECT * FROM proveedor WHERE id='$product->prov'");
            $datazo = mysqli_fetch_object($queryProv);
            $outpout[] = [
                '0' => $foto, 
                '1' => $product->cod,
                '2' => $product->nom,
                '3' => '<a href="app/php_estado_producto.php?id=' . $product->cod . '">' . $estado . '</a>',
                '4' => $product->prov == 0 ? '<span class="text-muted">No definido</span>' : $datazo->empresa,
                '5' => $product->cantidad,
                '6' => $product->minimo,
                '7' => number_format($product->costo, 0, ",", "."),
                '8' => number_format($product->venta, 0, ",", "."),
                '9' => $btnEditar . ' ' . $btnEliminar
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allUsers':
        $sql = "SELECT * FROM usuarios";
        $query = querySimple($sql);
        $outpout = [];
        while ($user = mysqli_fetch_object($query)) {
            $estado = '';
            if ($user->estado == 1) {
                $estado = '<span class="badge badge-success">Activo<span>';
            } else {
                $estado = '<span class="badge badge-danger">Inactivo</span>';
            }
            $rol = '';
            if ($user->rol === 'A') {
                $rol = '<span class="badge badge-warning">Administrador</span>';
            } else {
                $rol = '<span class="badge badge-warning">Cajero</span>';
            }
            $btnEditar = '<a href="crear_usuarios.php?id=' . $user->id . '" target="admin" class="btn btn-info px-2 py-2"><i class="fa fa-edit"></i></a>';
            $btnEliminar = '<a onclick="deleteUser(' . $user->id . ')" target="admin" class="btn btn-danger text-light px-2 py-2"><i class="fa fa-trash"></i></a>';

            $outpout[] = [
                '0' => $user->nombre,
                '1' => $user->cedula,
                '2' => $user->username,
                '3' => $user->celular != '' ? $user->celular : '<span class="text-muted">No definido</span>',
                '4' => $rol,
                '5' => '<a href="app/php_estado_usuario.php?id=' . $user->id . '">' . $estado . '</a>',
                '6' => $btnEditar . ' ' . $btnEliminar
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allUsersTime':
        $sql = "SELECT * FROM usuarios";
        $query = querySimple($sql);
        $outpout = [];
        while ($user = mysqli_fetch_object($query)) {
            if ($user->rol === 'A') {
                $rol = '<span class="badge badge-warning">Administrador</span>';
            } else {
                $rol = '<span class="badge badge-warning">Cajero</span>';
            }
            $outpout[] = [
                '0' => $user->nombre,
                '1' => $rol,
                '2' => date('d/m/Y H:i:s', strtotime($user->entrada)),
                '3' => date('d/m/Y H:i:s', strtotime($user->salida)),
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allClients':
        $sql = "SELECT * FROM clientes WHERE id <> 1";
        $query = querySimple($sql);
        $outpout = [];
        while ($client = mysqli_fetch_object($query)) {
            $estado = '';
            if ($client->estado == 1) {
                $estado = '<span class="badge badge-success">Activo<span>';
            } else {
                $estado = '<span class="badge badge-danger">Inactivo</span>';
            }
            $btnViewCuotas = '<a href="viewCuotas.php?nombrecli=' . $client->nombrecli . '" target="admin" class="btn btn-dark px-2 py-2"><i class="fa fa-eye"></i></a>';
            $btnEditar = '<a href="crear_clientes.php?id=' . $client->id . '" target="admin" class="btn btn-info px-2 py-2"><i class="fa fa-edit"></i></a>';
            $btnEliminar = '<a onclick="deleteClient(' . $client->id . ')" target="admin" class="btn btn-danger text-light px-2 py-2"><i class="fa fa-trash"></i></a>';

            $outpout[] = [
                '0' => $client->nombrecli,
                '1' => $client->cedula,
                '2' => empty($client->celular) ? '<span class="text-muted">No definido</span>' : $client->celular,
                '3' => '<a href="app/php_estado_cliente.php?id=' . $client->id . '">' . $estado . '</a>',
                '4' => empty($client->direc) ? '<span class="text-muted">No definido</span>': $client->direc,
                '5' => $btnViewCuotas . ' ' . $btnEditar . ' ' . $btnEliminar
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'allProviders':
        $sql = "SELECT * FROM proveedor WHERE id <> 1";
        $query = querySimple($sql);
        $outpout = [];
        while ($prov = mysqli_fetch_object($query)) {
            $estado = '';
            if ($prov->estado == 's') {
                $estado = '<span class="badge badge-success">Activo<span>';
            } else {
                $estado = '<span class="badge badge-danger">Inactivo</span>';
            }
            $btnEditar = '<a href="crear_proveedor.php?id=' . $prov->id . '" target="admin" class="btn btn-info px-2 py-2"><i class="fa fa-edit"></i></a>';
            $btnEliminar = '<a onclick="deleteProvider(' . $prov->id . ')" target="admin" class="btn btn-danger px-2 py-2 text-light"><i class="fa fa-trash"></i></a>';
            $outpout[] = [
                '0' => $prov->codigo != '' ? $prov->codigo  : '<span class="text-muted">No Definido</span>',
                '1' => $prov->empresa,
                '2' => $prov->nom,
                '3' => $prov->cel != '' ? $prov->cel : '<span class="text-muted">No Definido</span>',
                '4' => '<a href="app/php_estado_proveedor.php?id=' . $prov->id . '">' . $estado . '</a>',
                '5' => $btnEditar . ' ' . $btnEliminar
            ];
        }
        include_once '../helper/processAjax.php';
        echo json_encode($resultOutpout);
        break;
    case 'cargarFoto':
        $foto = $_GET['foto'];
        $sql = "SELECT * FROM producto WHERE nom='$foto'";
        $product = queryRow($sql);
        if( $product['foto'] !== '' )
        {
            $resp =  $product['foto'];
        } else {
            $resp = 'vacio';
        }
        echo $resp;
    break;
    case 'cargarFotoAjax':
        $term  = $_GET['term'];
        $sql = "SELECT * FROM producto WHERE nom LIKE '%".$term."%' AND estado='s'";
        $tags = querySimple( $sql );
        $outpout = array();
        foreach( $tags as $row ) {
            if( $row['foto'] !== '' ) {
                $fotoSrc = $row['foto'];
            } else {
                $fotoSrc = '../assets/images/lightbox/default.png';
            }
            $tmp = [];
            $tmp['value'] = $row['nom'];
            $tmp['label'] = '<div><img src="'.$fotoSrc.'" class="img-fluid rounded" >&nbsp;<h5 class="d-inline">'.$row['nom'].'</h5></div>';
            $outpout[] = $tmp;
        }
        echo json_encode($outpout);

    break;
}