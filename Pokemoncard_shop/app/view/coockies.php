<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Cookies</title>
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
        <a href="http://pokemoncardshop.com"><img class="img-logo" src="/app/view/imagenes/image.png" alt="logo"></a>
        <nav>
            <ul>
                <li><a href="http://pokemoncardshop.com">Inicio</a></li>
                <li><a href="<?php   echo $usuarioController->getUSesion() != null?"/app/view/deseados.php":"/app/view/login.php"?>">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <?=$usuarioController->getUSesion() != null&& $usuarioController->getAdminId($usuarioController->getUSesion()[0])[0]['administrador']==1?"<li><a href='/app/view/listaAdmin.php'>Modificar</a></li>":""?>
                <li><a href="<?php  echo $usuarioController->getUSesion() != null?"/app/view/cuenta.php":"/app/view/login.php"?>"><?php echo $usuarioController->getUSesion() != null?$usuarioController->getUSesion()[1]:"Cuenta"?></a></li>
            </ul>
        </nav>
    </header>
    <div class="divTexto">
        <h1>Política de Cookies</h1>
        <p><strong>Fecha de vigencia:</strong> 31 de marzo de 2024<br>
        <strong>Última actualización:</strong> 31 de marzo de 2024</p>
    
        <h2>¿Qué son las cookies?</h2>
        <p>Esta Política de cookies explica qué son las cookies y cómo las utilizamos, los tipos de cookies que utilizamos, es decir, la información que recopilamos mediante el uso de cookies y cómo se utiliza esa información, y cómo administrar la configuración de las cookies.</p>
        <p>Las cookies son pequeños archivos de texto que se utilizan para almacenar pequeños fragmentos de información. Se almacenan en su dispositivo cuando el sitio web se carga en su navegador. Estas cookies nos ayudan a que el sitio web funcione correctamente, hacerlo más seguro, brindar una mejor experiencia de usuario y comprender cómo funciona el sitio web y analizar qué funciona y dónde necesita mejorar.</p>
    
        <h2>Cómo usamos las cookies</h2>
        <p>Como la mayoría de los servicios en línea, nuestro sitio web utiliza cookies propias y de terceros para varios propósitos. Las cookies de origen son en su mayoría necesarias para que el sitio web funcione correctamente y no recopilan ninguno de sus datos de identificación personal.</p>
        <p>Las cookies de terceros utilizadas en nuestro sitio web son principalmente para comprender cómo funciona el sitio web, cómo interactúa con nuestro sitio web, mantener nuestros servicios seguros, proporcionar anuncios que sean relevantes para usted y, en general, brindarle una experiencia de usuario mejorada y ayudar a acelerar sus futuras interacciones con nuestro sitio web.</p>
    
        <h2>Tipos de cookies que utilizamos</h2>
        <p>pokemonCard_shop.es únicamente utiliza cookies que permiten el funcionamiento y la prestación de los servicios ofrecidos en la misma y que en ningún caso tratan datos de conexión y/o de los dispositivos para fines estadísticos ni captan hábitos de navegación para fines publicitarios. Por ello, al acceder a nuestra web, en cumplimiento del artículo 22 de la Ley de Servicios de la Sociedad de la Información le hemos solicitado su consentimiento para su uso. El suministro de datos personales a través de nuestro portal y el consentimiento para el uso de cookies requiere una edad mínima de 14 años y la aceptación expresa de nuestra Política de Privacidad.</p>
    
        <h2>Administrar preferencia de cookies</h2>
        <p><a href="#">Configuración de Cookies</a></p>
        <p>Puede cambiar sus preferencias de cookies en cualquier momento haciendo clic en el botón de arriba. Esto le permitirá volver a visitar el banner de consentimiento de cookies y cambiar sus preferencias o retirar su consentimiento de inmediato.</p>
    
        <h2>Instrucciones para activar o desactivar cookies</h2>
        <p>A continuación se indican los pasos para activar o desactivar las cookies en distintos navegadores:</p>
        <ul>
            <li><strong>Chrome:</strong> Configuración → Mostrar opciones avanzadas → Privacidad → Configuración de contenido</li>
            <li><strong>Firefox:</strong> Herramientas → Opciones → Privacidad → Historial → Configuración Personalizada</li>
            <li><strong>Internet Explorer:</strong> Herramientas → Opciones de Internet → Privacidad → Configuración</li>
            <li><strong>Opera:</strong> Herramientas → Preferencias → Editar preferencias → Cookies</li>
            <li><strong>Safari:</strong> Preferencias → Seguridad</li>
            <li><strong>Edge:</strong> Configuración → Ver configuración avanzada → Privacidad y servicios → Cookies</li>
        </ul>
    
        <h2>Cookies de redes sociales</h2>
        <p>Poke Bank incorpora plugins de redes sociales, que permiten acceder a las mismas a partir del Sitio Web. Por esta razón, las cookies de redes sociales pueden almacenarse en el navegador del Usuario. Los titulares de dichas redes sociales disponen de sus propias políticas de protección de datos y de cookies, siendo ellos mismos, en cada caso, responsables de sus propios ficheros y de sus propias prácticas de privacidad. El Usuario debe referirse a las mismas para informarse acerca de dichas cookies y, en su caso, del tratamiento de sus datos personales. Únicamente a título informativo se indican a continuación los enlaces en los que se pueden consultar dichas políticas de privacidad y/o de cookies:</p>
    
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