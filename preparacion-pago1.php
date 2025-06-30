<?php
session_start();
include_once("conexion.php");
include_once("encabezado.php");
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
  $total += $item['precio'] * $item['cantidad'];
}
?>
<form method="POST" action="preparacion-pago2.php" class="container py-4">
  <h2>Datos del Cliente</h2>
  <div class="row g-3">
    <div class="col-md-6"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
    <div class="col-md-6"><input type="text" name="correo" class="form-control" placeholder="Correo" required></div>
    <div class="col-md-12"><input type="text" name="direccion" class="form-control" placeholder="Dirección" required></div>
    <div class="col-md-6"><input type="text" name="colonia" class="form-control" placeholder="Colonia" required></div>
    <div class="col-md-6"><input type="text" name="ciudad" class="form-control" placeholder="Ciudad" required></div>
    <div class="col-md-6"><input type="text" name="estado" class="form-control" placeholder="Estado" required></div>
    <div class="col-md-6"><input type="text" name="pais" class="form-control" placeholder="País" required></div>
  </div>
  <hr>
  <h3>Resumen del Carrito</h3>
  <ul class="list-group mb-3">
    <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
      <li class="list-group-item d-flex justify-content-between">
        <span><?php echo htmlspecialchars($item['nombre']); ?> (x<?php echo $item['cantidad']; ?>)</span>
        <span>$<?php echo number_format($item['precio'], 2); ?></span>
        <input type="hidden" name="productos[<?php echo $id; ?>][cantidad]" value="<?php echo $item['cantidad']; ?>">
        <input type="hidden" name="productos[<?php echo $id; ?>][precio]" value="<?php echo $item['precio']; ?>">
      </li>
    <?php endforeach; ?>
  </ul>
  <h4>Total a pagar: $<?php echo number_format($total, 2); ?></h4>
  <input type="hidden" name="total" value="<?php echo $total; ?>">
  <button type="submit" class="btn btn-primary">Siguiente</button>
</form>
<?php include_once("pie.php"); ?>