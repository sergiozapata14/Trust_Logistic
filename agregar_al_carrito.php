<?php
session_start();
if (!isset($_SESSION['sesion_id'])) {
  // crea una sesión donde se guardarán los productos:
  $_SESSION['sesion_id'] = substr(bin2hex(random_bytes(16)), 0, 32);
}
include_once("conexion.php");
// Si algo no está bien, regresa a catalogo.php
if (!isset($_POST['producto_id']) || !is_numeric($_POST['producto_id']) || !isset($_POST['cantidad'])) {
  header("Location: catalogo.php");
  exit;
}
$producto_id = intval($_POST['producto_id']);
$cantidad = max(1, intval($_POST['cantidad']));
$sql = "SELECT producto_id, nombre, precio FROM productos WHERE producto_id = $producto_id";
$res = $conn->query($sql);
if ($res->num_rows == 0) {
  header("Location: catalogo.php");
  exit;
}
// Si el producto a agregar al carrito es válido, entonces lo agrega al arrego asociativo de $_SESSION
$producto = $res->fetch_assoc();
if (!isset($_SESSION['carrito'])) {
  $_SESSION['carrito'] = [];
}
if (isset($_SESSION['carrito'][$producto_id])) {
  $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
} else {
  $_SESSION['carrito'][$producto_id] = [
    'nombre' => $producto['nombre'],
    'precio' => $producto['precio'],
    'cantidad' => $cantidad
  ];
}
// Redirección hacia el carrito de compras
header("Location: carrito.php");
exit;
?>