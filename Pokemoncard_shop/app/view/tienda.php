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
    <?php
        require_once "../../app/controller/ProductoController.php";
        $productoController = new ProductoController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $expansion = $_POST["expansion"];
            $tiposNombre = ["Pack","Sobres","Cartas"];
            $tiposInt = [];
            $tipos = [];
            foreach ($tiposNombre as $tipo) {
                if(in_array($tipo, $_POST)){
                    array_push($tiposInt,1);
                    array_push($tipos, $tipo);
                }else{
                    array_push($tiposInt,0);
                }
            }
            $categoriasNombre = ["Comun","Poco comun","Rara","Holo rara", "Rara inversa", "Rara ultra", "Full art", "Secreta", "Arcoiris", "Dorada"];
            $categoriasInt = [];
            $categorias = [];
            foreach ($categoriasNombre as $categoria) {
                if(in_array($categoria, $_POST)){
                    array_push($categoriasInt,1);
                    array_push($tipos, $tipo);
                }else{
                    array_push($categoriasInt,0);
                }
            }
            $idiomasSelect = $_POST["idioma"];
            $min = $_POST["min"];
            $max = $_POST["max"];
            
            $provisional = $productoController->getAllProductos();
        }else{
            echo "<h2>no</h2>";
        } 
        $productos = $productoController->getAllProductos();
        $hola2 = "hola";
        
    ?>
    <script>
            variable1 = <?php echo json_encode($productos) ?>;
            console.log(variable1[0].producto_id);
    </script>
    <!-- onsubmit="manejarEnvio(event)" -->
    <form id="formulario" class="filter-container"  method="POST" >
        <h3>Filtros</h3>
        <div class="filter-section">
            <label for="collectionType">Exnsion:</label><br>
            <select id="collectionType" name="expansion">
                <option value="">Todas</option>
                <?php
                    require_once "../../app/controller/FiltroController.php";
                    $filtroController = new FiltroController();

                    $filtros = $filtroController->getAllFiltros();
                    foreach ($filtros as $filtro) {
                        echo "<option value='".$filtro["filtro_id"]."' ".(isset($expansion) && $expansion == $filtro["filtro_id"]?'selected':'').">".$filtro["nombre_filtro"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="filter-section filtro-tipo">
            <h4>Tipo</h4>
            <label><input type="checkbox" name="Pack"  value="Pack" <?php echo isset($tiposInt) &&$tiposInt[0]==1?"checked":""?>> Pack</label><br>
            <label><input type="checkbox" name="Sobres"  value="Sobres" <?php echo isset($tiposInt) &&$tiposInt[1]==1?"checked":""?>> Sobres</label><br>
            <label><input type="checkbox" name="Cartas"  value="Cartas" <?php echo isset($tiposInt) &&$tiposInt[2]==1?"checked":""?>> Cartas</label><br>
        </div>
        <div class="filter-section filtro-categoria">

            <h4>Categorías</h4>
            <label><input type="checkbox" name="Comun"  value="Comun" <?php echo isset($categoriasInt) &&$categoriasInt[0]==1?"checked":""?>> Común</label><br>
            <label><input type="checkbox" name="Poco comun"  value="Poco comun" <?php echo isset($categoriasInt) &&$categoriasInt[1]==1?"checked":""?>> Poco común</label><br>
            <label><input type="checkbox" name="Rara"  value="Rara" <?php echo isset($categoriasInt) &&$categoriasInt[2]==1?"checked":""?>> Rara</label><br>
            <label><input type="checkbox" name="Holo rara"  value="Holo rara" <?php echo isset($categoriasInt) &&$categoriasInt[3]==1?"checked":""?>> Holo rara</label><br>
            <label><input type="checkbox" name="Rara inversa"  value="Rara inversa" <?php echo isset($categoriasInt) &&$categoriasInt[4]==1?"checked":""?>> Rara inversa</label><br>
            <label><input type="checkbox" name="Rara ultra"  value="Rara ultra" <?php echo isset($categoriasInt) &&$categoriasInt[5]==1?"checked":""?>> Rara ultra</label><br>
            <label><input type="checkbox" name="Full art"  value="Full art" <?php echo isset($categoriasInt) &&$categoriasInt[6]==1?"checked":""?>> Full art</label><br>
            <label><input type="checkbox" name="Secreta"  value="Secreta" <?php echo isset($categoriasInt) &&$categoriasInt[7]==1?"checked":""?>> Secreta</label><br>
            <label><input type="checkbox" name="Arcoiris"  value="Arcoiris" <?php echo isset($categoriasInt) &&$categoriasInt[8]==1?"checked":""?>> Arcoiris</label><br>
            <label><input type="checkbox" name="Dorada"  value="Dorada" <?php echo isset($categoriasInt) &&$categoriasInt[9]==1?"checked":""?>> Dorada</label><br>
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
                        echo "<option value='".$idioma["idioma_id"]."' ".(isset($idiomasSelect) && $idiomasSelect == $idioma["idioma_id"]?'selected':'').">".$idioma["nombre_idioma"]."</option>";
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
            <input type="number" id="maxPrecio" name="max" min="0" max="1000" value="<?php echo isset($max) ?$max:100?>">
        </div>
        <div class="filter-buttons">
            <button onclick="clearFilters()">Borrar filtro</button>
            <button onclick="applyFilters()" type="submit">Filtrar</button>
        </div>

    </form>
    
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

        const items = <?php echo json_encode($productos) ?>;

        function manejarEnvio(event){
            event.preventDefault();
        }
        function renderPage(page) {
            galeria.innerHTML = "";
            const itemsToRender = isSearching ? searchResults : items; 
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentItems = itemsToRender.slice(start, end);

            currentItems.forEach(item => {
                const div = document.createElement("div");
                div.classList.add("galeria-item");
                const imagen = document.createElement("img");
                imagen.classList.add("imagen-producto");
                imagen.src  = item.imagen_url;
                galeria.appendChild(div);
                div.appendChild(imagen);
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
            // const minPrecio = document.getElementById("minPrecio").value;
            // const maxPrecio = document.getElementById("maxPrecio").value;
            expansion  = document.getElementById("collectionType").value;
            idioma = document.getElementById("language").value;
            max = document.getElementById("minPrecio").value;
            min = document.getElementById("minPrecio").value;
            tipo = [];
            document.querySelectorAll(".filtro-tipo input[type='checkbox']").forEach(cb => tipo.push(cb.checked?1:0));
            tipo = tipo.includes(1)?tipo.toString():"";
            categoria = [];
            document.querySelectorAll(".filtro-categoria input[type='checkbox']").forEach(cb => categoria.push(cb.checked?1:0));
            categoria = categoria.includes(1)?categoria.toString():"";
            console.log(tipo.includes(1));
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