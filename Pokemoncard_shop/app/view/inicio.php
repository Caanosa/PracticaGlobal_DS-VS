<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Card Shop</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/inicio.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        session_start();
    ?>
    <header>
        <a href="http://pokemoncardshop.com"><img class="img-logo" src="/app/view/imagenes/image.png" alt="logo"></a>
        <nav>
            <ul>
                <li><a href="http://pokemoncardshop.com">Inicio</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null?"/app/view/deseados.php":"/app/view/login.php"?>">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null ? "/app/view/cuenta.php" : "/app/view/login.php" ?>"><?php echo $usuarioController->getUSesion() != null ? $usuarioController->getUSesion()[1] : "Cuenta" ?></a></li>
            </ul>
        </nav>
    </header>

    <div class="carousel">
        <div class="carousel-images">
            <img class="carrusel2" src="/app/view/imagenes/carrusel2.png" alt="Imagen 2">
            <img class="carrusel3" src="/app/view/imagenes/carrusel3.png" alt="Imagen 3">
            <img class="carrusel1" src="/app/view/imagenes/carrusel1.png" alt="Imagen 1">
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>

    <div class="fondo_populares">
        <div class="populares">
            <p>PRODUCTOS POPULARES</p>
        </div>

        <div class="productos">
            <div class="producto">
                <h4>Producto 1</h4>
                <p>Descripción del producto 1.</p>
            </div>
            <div class="producto">
                <h4>Producto 2</h4>
                <p>Descripción del producto 2.</p>
            </div>
            <div class="producto">
                <h4>Producto 3</h4>
                <p>Descripción del producto 3.</p>
            </div>
        </div>
    </div>

    <div class="fondo_recientes">
        <p class="recientes">PRODUCTOS RECIENTES</p>
        <div class="nuevos">
            <div class="nuevo">
                <h4>Producto 1</h4>
                <p>Descripción del producto 1.</p>
            </div>
            <div class="nuevo">
                <h4>Producto 2</h4>
                <p>Descripción del producto 2.</p>
            </div>
            <div class="nuevo">
                <h4>Producto 3</h4>
                <p>Descripción del producto 3.</p>
            </div>
        </div>
    </div>

    <div class="noticias">
        <div class="etb">
            <p class="titulo_noticias">¡Hazte con la nueva colección llamada Chispas Flugurantes!</p>
            <img class="etb_img" src="/app/view/imagenes/etb_chispas_fulgurantes.png" alt="">

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
        let currentIndex = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll(".carousel-images img");
            if (index >= slides.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = slides.length - 1;
            } else {
                currentIndex = index;
            }
            const offset = -currentIndex * 100;
            document.querySelector(".carousel-images").style.transform = `translateX(${offset}%)`;
        }

        function moveSlide(step) {
            showSlide(currentIndex + step);
        }

        setInterval(() => {
            moveSlide(1);
        }, 3000);

        showSlide(currentIndex);

    </script>
</body>

</html>