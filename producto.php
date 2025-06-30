<?php
include_once("conexion.php");
include_once("encabezado.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Producto no válido.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT nombre, descripcion, precio, ruta_imagen1, ruta_imagen2, ruta_imagen3 
        FROM productos WHERE producto_id = $id";
$res = $conn->query($sql);

if ($res->num_rows == 0) {
    echo "Producto no encontrado.";
    exit;
}

$producto = $res->fetch_assoc();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">




<div class="container py-5">
  <div class="row">
    <!-- Carrusel de imágenes -->
    <div class="col-md-6">
      <div id="carouselProducto" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          $imagenes = [
              $producto['ruta_imagen1'],
              $producto['ruta_imagen2'],
              $producto['ruta_imagen3']
          ];
          $hayImagen = false;
          foreach ($imagenes as $index => $ruta) {
              if ($ruta) {
                  $active = $hayImagen ? '' : 'active';
                  $hayImagen = true;
                  echo "
                  <div class='carousel-item $active'>
                    <img src='" . htmlspecialchars($ruta) . "' class='d-block w-100' alt='Imagen del producto'>
                  </div>";
              }
          }
          if (!$hayImagen) {
              echo "
              <div class='carousel-item active'>
                <img src='img/default.jpg' class='d-block w-100' alt='Imagen por defecto'>
              </div>";
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducto" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProducto" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
    </div>

    <!-- Detalle del producto -->
    <div class="col-md-6">
        <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
        <p class="fs-4 text-danger fw-semibold">$<?php echo number_format($producto['precio'], 2); ?></p>
        <p class="text-muted"><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
        <form method="POST" action="agregar_al_carrito.php">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <label for="cantidad" class="col-form-label">Cantidad:</label>
                </div>
                <div class="col-auto">
                    <input type="number" id="cantidad" name="cantidad" value="1" min="1" class="form-control">
                </div>
                <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                <div class="col-auto">
                    <button type="submit" class="btn btn-warning btn-lg">Agregar al carrito</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
    include_once("pie.php");
?>