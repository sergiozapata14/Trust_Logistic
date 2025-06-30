<?php
session_start();
include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $pass = sha1($_POST['pass']); // Cifrado simple (considera usar bcrypt en el futuro)

    $stmt = $conn->prepare("SELECT usuario_id, nombre FROM usuarios WHERE login=? AND pass=?");
    $stmt->bind_param("ss", $login, $pass);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($usuario_id, $nombre);
        $stmt->fetch();
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['nombre'] = $nombre;

        header("Location: _inicio.php");
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }

    $stmt->close();
    $conn->close();
}

include_once("encabezado.php");
?>
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post" action="login.php">
            Usuario: <br><input type="text" name="login" required> <br>
            Contraseña: <br><input type="password" name="pass" required> <br><br>
            <input type="submit" value="Entrar">
        </form>
<?php 
include_once("pie.php");
?>