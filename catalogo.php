<?php include_once('encabezado.php'); ?>
<?php include_once('conexion.php'); ?>
    <!-- Contenido principal -->
    <main>
        <h1>Productos</h1>
        <!-- SELECT de categorías -->
        <div>
            Categoría:
            <form id="filtroForm" method="GET" action="catalogo.php">
                <select name="categoria_id" id="selCategoria" onchange="document.getElementById('filtroForm').submit();">
                    <option value="">-- Todas --</option>
                    <?php
                        $sqlCat = "SELECT categoria_id, nombre FROM categorias";
                        $resCat = $conn->query($sqlCat);
                        while($cat=$resCat->fetch_assoc())
                        {
                            $selected=(isset($_GET['categoria_id']) && $_GET['categoria_id']==$cat['categoria_id']) ? 'selected' : '';
                            echo "<option value='{$cat['categoria_id']}' $selected>{$cat['nombre']}</option>";
                        }
                    ?>
                </select>
            </form>
        </div>
        <!-- Catálogo de productos -->
        <div class="catalogo">
            <!-- Filtro por categoría si viene por GET -->
            <?php
                $where="";
                if(isset($_GET['categoria_id']) && is_numeric($_GET['categoria_id']))
                {
                    $categoria_id=intval($_GET['categoria_id']);
                    $where="WHERE categoria_id = $categoria_id";
                }
                $sqlProd="SELECT producto_id, nombre, precio, ruta_imagen1 FROM productos $where";
                //echo "<br>$sqlProd<br>";
                $resProd=$conn->query($sqlProd);
                while($prod=$resProd->fetch_assoc()) //Obtén registro que sigue
                {
                    $img=$prod['ruta_imagen1'] ? htmlspecialchars($prod['ruta_imagen1']) : "img/default.jpg";
                    $nombre=htmlspecialchars($prod['nombre']);
                    $precio=number_format($prod['precio'], 2);
                    $id=$prod['producto_id'];
                    echo
                    "<div class='producto'>
                        <a href='producto.php?id=$id'>
                            <img src='$img' alt='$nombre'>
                        </a>
                        <h3>
                            $nombre
                        </h3>
                        <p>
                            $precio
                        </p>
                    </div>";
                }
            ?>
        </div>
    </main>
<?php include_once('pie.php'); ?>