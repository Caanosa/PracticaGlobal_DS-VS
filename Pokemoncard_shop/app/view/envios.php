<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Envios</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/enlacesFooter.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        session_start();
    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
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
        <h1>Tiempo de Envío</h1>

        <p>Todos los pedidos se tramitan en un plazo máximo de 24h (laborables) desde que se realiza el pedido. El envío
            siempre se efectúa desde España con las compañías NACEX o CORREOS.</p>

        <h2>Envíos España Peninsular</h2>
        <p>Tiempo estimado de entrega: 1 a 2 días laborables. Precio desde 3,99€.</p>

        <h2>Envíos España Baleares</h2>
        <p>Tiempo estimado de entrega: 2 a 4 días laborables. Precio desde 5,99€.</p>

        <h2>Envíos España Canarias</h2>
        <p>Tiempo estimado de entrega: 3 a 5 días laborables. Precio desde 7,99€.</p>

        <h2>Envíos a Portugal</h2>
        <p>Tiempo estimado de entrega: 24 a 72h laborables. Algunos pedidos pueden demorarse debido a retenciones en
            aduanas o por la entrega mediante compañías de transporte. Poke Bank no se hace responsable de ningún cargo
            aduanero adicional. Precio desde 6,99€.</p>

        <h2>Envíos a Andorra</h2>
        <p>Tiempo estimado de entrega: 2 a 4 días laborables. Algunos pedidos pueden demorarse debido a retenciones en
            aduanas o por la entrega mediante compañías de transporte. Poke Bank no se hace responsable de ningún cargo
            aduanero adicional. Precio desde 5,99€.</p>

        <h2>Seguimiento</h2>
        <p>Recibirás el código de seguimiento <strong>SIEMPRE VÍA SMS</strong> para poder hacer un seguimiento diario de
            tu paquete. Para cualquier duda, contacta al <a href="tel:+34722204471">722 20 44 71</a>.</p>

    </div>
    <footer class="footer">
        <div class="copyright">
            <a href="http://pokemoncardshop.com">Copyright © 2024 PokemonCard_shop</a>
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