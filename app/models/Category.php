<?php
require_once '../app/Conexion.php';
class Category
{
    public function getCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return querySimple($sql);
    }
    public function getCategory($data)
    {
        $sql = "SELECT * FROM categories WHERE id='" . $data['id'] . "'";
        return queryRow($sql);
    }
    public function addCategory($data)
    {
        $sql = "INSERT INTO categories (nombre) VALUES ('" . $data['nombre'] . "')";
        return querySimple($sql);
    }
    public function updateCategory($data)
    {
        $sql = "UPDATE categories SET nombre='" . $data['nombre'] . "' WHERE id='" . $data['id'] . "'";
        return querySimple($sql);
    }
    public function deleteCategory($data)
    {
        $sql = "DELETE FROM categories WHERE id='" . $data['id'] . "'";
        return querySimple($sql);
    }
}
