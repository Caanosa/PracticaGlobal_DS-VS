<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - </title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/producto.css">
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
    if($_SERVER['REQUEST_METHOD']=='GET'&& isset($_GET['producto_id'])){
        $prodcuto = $productoController->recuperarPorId($_GET['producto_id']);
        $expansiones = $marcarController->recuperarPorId($_GET['producto_id']);
        if($prodcuto == null){
            header('Location: /app/view/tienda.php');
        }
    }

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
    <div class="divTexto">
        <div class="container">
            <!-- Panel izquierdo -->
            <div class="left-panel">
                <img src="<?=$prodcuto[0]['imagen_url']?>" alt="Vista previa del producto">
                <button class="like-button">♥️</button>
            </div>
    
            <!-- Panel derecho -->
            <div class="right-panel">
                
                <div class="info-section">
                    <h1><?=$prodcuto[0]['nombre']?></h1>
                    <span><strong>Descripción:</strong></span>
                    <p class="description"><?=$prodcuto[0]['descripcion']?></p>
                </div>
                <div class="info-section">
                    <span><strong>Tipo de Artículo:</strong><?=$prodcuto[0]['tipo']?></span>
                    <span><strong>Idioma:</strong><?=$prodcuto[0]['nombre_idioma']?></span>
                    <?php
                        if($prodcuto[0]['categoria'] != null){
                            echo "<span><strong>Idioma:</strong>".$prodcuto[0]['categoria']."</span>";
                        }
                    ?>
                    <span id="spanExpansion"><strong>Expansión:</strong></span>
                    <div id="expansiones">

                    </div>
                </div>
                <div class="info-section">
                    <span><strong>Precio:</strong> <?=$prodcuto[0]['precio']?></span>
                    <span><strong>Stock:</strong><?=$prodcuto[0]['stock']?></span>
                </div>
                <form class="wishlistComprar" method="POST">
                    <span><strong>Cantidad:</strong></span>
                    <input type="number" name="cantidad">
                    <button class="wishlist-button">AÑADIR A WISHLIST</button>
                    <input type="hidden" name="idProducto">
                    <button class="buy-button" type="submit">COMPRAR</button>
                    <p class="fechaDePublicacion">Fecha de publicacion: <?=$prodcuto[0]['fecha_agregado']?></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        const expansionesDiv = document.getElementById("expansiones");
        const spanExpansion = document.getElementById("spanExpansion");
        expansiones = <?= json_encode($expansiones) ?>;
        if(expansiones.length ==1){
            spanExpansion.textContent = "Expansión:"+expansiones[0]['nombre_filtro'];
        }else{
            spanExpansion.textContent = "Expansiónes:";
            for (let i = 0; i < expansiones.length; i++) {
                const p = document.createElement("p");
                p.classList.add("expansionUnica");
                p.textContent = expansiones[i]['nombre_filtro'];
                expansionesDiv.appendChild(p);
            }
        }
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