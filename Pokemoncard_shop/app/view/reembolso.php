<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso legal</title>
    <link rel="stylesheet" href="/app/view/enlacesFooter.css">
</head>
<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.php">Inicio</a></li>
                <li><a href="/app/view/deseados.php">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php session_start();  echo $usuarioController->getUSesion() != null?"/app/view/cuenta.php":"/app/view/login.php"?>"><?php echo $usuarioController->getUSesion() != null?$usuarioController->getUSesion()[1]:"Cuenta"?></a></li>
            </ul>
        </nav>
    </header>
    <div class="divTexto">

    <h1>Política de Devolución de 14 Días</h1>

    <p>Usted puede ejercer el derecho de devolver un pedido y recibir el importe del producto, optando por el reembolso dentro de los 14 días después de la recepción del producto, siempre y cuando dicha solicitud se presente a nosotros por correo electrónico. El comprador será responsable de los gastos de envío del producto de vuelta al almacén de origen, siempre que el producto no haya sido desprecintado ni abierta la caja del producto con la pegatina o film protector.</p>

    <p>Para solicitar la devolución, debe contactar por email a <a href="mailto:pokemonCard_shopfree@gmail.com">pokemonCard_shopfree@gmail.com</a> o por WhatsApp al <a href="tel:+34722204471">722 20 44 71</a>.</p>

    <h2>Condiciones para la Devolución</h2>
    <ul>
        <li>Los productos deben estar precintados y sin abrir, en el mismo estado en el que se le entregaron. Antes de proceder a la devolución, se le podrá requerir una imagen de los productos.</li>
        <li>Los productos deben ser devueltos a nuestra dirección especificada, dentro de los 14 días después de que reconozcamos su solicitud. Deberá enviarnos el número de seguimiento del envío, ya que sin él no podremos validar su devolución.</li>
    </ul>

    <h2>Proceso de Reembolso</h2>
    <p>Al recibir su artículo devuelto, inspeccionaremos las mercancías. Una vez aprobado y el producto pase la fase de inspección, se procesará su reembolso íntegro de la compra realizada en <a href="inicio.php">http://www.pokemonCard_shop.es</a>.</p>

    </div>
    <footer class="footer">
        <div class="copyright">
            <a href="https://creatuweb.xyz/">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="/app/view/avisoLegal.php">Aviso legal</a> |
            <a href="/app/view/privacidad.php">Política de privacidad</a> |
            <a href="/app/view/coockies.php">Política de Cookies</a> |
            <a href="/app/view/envios.php">Política de envíos</a> |
            <a href="/app/view/reembolso.php">Política de reembolso</a>
        </div>
    </footer>
</body>
</html>