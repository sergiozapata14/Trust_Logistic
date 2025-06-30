<!DOCTYPE html>
<html>
<head>
  <title>Simulador Pagos</title>
  <style>
    body { font-family: Arial; text-align: center; padding: 2rem; }
    .container { max-width: 400px; margin: auto; padding: 2rem; border: 1px solid #ccc; border-radius: 10px; }
    button { background-color: #0070ba; color: white; padding: 0.5rem 2rem; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1rem; }
  </style>
</head>
<body>
<div class="container">
  <h1>Simulador Pagos</h1>
  <p>Total a pagar: $<?php echo $_GET['total']; ?></p>
  <form method="GET" action="pedido_exitoso.php">
    <input type="hidden" name="uuid" value="<?php echo $_GET['uuid']; ?>">
    <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">
    <input type="hidden" name="status" value="1">
    <button type="submit">Pagar</button>
  </form>
</div>
</body>
</html>