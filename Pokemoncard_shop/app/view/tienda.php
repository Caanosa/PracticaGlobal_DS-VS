<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página tienda</title>
    <link rel="stylesheet" href="/app/view/tienda.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        session_start();
    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.php">Inicio</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null?"/app/view/deseados.php":"/app/view/login.php"?>">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null ? "/app/view/cuenta.php" : "/app/view/login.php" ?>"><?php echo $usuarioController->getUSesion() != null ? $usuarioController->getUSesion()[1] : "Cuenta" ?></a></li>
            </ul>
        </nav>
    </header>
    <?php
    require_once "../../app/controller/ProductoController.php";
    $productoController = new ProductoController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $expansion = $_POST["expansion"];
        $tiposNombre = ["Pack", "Sobre", "Carta"];
        $tiposInt = [];
        $tipos = [];
        foreach ($tiposNombre as $tipo) {
            if (in_array($tipo, $_POST)) {
                array_push($tiposInt, 1);
                array_push($tipos, $tipo);
            } else {
                array_push($tiposInt, 0);
            }
        }
        $categoriasNombre = ["Comun", "Poco comun", "Rara", "Holo rara", "Rara inversa", "Rara ultra", "Full art", "Secreta", "Arcoiris", "Dorada"];
        $categoriasInt = [];
        $categorias = [];
        foreach ($categoriasNombre as $categoria) {
            if (in_array($categoria, $_POST)) {
                array_push($categoriasInt, 1);
                array_push($categorias, $categoria);
            } else {
                array_push($categoriasInt, 0);
            }
        }
        $idiomasSelect = $_POST["idioma"];
        $min = $_POST["min"];
        $max = $_POST["max"];

        $productos = $productoController->getAllProductosFiltered($expansion, $tipos, $categorias, $idiomasSelect, $min, $max);
    } else {
        $productos = $productoController->getAllProductos();
    }

    ?>
    <div class="cuerpo">
    <!-- onsubmit="manejarEnvio(event)" -->
    <form id="formulario" class="filter-container"  method="POST">
        <h3>Filtros</h3>
        <div class="filter-section">
            <label for="collectionType">Expansion:</label><br>
            <select id="collectionType" name="expansion">
                <option value="">Todas</option>
                <?php
                    require_once "../../app/controller/FiltroController.php";
                    $filtroController = new FiltroController();

                    $filtros = $filtroController->getAllFiltros();
                    foreach ($filtros as $filtro) {
                        echo "<option value='" . $filtro["filtro_id"] . "' " . (isset($expansion) && $expansion == $filtro["filtro_id"] ? 'selected' : '') . ">" . $filtro["nombre_filtro"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="filter-section filtro-tipo">
                <h4>Tipo</h4>
                <label><input type="checkbox" name="Pack" value="Pack" <?php echo isset($tiposInt) && $tiposInt[0] == 1 ? "checked" : "" ?>> Pack</label><br>
                <label><input type="checkbox" name="Sobres" value="Sobre" <?php echo isset($tiposInt) && $tiposInt[1] == 1 ? "checked" : "" ?>> Sobres</label><br>
                <label><input type="checkbox" name="Cartas" value="Carta" <?php echo isset($tiposInt) && $tiposInt[2] == 1 ? "checked" : "" ?>> Cartas</label><br>
            </div>
            <div class="filter-section filtro-categoria">

                <h4>Categorías</h4>
                <label><input type="checkbox" name="Comun" value="Comun" <?php echo isset($categoriasInt) && $categoriasInt[0] == 1 ? "checked" : "" ?>> Común</label><br>
                <label><input type="checkbox" name="Poco comun" value="Poco comun" <?php echo isset($categoriasInt) && $categoriasInt[1] == 1 ? "checked" : "" ?>> Poco común</label><br>
                <label><input type="checkbox" name="Rara" value="Rara" <?php echo isset($categoriasInt) && $categoriasInt[2] == 1 ? "checked" : "" ?>> Rara</label><br>
                <label><input type="checkbox" name="Holo rara" value="Holo rara" <?php echo isset($categoriasInt) && $categoriasInt[3] == 1 ? "checked" : "" ?>> Holo rara</label><br>
                <label><input type="checkbox" name="Rara inversa" value="Rara inversa" <?php echo isset($categoriasInt) && $categoriasInt[4] == 1 ? "checked" : "" ?>> Rara inversa</label><br>
                <label><input type="checkbox" name="Rara ultra" value="Rara ultra" <?php echo isset($categoriasInt) && $categoriasInt[5] == 1 ? "checked" : "" ?>> Rara ultra</label><br>
                <label><input type="checkbox" name="Full art" value="Full art" <?php echo isset($categoriasInt) && $categoriasInt[6] == 1 ? "checked" : "" ?>> Full art</label><br>
                <label><input type="checkbox" name="Secreta" value="Secreta" <?php echo isset($categoriasInt) && $categoriasInt[7] == 1 ? "checked" : "" ?>> Secreta</label><br>
                <label><input type="checkbox" name="Arcoiris" value="Arcoiris" <?php echo isset($categoriasInt) && $categoriasInt[8] == 1 ? "checked" : "" ?>> Arcoiris</label><br>
                <label><input type="checkbox" name="Dorada" value="Dorada" <?php echo isset($categoriasInt) && $categoriasInt[9] == 1 ? "checked" : "" ?>> Dorada</label><br>
            </div>
            <div class="filter-section">
                <label for="language">Idioma:</label><br>
                <select id="language" name="idioma">
                    <option value="">Todos</option>
                    <?php
                    require_once "../../app/controller/IdiomaController.php";
                    $idiomaController = new IdiomaController();

                    $idiomas = $idiomaController->getAllIdiomas();

                    foreach ($idiomas as $idioma) {
                        echo "<option value='" . $idioma["idioma_id"] . "' " . (isset($idiomasSelect) && $idiomasSelect == $idioma["idioma_id"] ? 'selected' : '') . ">" . $idioma["nombre_idioma"] . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="filter-section precio-range">
            <h3>Precio</h3>
            <label>min:</label>
            <br>
            <input type="number" id="minPrecio" name="min" min="0" max="1000" value="<?php echo isset($min) ?$min:0?>">
            <br>
            <label>max:</label>
            <br>
            <input type="number" id="maxPrecio" name="max" min="0" max="1000" value="<?php echo isset($max) ?$max:1000?>">
        </div>
        <div class="filter-buttons">
            <button onclick="clearFilters()">Borrar filtro</button>
            <button type="submit">Filtrar</button>
        </div>
    </form>

        <div class="galeria-container">
            <div class="search-bar-container">
                <input type="text" id="searchInput" placeholder="Buscar productos...">
                <button onclick="searchItems()">Buscar</button>
            </div>
            

            <section class="galeria" id="galeria"></section>
            <img id="cero_deseados_img" src="" alt="">
            <h1 id="cero_deseados_titulo"></h1>
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
            <a href="/app/view/avisoLegal.php">Aviso legal</a> |
            <a href="/app/view/privacidad.php">Política de privacidad</a> |
            <a href="/app/view/coockies.php">Política de Cookies</a> |
            <a href="/app/view/envios.php">Política de envíos</a> |
            <a href="/app/view/reembolso.php">Política de reembolso</a>
        </div>
    </footer>
    <script>
        const galeria = document.getElementById("galeria");
        const pageIndicator = document.getElementById("pageIndicator");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const cerodeseadosimg = document.getElementById("cero_deseados_img");
        const cerodeseadosh1 = document.getElementById("cero_deseados_titulo");

        const itemsPerPage = 12;
        let currentPage = 1;
        let searchResults = [];
        let isSearching = false;

        const items = <?php echo json_encode($productos) ?>;

        function renderPage(page) {
            galeria.innerHTML = "";
            const itemsToRender = isSearching ? searchResults : items;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentItems = itemsToRender.slice(start, end);
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

            pageIndicator.textContent = `Página ${page}`;
            prevBtn.disabled = page === 1;
            nextBtn.disabled = end >= itemsToRender.length;
        }

        function clearFilters() {
            document.getElementById("collectionType").value = "";
            document.querySelectorAll(".filter-section input[type='checkbox']").forEach(cb => cb.checked = false);
            document.getElementById("language").value = "";
            document.getElementById("minPrecio").value = 0;
            document.getElementById("maxPrecio").value = 1000;
            document.getElementById("searchInput").value = "";
            isSearching = false;
            searchResults = [];
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

        function searchItems() {
            const searchTerm = document.getElementById("searchInput").value.toLowerCase();
            searchResults = items.filter(item => item.nombre.toLowerCase().includes(searchTerm));
            isSearching = true;
            currentPage = 1;
            renderPage(currentPage);
        }

        function renderFilteredItems(filteredItems) {
            galeria.innerHTML = "";
            filteredItems.forEach(item => {
                const div = document.createElement("div");
                div.classList.add("galeria-item");
                div.textContent = item;
                galeria.appendChild(div);
            });
            pageIndicator.textContent = `Resultados para: "${document.getElementById("searchInput").value}"`;
            prevBtn.disabled = true;
            nextBtn.disabled = true;
        }


        renderPage(currentPage);
    </script>
</body>

</html>
