<?php
include("conexion.php");
$categorias = $conn->query("SELECT * FROM categorias");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ruta1 = $_POST['ruta_imagen1'];
    $ruta2 = $_POST['ruta_imagen2'];
    $ruta3 = $_POST['ruta_imagen3'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, ruta_imagen1, ruta_imagen2, ruta_imagen3, precio, categoria_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $nombre, $descripcion, $ruta1, $ruta2, $ruta3, $precio, $categoria_id);
    $stmt->execute();
    $stmt->close();

    header("Location: _productos.php");
    exit;
}

include_once("_encabezado.php");
?>

<h2>Agregar Producto</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <input type="text" name="descripcion" required><br>
    Ruta imagen 1: <input type="text" name="ruta_imagen1"><br>
    Ruta imagen 2: <input type="text" name="ruta_imagen2"><br>
    Ruta imagen 3: <input type="text" name="ruta_imagen3"><br>
    Precio: <input type="number" step="0.01" name="precio" required><br>
    Categoría:
    <select name="categoria_id" required>
        <option value="">Selecciona una categoría</option>
        <?php while ($cat = $categorias->fetch_assoc()) { ?>
            <option value="<?= $cat['categoria_id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php } ?>
    </select><br><br>
    <input type="submit" value="Guardar">
</form>
<?php include_once("_pie.php"); ?>