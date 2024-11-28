<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deseados</title>
    <link rel="stylesheet" href="deseados.css">
</head>
<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        require_once "../../app/controller/ProductoController.php";
        $usuarioController = new UsuarioController();
        $productoController = new ProductoController();

    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.php">Inicio</a></li>
                <li><a href="/app/view/deseados.php">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php session_start();  echo $usuarioController->getUSesion() != null?"/app/view/cuenta.php":"/app/view/login.php"?>"><?php echo $usuarioController->getUSesion() != null?$usuarioController->getUSesion()[1]:"Cuenta"?></a></li>
            </ul>
        </nav>
    </header>

    <div class="content-container">
        <div class="search-bar-container">
            <input type="text" id="searchInput" placeholder="Buscar productos...">
            <button onclick="searchItems()">Buscar</button>
            <button>Guardar</button>
        </div>

        <div id="deseados" class="content"></div>

        <section class="galeria" id="galeria"></section>
        <div class="pagination">
            <button onclick="prevPage()" id="prevBtn" disabled>&laquo; Anterior</button>
            <span id="pageIndicator">Página 1</span>
            <button onclick="nextPage()" id="nextBtn">Siguiente &raquo;</button>
        </div>
    </div>
    </div>

    <footer class="footer">
        <div class="copyright">
            <a href="">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="avisoLegal.php">Aviso legal</a> |
            <a href="privacidad.php">Política de privacidad</a> |
            <a href="coockies.php">Política de Cookies</a> |
            <a href="envios.php">Política de envíos</a> |
            <a href="reembolso.php">Política de reembolso</a>
        </div>
    </footer>

    <script>
        const galeria = document.getElementById("deseados");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const itemsPerPage = 8;
        let currentPage = 1;
        items = <?= json_encode($productoController->reuperarDseseadsoSesionConjunto()) ?>;

        function renderPage(page) {
            galeria.innerHTML = "";
            const itemsToRender = items;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentItems = itemsToRender.slice(start, end);

            currentItems.forEach(item => {
                const div = document.createElement("div");
                div.classList.add("box");
                const imagen = document.createElement("p");
                imagen.textContent = item["nombre"];
                galeria.appendChild(div);
                div.appendChild(imagen);
            });

            prevBtn.disabled = page === 1;
            nextBtn.disabled = end >= itemsToRender.length;
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
            }
        }

        function nextPage() {
            if (currentPage * itemsPerPage < items.length) {
                currentPage++;
                renderPage(currentPage);
            }
        }
        function pestania(tipo) {
            switch (tipo) {
                case "deseados":
                    items = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
                    break;
            }
            renderPage(1);
        }
        renderPage(1);
    </script>
</body>
</html>