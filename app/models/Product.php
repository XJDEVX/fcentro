<?php
require_once '../app/Conexion.php';
class Product
{
    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        return querySimple($sql);
    }
}
