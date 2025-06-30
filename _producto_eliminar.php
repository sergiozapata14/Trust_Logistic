<?php
include("conexion.php");
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM productos WHERE producto_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: _productos.php");
exit;
?>