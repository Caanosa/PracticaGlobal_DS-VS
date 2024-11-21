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
                <input type="text" placeholder="nombre">
                <textarea placeholder="Descripcion"></textarea>
                <div class="dos_elementos">
                    <select>
                        <option valu="Pack">Pack</option>
                        <option valu="Sobre">Sobre</option>
                        <option valu="Carta">Carta</option>
                    </select>
                    <select id="collectionType" name="expansion">
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
                <input type="text" placeholder="Precio">
                <button class="publish-button">Publicar</button>
            </div>
        </div>
    </div>
    <script>
        function cargarimg(){
            document.getElementById("imagen").src = document.getElementById("imagenURL").value; 
        }
    </script>
</body>
</html>