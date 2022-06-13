<?php
require __DIR__ . '/../ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscoposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$nombre_impresora ="HP DeskJet 2600 series";
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->text("hola mundo");
$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();
?>