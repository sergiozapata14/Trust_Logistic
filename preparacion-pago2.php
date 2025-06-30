<?php
session_start();
include_once("conexion.php");
include_once("encabezado.php");
$uuid = $_SESSION['sesion_id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$colonia = $_POST['colonia'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$total = $_POST['total'];
$productos = $_POST['productos'];
$subtotal = $total;
$conn->query("INSERT INTO pedidos_encabezado (nombre, direccion, colonia, ciudad, estado, pais, correo, subtotal, iva, total, sesion_id) 
              VALUES ('$nombre', '$direccion', '$colonia', '$ciudad', '$estado', '$pais', '$correo', $subtotal, 0, $total, '$uuid')");
$pedido_id = $conn->insert_id;
foreach ($productos as $producto_id => $data) {
  $cant = intval($data['cantidad']);
  $precio = floatval($data['precio']);
  $precio_total = $cant * $precio;
  $conn->query("INSERT INTO pedidos_detalle (pedidos_encabezado_id, articulo_id, cantidad, precio_unitario, precio_total) 
                VALUES ($pedido_id, $producto_id, $cant, $precio, $precio_total)");
}
?>
<div class="container py-4">
  <h2>Resumen de Pedido</h2>
  <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
  <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
  <p><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion . ", " . $colonia . ", " . $ciudad . ", " . $estado . ", " . $pais); ?></p>
  <hr>
  <h3>Detalle de artículos</h3>
  <ul class="list-group mb-3">
    <?php foreach ($productos as $id => $data): ?>
      <li class="list-group-item d-flex justify-content-between">
        <span>Producto ID: <?php echo $id; ?> (x<?php echo $data['cantidad']; ?>)</span>
        <span>$<?php echo number_format($data['precio'], 2); ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
  <h4>Total: $<?php echo number_format($total, 2); ?></h4>
  <a href="simulador.php?uuid=<?php echo $uuid; ?>&total=<?php echo $total; ?>" class="btn btn-success">Pagar con Simulador PayPal</a>
</div>
<?php include_once("pie.php"); ?>