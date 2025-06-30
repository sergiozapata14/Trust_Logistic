<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); //redireccion 
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla de Página Web</title>
    <style>
 	.celda {
  		padding: 10px;
        background-color: #eee;
	}	
	</style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Encabezado -->
    <header>
        <div class="logo">Zona Administrativa</div>
        <div><a href="logout.php">Cerrar sesión</a></div>
    </header>

    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="_pedidos.php">Pedidos</a></li>
            <li><a href="_productos.php">Productos</a></li>
            <li><a href="_usuarios.php">Usuarios</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main>