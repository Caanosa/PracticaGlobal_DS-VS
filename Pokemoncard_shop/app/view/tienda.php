<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página tienda</title>
    <link rel="stylesheet" href="tienda.css">
</head>

<body>
    <header>
        <img class="img-logo" src="imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="inicio.html">Inicio</a></li>
                <li><a href="#deseados">Deseados</a></li>
                <li><a href="#tienda">Tienda</a></li>
                <li><a href="#publicar">Publicar</a></li>
                <li><a href="login.php">Cuenta</a></li>
            </ul>
        </nav>
    </header>

    <div class="filter-container">
        <h3>Filtros</h3>
        <div class="filter-section">
            <label for="collectionType">Exnsion:</label><br>
            <select id="collectionType">
                <option value="">Todas</option>
                <?php
                    require "../../app/controller/FiltroController.php";
                    $filtroController = new FiltroController();

                    $filtros = $filtroController->getAllFiltros();

                    foreach ($filtros as $filtro) {
                        echo "<option value='".$filtro["filtro_id"]."'>".$filtro["nombre_filtro"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="filter-section">
            <label><input type="checkbox"> Pack</label><br>
            <label><input type="checkbox"> Sobres</label><br>
            <label><input type="checkbox"> Cartas</label><br>
        </div>
        <div class="filter-section">

            <h4>Categorías</h4>
            <label><input type="checkbox"> Común</label><br>
            <label><input type="checkbox"> Poco común</label><br>
            <label><input type="checkbox"> Rara</label><br>
            <label><input type="checkbox"> Holo rara</label><br>
            <label><input type="checkbox"> Rara inversa</label><br>
            <label><input type="checkbox"> Rara ultra</label><br>
            <label><input type="checkbox"> Full art</label><br>
            <label><input type="checkbox"> Secreta</label><br>
            <label><input type="checkbox"> Arcoiris</label><br>
            <label><input type="checkbox"> Dorada</label><br>
        </div>
        <div class="filter-section">
            <label for="language">Idioma:</label><br>
            <select id="language">
                <option value="">Todos</option>
                <?php
                    require "../../app/controller/IdiomaController.php";
                    $idiomaController = new IdiomaController();

                    $idiomas = $idiomaController->getAllIdiomas();

                    foreach ($idiomas as $idioma) {
                        echo "<option value='".$idioma["idioma_id"]."'>".$idioma["nombre_idioma"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="filter-section precio-range">
            <h3>Precio</h3>
            <label>min:</label>
            <br>
            <input type="number" id="minPrecio" min="0" max="1000" value="0">
            <br>
            <label>max:</label>
            <br>
            <input type="number" id="maxPrecio" min="0" max="1000" value="100">
        </div>
        <div class="filter-buttons">
            <button onclick="clearFilters()">Borrar filtro</button>
            <button onclick="applyFilters()">Filtrar</button>
        </div>

    </div>

    <div class="galeria-container">
        <div class="search-bar-container">
            <input type="text" id="searchInput" placeholder="Buscar productos...">
            <button onclick="searchItems()">Buscar</button>
        </div>

        <section class="galeria" id="galeria"></section>
        <div class="pagination">
            <button onclick="prevPage()" id="prevBtn" disabled>&laquo; Anterior</button>
            <span id="pageIndicator">Página 1</span>
            <button onclick="nextPage()" id="nextBtn">Siguiente &raquo;</button>
        </div>
    </div>

    <script>
        const galeria = document.getElementById("galeria");
        const pageIndicator = document.getElementById("pageIndicator");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        const itemsPerPage = 20;
        let currentPage = 1;
        let searchResults = [];
        let isSearching = false;

        const items = Array.from({ length: 100 }, (_, i) => `Elemento ${i + 1}`);

        function renderPage(page) {
            galeria.innerHTML = "";
            const itemsToRender = isSearching ? searchResults : items; 
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentItems = itemsToRender.slice(start, end);

            currentItems.forEach(item => {
                const div = document.createElement("div");
                div.classList.add("galeria-item");
                div.textContent = item;
                galeria.appendChild(div);
            });

            pageIndicator.textContent = `Página ${page}`;
            prevBtn.disabled = page === 1;
            nextBtn.disabled = end >= itemsToRender.length;
        }

        function clearFilters() {
            document.getElementById("collectionType").value = "";
            document.querySelectorAll(".filter-section input[type='checkbox']").forEach(cb => cb.checked = false);
            document.getElementById("language").value = "";
            document.getElementById("minPrecio").value = 0;
            document.getElementById("maxPrecio").value = 100;
            document.getElementById("searchInput").value = "";
            isSearching = false;
            searchResults = [];
            renderPage(1);
        }

        function applyFilters() {
            const minPrecio = document.getElementById("minPrecio").value;
            const maxPrecio = document.getElementById("maxPrecio").value;

            console.log(`Aplicando filtros - Min Precio: ${minPrecio}, Max Precio: ${maxPrecio}`);
            renderPage(1);
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
            searchResults = items.filter(item => item.toLowerCase().includes(searchTerm));
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