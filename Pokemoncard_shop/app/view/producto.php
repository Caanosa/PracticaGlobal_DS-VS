<!DOCTYPE html>
<html lang="en">
<?php
    require_once "../../app/controller/UsuarioController.php";
    require_once "../../app/controller/ProductoController.php";
    require_once "../../app/controller/MarcarController.php";
    require_once "../../app/controller/PedidoController.php";
    $usuarioController = new UsuarioController();
    $productoController = new ProductoController();
    $marcarController = new MarcarController();
    $pedidoController = new PedidoController ();

    session_start();
    if($_SERVER['REQUEST_METHOD']=='GET'&& isset($_GET['producto_id'])){
        $prodcuto = $productoController->recuperarPorId($_GET['producto_id']);
        $expansiones = $marcarController->recuperarPorId($_GET['producto_id']);
        
        if($prodcuto == null){
            header('Location: /app/view/tienda.php');
        }

        if(isset($_GET['pedido_id']) && $usuarioController->getUSesion() != null){
            $pedido = $pedidoController->recuperarPorId($_GET['pedido_id']);
            if($pedido[0]['usuario_id'] != $usuarioController->getUSesion()[0] && $prodcuto[0]['usuario_id'] != $usuarioController->getUSesion()[0]){
                header('Location: /app/view/producto.php?producto_id='.$_GET['producto_id']);
                exit;
            }
            $meGusta = $pedido[0]["me_gusta"] == 1;
            $comprador = $usuarioController->getFiltradoById($pedido[0]['usuario_id']);
        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $prodcuto = $productoController->recuperarPorId($_POST['producto_id']);
        $expansiones = $marcarController->recuperarPorId($_POST['producto_id']);
        if($usuarioController->getUSesion() == null){
            header('Location: /app/view/login.php');
            exit;
        }
        
        if(isset($_POST['cantidad'])){
            if($prodcuto[0]['stock']-$_POST['cantidad']>=0){
                $idPedido = $pedidoController->crear($usuarioController->getUSesion()[0],$prodcuto[0]['producto_id'],$_POST['cantidad']);
                header('Location: /app/view/cuenta.php');
                exit;
            }
        }else if(isset($_POST['deseados'])){
            $productoController->guardarDeseadosSesion($prodcuto[0]['producto_id'],$prodcuto[0]['nombre'],$prodcuto[0]['precio'], $prodcuto[0]['imagen_url']);
            exit;
        }else if(isset($_POST['pedido_id'])){
            $pedidoController->updateMeGusta($_POST['pedido_id']);
        }
    }
    if(!isset($prodcuto)){
        header('Location: /app/view/tienda.php');
        exit;
    }
    $usuario = $usuarioController->getFiltradoById($prodcuto[0]['usuario_id']);
    $likes = $usuarioController->recuperarLikes($prodcuto[0]['usuario_id']);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - <?= $prodcuto[0]['nombre']?></title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/producto.css">
</head>
<body>
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
        <div class="opciones_admin">
            <button>🗑️</button>
            <button>✏</button>
        </div>
        <div class="container">
            <!-- Panel izquierdo -->
            <div class="left-panel">
                <img src="<?=$prodcuto[0]['imagen_url']?>" alt="Vista previa del producto">
                <?= isset($pedido)&& $pedido[0]['usuario_id'] ==$usuarioController->getUSesion()[0]?"<button class='like-button".($meGusta?"1":"2")."' onclick='realizarMeGusta()'>❤</button>":"<div class='no_like'></div>";?>
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
                            echo "<span><strong>Categoria:</strong>".$prodcuto[0]['categoria']."</span>";
                        }
                    ?>
                    <span id="spanExpansion"><strong>Expansión:</strong></span>
                    <div id="expansiones">

                    </div>
                </div>
                <?= isset($pedido)?"<div class='info-section'>
                    <span><strong>Datos de compras:</strong></span>
                    <div class='description'>
                        <span class='usuario'><strong>Comprador:</strong><img id='circleImageComprador' src='/app/view/imagenes/no imagen.png' class='circle-img'><strong>".$comprador[0]['nombre']."</strong></span>
                        <span><strong>Cantidad: </strong>".$pedido[0]['cantidad']."</span>
                        <span><strong>Precio total: </strong>".($pedido[0]['cantidad']*$prodcuto[0]['precio'])."€</span>
                        <span><strong>Fecha de pedido: </strong>".$pedido[0]['fecha_pedido']."</span>
                        <span><strong>Estado de pedido: </strong>".$pedido[0]['estado']."</span>
                    </div>
                </div>": ""?>
                <div class="info-section">
                    <span><strong>Precio:</strong> <?=$prodcuto[0]['precio']?>€</span>
                    <span><strong>Stock:</strong><?=$prodcuto[0]['stock']?></span>
                    <span class="usuario"><img id="circleImage" src="/app/view/imagenes/no imagen.png" class="circle-img"><strong><?=$usuario[0]['nombre']?></strong><p><?= $likes[0]["likes"] ?>❤</p></span>
                </div>
                <form class="wishlistComprar" method="POST">
                    <?php
                        echo  $prodcuto[0]['categoria']==null && $prodcuto[0]['stock'] !=0 && ($usuarioController->getUSesion() == null||$prodcuto[0]['usuario_id']!= $usuarioController->getUSesion()[0])?"<span><strong>Cantidad:</strong></span>
                    <input id='cantidad' type='number' name='cantidad' value='1' min='1' max='".$prodcuto[0]['stock']."' oninput='agregarPrecio()'>":"<input type='hidden' name='cantidad' value='1'>";
                    ?>
                    
                    <?= ($usuarioController->getUSesion() == null || $prodcuto[0]['usuario_id']!= $usuarioController->getUSesion()[0])?"<button type='button' class='wishlist-button' id='deseadosb' onclick='clickDeseados()'>AÑADIR A DESEADOS</button>":""?>
                    
                    <?=
                        ($usuarioController->getUSesion() == null || $prodcuto[0]['usuario_id']!= $usuarioController->getUSesion()[0])&&$prodcuto[0]['stock'] !=0?"
                    <input type='hidden' name='producto_id' value='".$prodcuto[0]['producto_id']."'><button id='comprar' class='buy-button' type='submit'>COMPRAR: ".$prodcuto[0]['precio']."€</button>":"";
                    ?>
                    
                    <p class="fechaDePublicacion">Fecha de publicacion: <?=$prodcuto[0]['fecha_agregado']?></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        imagenes = ["/app/view/imagenes/vamoacalmarno.jpg", "/app/view/imagenes/gengar.jpg", "/app/view/imagenes/wingull.avif",
            "/app/view/imagenes/victini.png", "/app/view/imagenes/pikachu.jpeg", "/app/view/imagenes/oshawott.png"
        ];
        posicion = <?= $usuario[0]['num_img']!=null?$usuario[0]['num_img']:"null";?>;
        if(posicion!=null){
            document.getElementById("circleImage").src = imagenes[posicion - 1];
        }else{
            document.getElementById("circleImage").src = "/app/view/imagenes/no imagen.png";
        }
        const circleImageComprador = document.getElementById("circleImageComprador");
        if(circleImageComprador != null){
            posicionComprador = <?= isset($comprador) && $comprador[0]['num_img']!=null?$comprador[0]['num_img']:"null";?>;
            if(posicionComprador != null){
                document.getElementById("circleImageComprador").src = imagenes[posicionComprador - 1];
            }
        }

        const expansionesDiv = document.getElementById("expansiones");
        const spanExpansion = document.getElementById("spanExpansion");
        const comprar = document.getElementById("comprar");
        const cantidad = document.getElementById("cantidad");
        const deseadosb = document.getElementById("deseadosb");
        const precio = <?=$prodcuto[0]['precio'];?>;

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

        if(deseadosb != null && <?=$usuarioController->getUSesion() != null?"true":"false";?>){
            isDeseados();
        }

        function agregarPrecio(){
            comprar.textContent = "COMPRAR: "+(Math.trunc(cantidad.value)*precio)+"€";
        }

        function clickDeseados(){
            var ajax = new XMLHttpRequest();
            ajax.open('POST', window.location.href);
            ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            ajax.onload = function(){
                if(<?=$usuarioController->getUSesion() == null?"true":"false"?>){
                    window.location.href = "/app/view/login.php";
                }else{
                    window.location.href = window.location.href;
                }
            }
            ajax.send('producto_id=<?=$prodcuto[0]['producto_id'];?>&deseados=1');
        }

        function isDeseados(){
            if(<?= json_encode($productoController->reuperarDseseadsoSesionConjunto()); ?>.some(e=> e.producto_id==<?=$prodcuto[0]['producto_id'];?>)){
                deseadosb.textContent = "✓AÑADIDO A DESEADOS";
                deseadosb.style.backgroundColor = "transparent";
                //deseadosb.style.textDecoration = "underline";
            }else{
                deseadosb.textContent = "AÑADIR A DESEADOS";
                deseadosb.style.backgroundColor = "#5f5f5f";
                //deseadosb.style.textDecoration = "none";
            }   
        }

        function realizarMeGusta(){
            var ajax = new XMLHttpRequest();
            ajax.open('POST', window.location.href);
            ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            ajax.onload = function(){
                window.location.href = window.location.href;
            }
            ajax.send('producto_id=<?=$prodcuto[0]['producto_id'];?>&pedido_id=<?= isset($pedido)?$pedido[0]['pedido_id']:'';?>');
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