<?php
include("conexion.php");
$resultado = $conn->query("SELECT * FROM usuarios ORDER BY usuario_id ASC");
include_once("_encabezado.php");
?>

<h2>Lista de Usuarios</h2>
<a href="_usuario_nuevo.php">Agregar nuevo usuario</a>
<table>
    <tr><th class="celda">ID</th><th class="celda">Nombre</th><th class="celda">Login</th><th class="celda">Acciones</th></tr>
    <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td class="celda"><?= $row['usuario_id'] ?></td>
            <td class="celda"><?= htmlspecialchars($row['nombre']) ?></td>
            <td class="celda"><?= htmlspecialchars($row['login']) ?></td>
            <td class="celda">
                <a href="_usuario_editar.php?id=<?= $row['usuario_id'] ?>">Editar</a> |
                <a href="_usuario_eliminar.php?id=<?= $row['usuario_id'] ?>" onclick="return confirm('¿Eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include_once("_pie.php"); ?>