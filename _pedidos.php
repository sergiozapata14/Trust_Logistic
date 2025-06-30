<?php
include("conexion.php");

// 1. Obtener todos los pedidos (encabezado)
$encabezados = $conn->query("SELECT * FROM pedidos_encabezado ORDER BY fecha DESC");

// 2. Verificar si se seleccionó un pedido
$detalle = null;
$pedidoSeleccionado = null;
if (isset($_GET['pedido_id'])) {
    $pedido_id = intval($_GET['pedido_id']);

    // Obtener datos del encabezado seleccionado
    $stmt = $conn->prepare("SELECT * FROM pedidos_encabezado WHERE pedidos_encabezado_id = ?");
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    $pedidoSeleccionado = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Obtener detalles del pedido
    $stmt = $conn->prepare("SELECT d.*, p.nombre FROM pedidos_detalle d
                            INNER JOIN productos p ON d.articulo_id = p.producto_id
                            WHERE d.pedidos_encabezado_id = ?");
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    $detalle = $stmt->get_result();
    $stmt->close();
}

include_once("_encabezado.php");
?>


<h2>Lista de Pedidos</h2>
<table>
    <tr>
        <th class="celda">Fecha</th><th class="celda">Nombre</th><th class="celda">Correo</th><th class="celda">Total</th><th class="celda">Pagado</th><th class="celda">Acción</th>
    </tr>
    <?php while ($row = $encabezados->fetch_assoc()) { ?>
        <tr <?= (isset($pedido_id) && $row['pedidos_encabezado_id'] == $pedido_id) ? 'style="font-weight:bold"' : '' ?>>
            <td class="celda"><?= $row['fecha'] ?></td>
            <td class="celda"><?= htmlspecialchars($row['nombre']) ?></td>
            <td class="celda"><?= htmlspecialchars($row['correo']) ?></td>
            <td class="celda">$<?= number_format($row['total'], 2) ?></td>
            <td class="celda"><?= $row['pagado'] ? 'Sí' : 'No' ?></td>
            <td class="celda"><a class="detalle_pedido" href="_pedidos.php?pedido_id=<?= $row['pedidos_encabezado_id'] ?>">Ver detalle</a></td>
        </tr>
    <?php } ?>
</table>

<?php if ($pedidoSeleccionado): ?>
    <br><br>
    <h3>Detalle del pedido #<?= $pedidoSeleccionado['pedidos_encabezado_id'] ?></h3>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($pedidoSeleccionado['nombre']) ?><br>
       <strong>Dirección:</strong> <?= htmlspecialchars($pedidoSeleccionado['direccion']) ?>, <?= htmlspecialchars($pedidoSeleccionado['colonia']) ?>, <?= htmlspecialchars($pedidoSeleccionado['ciudad']) ?>, <?= htmlspecialchars($pedidoSeleccionado['estado']) ?>, <?= htmlspecialchars($pedidoSeleccionado['pais']) ?><br>
       <strong>Correo:</strong> <?= htmlspecialchars($pedidoSeleccionado['correo']) ?><br>
       <strong>Total:</strong> $<?= number_format($pedidoSeleccionado['total'], 2) ?><br>
       <strong>Pagado:</strong> <?= $pedidoSeleccionado['pagado'] ? 'Sí' : 'No' ?><br>
       <?php if ($pedidoSeleccionado['fecha_pago']) { echo '<strong>Fecha de pago:</strong> ' . $pedidoSeleccionado['fecha_pago']; } ?>
    </p>

    <table border="1" cellpadding="5">
        <tr>
            <th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th>
        </tr>
        <?php while ($articulo = $detalle->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($articulo['nombre']) ?></td>
                <td><?= $articulo['cantidad'] ?></td>
                <td>$<?= number_format($articulo['precio_unitario'], 2) ?></td>
                <td>$<?= number_format($articulo['precio_total'], 2) ?></td>
            </tr>
        <?php } ?>
    </table>
<?php endif; 

include_once("_pie.php"); 
?>