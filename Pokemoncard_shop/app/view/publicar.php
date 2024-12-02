<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Publicar</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/publicar.css">
</head>
<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        require_once "../../app/controller/ProductoController.php";
        require_once "../../app/controller/MarcarController.php";
        $usuarioController = new UsuarioController();
        $productoController = new ProductoController();
        $marcarController = new MarcarController();
        session_start();
        if ($usuarioController->getUSesion() == null) {
            header('Location: /app/view/login.php');
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoUrlSaneado = htmlspecialchars(($_POST["url"]));
            $campoNombreSaneado = htmlspecialchars(($_POST["nombre"]));
            $campoDescripcionSaneado = htmlspecialchars($_POST["descripcion"]);
            $tipoArticulo = $_POST["tipo-articulo"];
            $idioma = $_POST["idioma"];
            $precio = $_POST["precio"];
            $expansiones;
            $stock = 1;
            $caldad = null;
            if($tipoArticulo == "Carta"){
                $expansiones = explode(",",$_POST["Expansiones"]);
                $caldad = $_POST["calidad"];
            }else{
                $expansiones = [$_POST["expansion"]];
                $stock = $_POST["Stock"];
            }
            $idPr = $productoController->crearProducto($usuarioController->getUSesion()[0], $idioma, $campoNombreSaneado, $campoDescripcionSaneado, $precio,$stock, $caldad, $tipoArticulo, $campoUrlSaneado);
    
            foreach($expansiones as $expansionId){
                $marcarController->crear($expansionId,$idPr);
            }
            header('Location: /app/view/tienda.php');
        }
    ?>
    <header>
        <a href="http://pokemoncardshop.com"><img class="img-logo" src="/app/view/imagenes/image.png" alt="logo"></a>
        <nav>
            <ul>
                <li><a href="http://pokemoncardshop.com">Inicio</a></li>
                <li><a href="/app/view/deseados.php">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="/app/view/cuenta.php"><?php echo $usuarioController->getUSesion()[1] ?></a></li>
            </ul>
        </nav>
    </header>
    <div class="divTexto">
        <form class="form-container" method="POST">
            <h2>Publicar Artículo</h2>
            
            <!-- URL -->
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" id="url" name="url" required>
            </div>
    
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
    
            <!-- Imagen de vista previa -->
            <div class="form-group">
                <label>Vista previa</label>
                <img class="image-placeholder" id="imagen" onerror="errorImagen()">
            </div>
    
            <!-- Descripción (Al lado de la Vista previa) -->
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="10"  required></textarea>
            </div>
    
            <!-- Tipo de artículo -->
            <div class="form-group">
                <label for="tipo-articulo">Tipo de Artículo</label>
                <select id="tipo-articulo" name="tipo-articulo"  onchange="tipo()">
                    <option valu="Pack">Pack</option>
                    <option valu="Sobre">Sobre</option>
                    <option valu="Carta">Carta</option>
                </select>
            </div>
    
            <!-- Expansión -->
            <div class="form-group">
                <label for="expansion">Expansión</label>
                <select id="expansion" name="expansion" onchange="addExpansion()" required>
                    <option value="" selected disabled>Seleccioana una expansión</option>
                    <?php
                        require_once "../../app/controller/FiltroController.php";
                        $filtroController = new FiltroController();

                        $filtros = $filtroController->getAllFiltros();
                        foreach ($filtros as $filtro) {
                            echo "<option value='".$filtro["filtro_id"]."' ".(isset($expansion) && $expansion == $filtro["filtro_id"]?'selected':'').">".$filtro["nombre_filtro"]."</option>";
                        }
                    ?>
                </select>
                <div id="expansiones">

                </div>
            </div>
    
            <!-- Idioma -->
            <div class="form-group">
                <label for="idioma">Idioma</label>
                <select id="idioma" name="idioma">
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
    
            <!-- Stock/Categoria -->
            <div class="form-group"  id="CalidadStock">
            </div>
            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" min="0" max="100000000" required step="0.01">
            </div>
    
            <!-- Botón de publicar -->
            <div class="form-group">
                <button type="submit">Publicar</button>
            </div>
        </form>
    </div>
    <script>
        const tipoComponent = document.getElementById("tipo-articulo");
        const expansion = document.getElementById("expansion");
        const expansionesDiv = document.getElementById("expansiones");
        const calidadStockDiv = document.getElementById("CalidadStock");
        const inputURL = document.getElementById("url");
        multipleExpansion = false;
        expansiones = [];

        inputURL.addEventListener("change", function(){
            cargarimg(inputURL.value)
        });

        inputURL.onpaste = function(event){
            cargarimg(event.clipboardData.getData('text/plain'));
        };
        function tipo(){
            multipleExpansion = tipoComponent.value=="Carta";
            expansion.value = "";
            expansion.required = true;
            if(!multipleExpansion){
                expansionesDiv.innerHTML = "";
                expansiones = [];
            }
            calidadStock();
        }
        function addExpansion(){
            if(multipleExpansion){
                valor = [expansion.value,expansion.options[expansion.selectedIndex].text];
                if(valor[1] != "" && !expansiones.some(e=> e[0]==valor[0])){
                    expansion.required = false;
                    expansiones.push(valor);
                }
                cargarExpansiones();
                
            }
        }

        function cargarExpansiones(){
            expansionesDiv.innerHTML = "";
            var expansionesHiden = "";
            for (let i = 0; i < expansiones.length; i++) {
                expansionesHiden +=  (i==0?"":",")+expansiones[i][0]; 
                const p = document.createElement("p");
                p.classList.add("expansionUnica");
                p.textContent = expansiones[i][1];
                p.onclick = function() {eleiminar(i)};
                expansionesDiv.appendChild(p);
            }
            const input =document.createElement("input");
            input.type = "hidden";
            input.name = "Expansiones";
            input.value = expansionesHiden;
            expansionesDiv.appendChild(input);
        }

        function calidadStock(){
            calidadStockDiv.innerHTML = "";
            if(multipleExpansion){
                const label =document.createElement("label");
                label. textContent = "Calidad";
                calidadStockDiv.appendChild(label);
                const select = document.createElement("select");
                select.name = "calidad";
                select.required = true;
                calidadStockDiv.appendChild(select);
                const option1 =document.createElement("option");
                option1.textContent = "Seleccioana una calidad";
                option1.value = "";
                option1.selected = true;
                option1.disabled = true;
                select.appendChild(option1);
                var calidades = ['Comun', 'Poco Comun', 'Rara', 'Holo Rara', 'Rara Inversa', 'Rara Ultra', 'Full Art', 'Secreta', 'Arcoiris', 'Dorada'];
                calidades.forEach(calidad=>{
                    const option =document.createElement("option");
                    option.textContent = calidad;
                    option.value =calidad;
                    select.appendChild(option);
                });
            }else{
                const label =document.createElement("label");
                label. textContent = "Stock";
                calidadStockDiv.appendChild(label);
                const input =document.createElement("input");
                input.type = "number";
                input.name = "Stock";
                input.min = 1;
                input.max = 20;
                input.required = true;
                calidadStockDiv.appendChild(input);
            }
            
        }

        function eleiminar(item){
            if(expansiones[item][0] == expansion.value){
                expansion.value = "";
            }
            expansiones.splice(item, 1);
            if(expansiones.length == 0){
                expansion.required = true;
            }

            cargarExpansiones();
        }

        function cargarimg(value){
            document.getElementById("imagen").style.objectFit = "contain";
            document.getElementById("imagen").src = value; 
        }

        function errorImagen(){
            inputURL.value = "";
            document.getElementById("imagen").style.objectFit = "cover";
            document.getElementById("imagen").src = "/app/view/imagenes/fallo_imagen1.png";
        }
        calidadStock()
    </script>
</body>
<footer class="footer">
        <div class="copyright">
            <a href="http://pokemoncardshop.com">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="avisoLegal.php">Aviso legal</a> |
            <a href="privacidad.php">Política de privacidad</a> |
            <a href="coockies.php">Política de Cookies</a> |
            <a href="envios.php">Política de envíos</a> |
            <a href="reembolso.php">Política de reembolso</a>
        </div>
</footer>
</html>