<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Cuenta</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/cuenta.css">
</head>

<body>
    <?php
    session_start();
    require_once "../../app/controller/UsuarioController.php";
    require_once "../../app/controller/ProductoController.php";
    $usuarioController = new UsuarioController();
    $productoController = new ProductoController();
    if ($usuarioController->getUSesion() == null) {
        header('Location: /app/view/login.php');
    }
    $productos = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['formulario']) {
            case 1:
                $usuarioController->finalizarSesion();
                header('Location: http://pokemoncardshop.com');
                break;
            case 2:
                $img_num = $_POST["numero_img"];
                $usuarioController->modificarImagen($usuarioController->getUSesion()[0], $img_num);
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
        <a href="http://pokemoncardshop.com"><img class="img-logo" src="/app/view/imagenes/image.png" alt="logo"></a>
        <nav>
            <ul>
                <li><a href="http://pokemoncardshop.com">Inicio</a></li>
                <li><a href="/app/view/deseados.php">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <?=$usuarioController->getUSesion() != null&& $usuarioController->getAdminId($usuarioController->getUSesion()[0])[0]['administrador']==1?"<li><a href='/app/view/listaAdmin.php'>Modificar</a></li>":""?>
                <li><a class="seleccionado" href="/app/view/cuenta.php"><?php echo $usuarioController->getUSesion()[1] ?></a></li>
            </ul>
        </nav>
    </header>
    <div class="cuerpo">

        <a href="/app/view/editarUsuario.php" class="editar">
            <button type="submit" class="editar_usuario">Editar usuario</button>
        </a>

        
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

        <p><?php echo $usuario[0]['nombre'] ?></p>
        <p class="ercora"><?= $likes[0]["likes"] != null?$likes[0]["likes"]:0 ?> ❤</p>
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
            <img id="lista_vacia_img" src="/app/view/imagenes/cero megustas.png" alt="">
            <h1 id="lista_vacia_titulo">Aun so as vendido ningun producto</h1>
            <button class="next" onclick="nextPage()" id="nextBtn">&#10095;</button>
        </div>
    </div>

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


    <script>
        imagenes = ["/app/view/imagenes/vamoacalmarno.jpg", "/app/view/imagenes/gengar.jpg", "/app/view/imagenes/wingull.avif",
            "/app/view/imagenes/victini.png", "/app/view/imagenes/pikachu.jpeg", "/app/view/imagenes/oshawott.png"
        ];
        numImg = <?php echo $usuario[0]['num_img'] != null ? $usuario[0]['num_img'] : "false"; ?>;
        if (numImg) {
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
            document.getElementById("circleImage").src = imagenes[posicion - 1];
            if (posicion != numImg) {
                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/app/view/cuenta.php ');
                ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                ajax.send('numero_img=' + posicion + '&formulario=2');
            }
            closePopup(); // Cerrar el popup al seleccionar la imagen
        }

        const galeria = document.getElementById("vendidos");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const listavaciaimg = document.getElementById("lista_vacia_img");
        const listavaciatitulo = document.getElementById("lista_vacia_titulo");
        imgen_vacio = "/app/view/imagenes/no vendidos1.png";
        titulo_vacio = "Aún no as vendido ningún producto"

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
            if(items.length == 0){
                listavaciaimg.src = imgen_vacio;
                listavaciatitulo.textContent = titulo_vacio;
            }else{
                listavaciaimg.src = "";
                listavaciatitulo.textContent = "";
                currentItems.forEach(item => {
                    const aLink = document.createElement("a");
                    aLink.href = "/app/view/producto.php?producto_id="+item['producto_id']+"&pedido_id="+item['pedido_id'];
                    galeria.appendChild(aLink);
                    const div1 = document.createElement("div");
                    div1.classList.add("galeria-item");
                    aLink.appendChild(div1);
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
                    div5.textContent = item['precio']+"€";
                    div3.appendChild(div5);
                });
            }
            

            
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
                    imgen_vacio = "/app/view/imagenes/no vendidos1.png";
                    titulo_vacio = "Aún no as vendido ningún producto";
                    break;
                case 2:
                    items = comprados;
                    imgen_vacio = "/app/view/imagenes/no compras.png";
                    titulo_vacio = "Aún no as comprado ningún producto";
                    break;
                case 3:
                    items = likes;
                    imgen_vacio = "/app/view/imagenes/cero megustas.png";
                    titulo_vacio = "Dale me gusta a los productos que hayas comprado";
                    break;
            }
            currentPage = 1;
            renderPage(currentPage);
        }

        renderPage(currentPage);
    </script>
</body>

</html>