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
        <img id="cero_deseados_img" src="" alt="">
        <h1 id="cero_deseados_titulo"></h1>
        <section class="galeria" id="galeria">
            
        </section>
        <div class="pagination">
            <button onclick="prevPage()" id="prevBtn" disabled>&laquo; Anterior</button>
            <span id="pageIndicator">Página 1</span>
            <button onclick="nextPage()" id="nextBtn">Siguiente &raquo;</button>
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
        const cerodeseadosimg = document.getElementById("cero_deseados_img");
        const cerodeseadosh1 = document.getElementById("cero_deseados_titulo");
        const itemsPerPage = 8;
        let currentPage = 1;
        isSearching = false;
        searchResults = [];
        items = <?= json_encode($productoController->reuperarDseseadsoSesionConjunto()) ?>;

        function renderPage(page) {
            galeria.innerHTML = "";
            const itemsToRender = isSearching ? searchResults : items;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentItems = itemsToRender.slice(start, end);
            if(items.length == 0){
                cerodeseadosimg.src = "/app/view/imagenes/lista deseados2.png";
                cerodeseadosh1.textContent = "Aun no tienes nada en lista de deseados";
            }else{
                if(itemsToRender.length == 0){
                    cerodeseadosimg.src = "/app/view/imagenes/fallo busqueda.png";
                    cerodeseadosh1.textContent = "No se an encotrado resultados";
                }else{
                    cerodeseadosimg.src = "";
                    cerodeseadosh1.textContent = "";
                    currentItems.forEach(item => {
                        const div1 = document.createElement("div");
                        div1.classList.add("galeria-item");
                        galeria.appendChild(div1);
                        const div2 = document.createElement("div");
                        div1.appendChild(div2);
                        const imagen = document.createElement("img");
                        imagen.src = item.imagen_url;
                        imagen.classList.add("imagen-galeria");
                        div2.appendChild(imagen);
                        const div3 = document.createElement("div");
                        div3.classList.add("info-galeria-item");
                        div1.appendChild(div3);
                        const div4 = document.createElement("div");
                        div4.classList.add("nombre_producto");
                        div4.textContent = item['nombre'];
                        div3.appendChild(div4);
                        const div5 = document.createElement("div");
                        div5.classList.add("precio");
                        div5.textContent = item['precio'];
                        div3.appendChild(div5);
                    });
                }
            }
            prevBtn.disabled = page === 1;
            nextBtn.disabled = end >= itemsToRender.length;
        }

        function searchItems() {
            const searchTerm = document.getElementById("searchInput").value.toLowerCase();
            searchResults = items.filter(item => item.nombre.toLowerCase().includes(searchTerm));
            isSearching = true;
            currentPage = 1;
            renderPage(currentPage);
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
        renderPage(1);
    </script>
</body>
</html>