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
<header>
        <img class="img-logo" src="imagenes/image.png" alt="logo">
        <nav>
            <ul>

                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="deseados.php">Deseados</a></li>
                <li><a href="tienda.php">Tienda</a></li>
                <li><a href="publicar.php">Publicar</a></li>
                <li><a href="cuenta.php">Cuenta</a></li>

            </ul>
        </nav>
    </header>
    <div class="divTexto">
        <form class="form-container">
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
                <img class="image-placeholder" id="imagen">
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
                <select id="expansion" name="expansion" onchange="addExpansion()">
                    <option></option>
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
                <input type="number" id="precio" name="precio" min="0" max="10" required>
            </div>
    
            <!-- Botón de publicar -->
            <div class="form-group">
                <button type="submit">Publicar</button>
            </div>
        </form>
    </div>
    <div class="divTexto">
        <div class="container">
            <div class="image-section">
                <div class="dos_elemetos">
                    <input id="imagenURL" type="text" placeholder="URL">
                    <button onclick="cargarimg()">Cargar</button>
                </div>
                
            </div>
            <div class="form-section">
                <input type="text" placeholder="nombre" >
                <textarea placeholder="Descripcion"></textarea>
                <div class="dos_elementos">
                    <select id="tipo" onchange="tipo()">
                        <option>Tipo de articulo</option>
                        <option valu="Pack">Pack</option>
                        <option valu="Sobre">Sobre</option>
                        <option valu="Carta">Carta</option>
                    </select>
                    <select id="collectionType" name="expansion" onchange="addExpansion()">
                        <option>Expansiones</option>
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
                <div id="expansiones">

                </div>
                <div class="dos_elementos">
                    <select id="language" name="idioma">
                        <?php
                            require_once "../../app/controller/IdiomaController.php";
                            $idiomaController = new IdiomaController();

                            $idiomas = $idiomaController->getAllIdiomas();

                            foreach ($idiomas as $idioma) {
                                echo "<option value='".$idioma["idioma_id"]."' ".(isset($idiomasSelect) && $idiomasSelect == $idioma["idioma_id"]?'selected':'').">".$idioma["nombre_idioma"]."</option>";
                            }
                        ?>
                    </select>
                    <div id="CalidadStock">
                        
                    </div>
                </div>
                
                <input type="text" placeholder="Precio">
                <button class="publish-button">Publicar</button>
            </div>
        </div>
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
                    expansiones.push(valor);
                }
                cargarExpansiones();
                
            }
        }

        function cargarExpansiones(){
            expansionesDiv.innerHTML = "";
            for (let i = 0; i < expansiones.length; i++) {
                    const p = document.createElement("p");
                    p.classList.add("expansionUnica");
                    p.textContent = expansiones[i][1];
                    p.onclick = function() {eleiminar(i)};
                    expansionesDiv.appendChild(p);
                }
        }

        function calidadStock(){
            calidadStockDiv.innerHTML = "";
            if(multipleExpansion){
                const label =document.createElement("label");
                label. textContent = "Calidad";
                calidadStockDiv.appendChild(label);
                const select = document.createElement("select");
                select.name = "calidad";
                calidadStockDiv.appendChild(select);
                var calidades = ['','Comun', 'Poco Comun', 'Rara', 'Holo Rara', 'Rara Inversa', 'Rara Ultra', 'Full Art', 'Secreta', 'Arcoiris', 'Dorada'];
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
                input.min = 1;
                input.max = 20;
                input.required = true;
                calidadStockDiv.appendChild(input);
            }
            
        }

        function eleiminar(item){
            // alert(item);
            // alert(expansiones.length);
            // alert(expansiones.length != item+1);
            // expansiones.length != item+1? expansiones.splice(item, 1):expansiones.pop();
            if(expansiones[item][0] == expansion.value){
                expansion.value = "";
            }
            expansiones.splice(item, 1);
            cargarExpansiones();
        }

        function cargarimg(value){
            document.getElementById("imagen").src = value; 
        }
        calidadStock()
    </script>
</body>
</html>