<?php
require_once '../app/Conexion.php';
class Sale
{
    public function getCart($data)
    {
        $sql = "SELECT * FROM products WHERE codigo='" . $data['codigo'] . "'";
        return queryRow($sql);
    }
    public function saveSale($data)
    {
        $sql = "INSERT INTO sales (customer_id, user_id, total, importe) 
        VALUES ('" . $data['customer_id'] . "','" . $data['user_id'] . "','" . $data['total'] . "','" . $data['importe'] . "')";
        $idSaleNew = queryID($sql);
        $sw = true;
        for ($i = 0; $i < count($data['product_id']); $i++) {
            $sqlPrepare = "INSERT INTO detail_sale (sale_id, product_id, cantidad, precio_venta) 
            VALUES ('" . $idSaleNew . "','" . $data['product_id'][$i] . "','" . $data['cantidad'][$i] . "','" . $data['precio_venta'][$i] . "')";
            querySimple($sqlPrepare) or $sw = false;
            $this->stockDiscount($data['product_id'][$i], $data['cantidad'][$i]);
        }
        return $sw;
    }
    public function stockDiscount($idproducto, $stockDiscount)
    {
        $sqlFind = "SELECT stock FROM products WHERE id='$idproducto'";
        $response = querySimple($sqlFind);
        $stockActual = 0;
        while ($reg = $response->fetch_array()) {
            $stockActual = $reg[0];
        }
        $stockActual -= $stockDiscount;
        $sqlUpdate = "UPDATE products SET stock='$stockActual' WHERE id='$idproducto'";
        return querySimple($sqlUpdate);
    }
    public function stockRestore($idproducto, $stockDiscount)
    {
        $sqlFind = "SELECT stock FROM products WHERE id='$idproducto'";
        $response = querySimple($sqlFind);
        $stockActual = 0;
        while ($reg = $response->fetch_array()) {
            $stockActual = $reg[0];
        }
        $stockActual += $stockDiscount;
        $sqlUpdate = "UPDATE products SET stock='$stockActual' WHERE id='$idproducto'";
        return querySimple($sqlUpdate);
    }
}
