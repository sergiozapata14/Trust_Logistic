<?php
include("conexion.php");
$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE usuario_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: _usuarios.php");
exit;
?>