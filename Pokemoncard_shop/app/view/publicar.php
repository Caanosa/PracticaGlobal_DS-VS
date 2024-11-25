<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app/view/publicar.css">
</head>
<body>
<header>
        <img class="img-logo" src="imagenes/image.png" alt="logo">
        <nav>
            <ul>

                <li><a href="inicio.html">Inicio</a></li>
                <li><a href="deseados.html">Deseados</a></li>
                <li><a href="tienda.php">Tienda</a></li>
                <li><a href="publicar.php">Publicar</a></li>
                <li><a href="cuenta.html">Cuenta</a></li>

            </ul>
        </nav>
    </header>
    <div class="divTexto">
        <div class="container">
            <div class="image-section">
                <div class="dos_elemetos">
                    <input id="imagenURL" type="text" placeholder="URL">
                    <button onclick="cargarimg()">Cargar</button>
                </div>
                <img class="image-placeholder" id="imagen">
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
        const tipoComponent = document.getElementById("tipo");
        const expansion = document.getElementById("collectionType");
        const expansionesDiv = document.getElementById("expansiones");
        const calidadStockDiv = document.getElementById("CalidadStock");
        multipleExpansion = false;
        expansiones = [];
        function tipo(){
            multipleExpansion = tipoComponent.value=="Carta";
            expansion.value = "Expansiones";
            if(!multipleExpansion){
                expansionesDiv.innerHTML = "";
                expansiones = [];
            }
            calidadStock();
        }
        function addExpansion(){
            if(multipleExpansion){
                valor = [expansion.value,expansion.options[expansion.selectedIndex].text];
                if(valor[1] != "Expansiones" && !expansiones.some(e=> e[0]==valor[0])){
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
                const select = document.createElement("select");
                select.name = "calidad";
                calidadStockDiv.appendChild(select);
                var calidades = ['Calidades','Comun', 'Poco Comun', 'Rara', 'Holo Rara', 'Rara Inversa', 'Rara Ultra', 'Full Art', 'Secreta', 'Arcoiris', 'Dorada'];
                calidades.forEach(calidad=>{
                    const option =document.createElement("option");
                    option.textContent = calidad;
                    option.value =calidad;
                    select.appendChild(option);
                });
            }else{
                const input =document.createElement("input");
                input.type = "number";
                input.placeholder = "Stock"
                calidadStockDiv.appendChild(input);
            }
            
        }

        function eleiminar(item){
            // alert(item);
            // alert(expansiones.length);
            // alert(expansiones.length != item+1);
            // expansiones.length != item+1? expansiones.splice(item, 1):expansiones.pop();
            expansiones.splice(item, 1);
            cargarExpansiones();
        }

        function cargarimg(){
            document.getElementById("imagen").src = document.getElementById("imagenURL").value; 
        }
        calidadStock()
    </script>
</body>
</html>