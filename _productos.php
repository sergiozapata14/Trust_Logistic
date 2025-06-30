<?php
include("conexion.php");
$resultado = $conn->query("SELECT p.*, c.nombre AS categoria FROM productos p INNER JOIN categorias c ON p.categoria_id = c.categoria_id ORDER BY p.producto_id ASC");

include_once("_encabezado.php");
?>

<h2>Lista de Productos</h2>
<a href="_producto_nuevo.php">Agregar nuevo producto</a>
<table>
    <tr>
        <th class="celda">ID</th><th class="celda">Nombre</th><th class="celda">Descripción</th><th class="celda">Precio</th><th class="celda">Categoría</th><th class="celda">Acciones</th>
    </tr>
    <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td class="celda"><?= $row['producto_id'] ?></td>
            <td class="celda"><?= htmlspecialchars($row['nombre']) ?></td>
            <td class="celda"><?= htmlspecialchars($row['descripcion']) ?></td>
            <td class="celda">$<?= number_format($row['precio'], 2) ?></td>
            <td class="celda"><?= htmlspecialchars($row['categoria']) ?></td>
            <td class="celda">
                <a href="_producto_editar.php?id=<?= $row['producto_id'] ?>">Editar</a> |
                <a href="_producto_eliminar.php?id=<?= $row['producto_id'] ?>" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include_once("_pie.php"); ?>