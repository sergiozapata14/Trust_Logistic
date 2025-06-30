<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $login = $_POST['login'];
    $pass = sha1($_POST['pass']);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, login, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $login, $pass);
    $stmt->execute();
    $stmt->close();

    header("Location: _usuarios.php");
    exit;
}

include_once("_encabezado.php");
?>
<h2>Agregar Usuario</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Login: <input type="text" name="login" required><br>
    Contraseña: <input type="password" name="pass" required><br><br>
    <input type="submit" value="Guardar">
</form>
<?php include_once("_pie.php"); ?>