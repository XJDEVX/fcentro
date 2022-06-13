<?php
require_once '../app/Globals.php';
require_once '../app/Conexion.php';
class Customer
{
    public function getCustomers()
    {
        $sql = "SELECT * FROM customers";
        return querySimple($sql);
    }
}
