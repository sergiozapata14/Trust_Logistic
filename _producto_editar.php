<?php
include("conexion.php");
$id = $_GET['id'];
$categorias = $conn->query("SELECT * FROM categorias");

$stmt = $conn->prepare("SELECT * FROM productos WHERE producto_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ruta1 = $_POST['ruta_imagen1'];
    $ruta2 = $_POST['ruta_imagen2'];
    $ruta3 = $_POST['ruta_imagen3'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id'];

    $stmt = $conn->prepare("UPDATE productos SET nombre=?, descripcion=?, ruta_imagen1=?, ruta_imagen2=?, ruta_imagen3=?, precio=?, categoria_id=? WHERE producto_id=?");
    $stmt->bind_param("ssssssii", $nombre, $descripcion, $ruta1, $ruta2, $ruta3, $precio, $categoria_id, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: _productos.php");
    exit;
}

include_once("_encabezado.php");
?>
<h2>Editar Producto</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br>
    Descripción: <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required><br>
    Ruta imagen 1: <input type="text" name="ruta_imagen1" value="<?= $producto['ruta_imagen1'] ?>"><br>
    Ruta imagen 2: <input type="text" name="ruta_imagen2" value="<?= $producto['ruta_imagen2'] ?>"><br>
    Ruta imagen 3: <input type="text" name="ruta_imagen3" value="<?= $producto['ruta_imagen3'] ?>"><br>
    Precio: <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br>
    Categoría:
    <select name="categoria_id" required>
        <?php while ($cat = $categorias->fetch_assoc()) { ?>
            <option value="<?= $cat['categoria_id'] ?>" <?= ($cat['categoria_id'] == $producto['categoria_id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php } ?>
    </select><br><br>
    <input type="submit" value="Actualizar">
</form>
<?php include_once("_pie.php"); ?>