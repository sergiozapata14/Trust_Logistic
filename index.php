<?php include_once('encabezado.php'); ?>
    <!-- Contenido principal -->
    <main>
        <h1>Bienvenido a Trust logistic</h1>
        <div class="accordion" id="acordeonInfo">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                    ¿Quiénes somos?
                </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#acordeonInfo">
                    <div class="accordion-body">
                        Trust Logistic es una empresa especializada en la venta de refacciones para camiones, comprometida con mantener en movimiento a quienes mueven al país. Nuestro catálogo incluye desde componentes esenciales para el motor hasta sistemas de frenos, suspensión y partes eléctricas, siempre con la más alta calidad y al mejor precio. Nos enfocamos en brindar soluciones confiables para flotillas y operadores independientes, respaldando cada venta con atención personalizada y asesoría técnica.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                    ¿Por qué elegirnos?
                </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#acordeonInfo">
                    <div class="accordion-body">
                        Desde nuestros inicios, en Trust Logistic hemos trabajado con un objetivo claro: ser el aliado confiable del transporte pesado. Gracias a un equipo con amplia experiencia en el sector y una red de distribución eficiente, logramos entregar rápidamente lo que cada cliente necesita. La confianza, la rapidez y la calidad son los pilares que definen nuestro servicio día a día.
                    </div>
                </div>
            </div>
        </div>

    </main>
<?php include_once('pie.php'); ?>