<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <link rel="stylesheet" href="/app/view/cuenta.css">
</head>

<body>
    <?php
        session_start();
        require_once "../../app/controller/UsuarioController.php";
        require_once "../../app/controller/ProductoController.php";
        $usuarioController = new UsuarioController();
        $productoController = new ProductoController();
        $productos = [];
        $holad = "KKKKKKKKKK";
        if($_SERVER['REQUEST_METHOD']=='POST'){
            switch ($_POST['formulario']) {
                case 1:
                    $usuarioController->finalizarSesion();
                    header('Location: http://pokemoncardshop.com');
                    break;
                case 2:
                    $img_num = $_POST["numero_img"];
                    $usuarioController->modificarImagen($usuarioController->getUSesion()[0],$img_num);
                    break;
            }  
        }
        $vendidos = $productoController->recuperarVendidos($usuarioController->getUSesion()[0]);
        $comprados = $productoController->recuperarComprados($usuarioController->getUSesion()[0]);
        $Plikes = $productoController->recuperarLikes($usuarioController->getUSesion()[0]);

        $usuario =  $usuarioController->getById($usuarioController->getUSesion()[0]);
        $likes = $usuarioController->recuperarLikes($usuarioController->getUSesion()[0]);
    ?>

    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.html">Inicio</a></li>
                <li><a href="/app/view/deseados.html">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.html">Publicar</a></li>
                <li><a href="/app/view/login.php">Cuenta</a></li>
            </ul>
        </nav>
    </header>
    <form method="POST">
        <input type="hidden" name="formulario" value="1">
        <button type="submit" class="salir">Cerrar Sessión</button>
    </form>
    

    <div class="image-picker">
        <div class="circle" onclick="openPopup();">
            <img id="circleImage" src="" class="circle-img">
        </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup();">&times;</span>
            <h3>Selecciona una imagen</h3>
            <div class="image-options">
                <div>
                    <div>
                        <img src="/app/view/imagenes/vamoacalmarno.jpg" alt="Imagen 1" onclick="setImage(1);">

                    </div>
                    <div>
                        <img src="/app/view/imagenes/gengar.jpg" alt="Imagen 2" onclick="setImage(2);">

                    </div>
                    <div>
                        <img src="/app/view/imagenes/wingull.avif" alt="Imagen 3" onclick="setImage(3);">

                    </div>

                </div>
                <div>
                    <div>
                        <img src="/app/view/imagenes/victini.png" alt="Imagen 4" onclick="setImage(4);">
                    </div>
                    <div>
                        <img src="/app/view/imagenes/pikachu.jpeg" alt="Imagen 5" onclick="setImage(5);">
                    </div>
                    <div>
                        <img src="/app/view/imagenes/oshawott.png" alt="Imagen 6" onclick="setImage(6);">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p><?php echo $usuario[0]['nombre']?></p>
    <p class="ercora"><?= $likes[0]["likes"] ?> ❤</p>
    <div class="tabs">
        <input type="radio" name="tabs" id="tab-vendidos" checked>
        <label for="tab-vendidos" onclick="pestania(1)">Vendidos</label>

        <input type="radio" name="tabs" id="tab-comprados">
        <label for="tab-comprados" onclick="pestania(2)">Comprados</label>

        <input type="radio" name="tabs" id="tab-megusta" onclick="pestania(3)">
        <label for="tab-megusta">Me gusta</label>
    </div>

    <div class="content-container">
        <div id="vendidos" class="content">
        </div>
        <button class="prev" onclick="prevPage()" id="prevBtn">&#10094;</button>
        <button class="next" onclick="nextPage()" id="nextBtn">&#10095;</button>
    </div>
    </div>

    <footer class="footer">
        <div class="copyright">
            <a href="">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="avisoLegal.html">Aviso legal</a> |
            <a href="privacidad.html">Política de privacidad</a> |
            <a href="coockies.html">Política de Cookies</a> |
            <a href="envios.html">Política de envíos</a> |
            <a href="reembolso.html">Política de reembolso</a>
        </div>
    </footer>

    <script>
        imagenes = ["/app/view/imagenes/vamoacalmarno.jpg","/app/view/imagenes/gengar.jpg","/app/view/imagenes/wingull.avif",
        "/app/view/imagenes/victini.png","/app/view/imagenes/pikachu.jpeg","/app/view/imagenes/oshawott.png"];
        numImg = <?php echo $usuario[0]['num_img'] != null ? $usuario[0]['num_img']: "false" ;?>;
        if(numImg){
            setImage(numImg);
        }
        // Función para abrir el popup
        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }

        // Función para cerrar el popup
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        // Función para establecer la imagen en el círculo
        function setImage(posicion) {
            document.getElementById("circleImage").src = imagenes[posicion-1];
            if(posicion != numImg){
                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/app/view/cuenta.php ');
                ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                ajax.send('numero_img='+posicion+'&formulario=2');
            }
            closePopup(); // Cerrar el popup al seleccionar la imagen
        }

        const galeria = document.getElementById("vendidos");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        const itemsPerPage = 8;
        let currentPage = 1;
        vendidos = <?= json_encode($vendidos) ?>;
        comprados = <?= json_encode($comprados) ?>;
        likes = <?= json_encode($Plikes) ?>;
        items = vendidos;

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
                imagen.textContent = item['nombre'];
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
                case 1:
                    items = vendidos;
                    break;
                case 2:
                    items = comprados;
                    break;
                case 3:
                    items = likes;
                    break;
            }
            currentPage = 1;
            renderPage(currentPage);
        }

        renderPage(currentPage);
    </script>

</html>