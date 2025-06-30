<?php
session_start();
include_once("conexion.php");
include_once("encabezado.php");
?>
<link rel="stylesheet" href="css/estilos_carrito.css">
<div class="container carrito-container">
  <h1>Carrito de Compras</h1>
  <?php if (!empty($_SESSION['carrito'])): ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio Unitario</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $id => $item):
          $subtotal = $item['precio'] * $item['cantidad'];
          $total += $subtotal;
        ?>
          <tr>
            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
            <td>$<?php echo number_format($item['precio'], 2); ?></td>
            <td><?php echo $item['cantidad']; ?></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-end">
      <h4>Total: $<?php echo number_format($total, 2); ?></h4>
      <a href="preparacion-pago1.php" class="btn btn-success">Preparar pago</a>
    </div>
  <?php else: ?>
    <p>No hay productos en el carrito.</p>
  <?php endif; ?>
</div>
<?php include_once("pie.php"); ?>