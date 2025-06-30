<?php
session_start();
include_once("conexion.php");
include_once("encabezado.php");
$uuid = $_GET['uuid'] ?? '';
$total = $_GET['total'] ?? '';
$status = $_GET['status'] ?? '';
if ($status == 1 && $uuid && $total) {
  $res = $conn->query("SELECT pedidos_encabezado_id, nombre FROM pedidos_encabezado WHERE sesion_id = '$uuid' AND total = $total");
  if ($res->num_rows > 0) {
    $pedido = $res->fetch_assoc();
    $id = $pedido['pedidos_encabezado_id'];
    $nombre = htmlspecialchars($pedido['nombre']);
    $conn->query("UPDATE pedidos_encabezado SET pagado = 1, fecha_pago = NOW() WHERE pedidos_encabezado_id = $id");
    echo '<div class="container py-4">';
    echo '<h2>Pedido realizado con éxito</h2>';
    echo "<p>$nombre, tu pedido llegará pronto.</p>";
    echo '</div>';
  } else {
    echo '<div class="container py-4"><h2>Error al verificar el pedido</h2></div>';
  }
} else {
  echo '<div class="container py-4"><h2>Parámetros inválidos</h2></div>';
}
include_once("pie.php");
?>