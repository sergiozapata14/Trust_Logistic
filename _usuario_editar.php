<?php
include("conexion.php");
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT nombre, login FROM usuarios WHERE usuario_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $login);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoNombre = $_POST['nombre'];
    $nuevoLogin = $_POST['login'];
    $nuevoPass = $_POST['pass'];

    if (!empty($nuevoPass)) {
        $nuevoPass = sha1($nuevoPass);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, login=?, pass=? WHERE usuario_id=?");
        $stmt->bind_param("sssi", $nuevoNombre, $nuevoLogin, $nuevoPass, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, login=? WHERE usuario_id=?");
        $stmt->bind_param("ssi", $nuevoNombre, $nuevoLogin, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: _usuarios.php");
    exit;
}

include_once("_encabezado.php");
?>
<h2>Editar Usuario</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required><br>
    Login: <input type="text" name="login" value="<?= htmlspecialchars($login) ?>" required><br>
    Nueva Contraseña: <input type="password" name="pass"> <small>(déjalo en blanco para no cambiarla)</small><br><br>
    <input type="submit" value="Actualizar">
</form>
<?php 
include_once("_pie.php");
?>